<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Language;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Throwable;

class CrsApiService
{
    const API_URL = "https://crs.wowme.vn/api/v1/sealife-group";
    const API_TOKEN = "2nyjWjzab8kKhqCe7kFpdZGdq2q8pcxnj5t4teQ3c2nJ5kJq58tsHDmZnm5BFPbVgddCekwdSUTfpPe4jPd9ZsRWeBJrVZ8axaUdw4EAR2RNG";

    const API_FIELD_PACKAGE = "packages";
    const API_FIELD_ROOM = "rooms";
    const API_FIELDS = [
        self::API_FIELD_PACKAGE,
        self::API_FIELD_ROOM,
    ];


    private $client;
    private $useCache = false;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false
        ]);
    }

    public function getApiIds()
    {
        try {
            $uri = self::API_URL . "/id/all";

            $response = $this->client->get($uri, [
                'query' => $this->getTokenParam()
            ]);

            $data = $response->getBody()->getContents();
            $data = @Helper::jsonDecode($data, true);

            if (is_array($data) && array_key_exists("results", $data)) {
                return $data['results'];
            }

            return [];
        } catch (Throwable $exception) {
            return [];
        }
    }

    public function getApiIdsByModule($module)
    {
        if (!in_array($module, self::API_FIELDS)) {
            return [];
        }

        $cacheKey = "crs_api.get_ids." . $module;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $modulesIds = $this->getApiIds();
        $moduleIds = (array_key_exists($module, $modulesIds) ? $modulesIds[$module] : []);

        //Caching hear
        if ($this->useCache) {
            Cache::forever($cacheKey, $moduleIds);
        }

        return $moduleIds;
    }

    public function getPackagePriceMinRooms($packageId)
    {
        try {
            if (!$packageId) {
                return [];
            }

            $uri = self::API_URL . "/package/price/min";

            $response = $this->client->get($uri, [
                'query' => array_merge(
                    ["package_id" => $packageId, 'language' => Language::getCurrentLanguageKey()],
                    $this->getTokenParam()
                )
            ]);

            $data = $response->getBody()->getContents();
            $data = @Helper::jsonDecode($data, true);

            if (is_array($data) && array_key_exists("results", $data)) {
                return $data['results'];
            }

            return [];
        } catch (Throwable $exception) {
            return [];
        }
    }

    public function getPackageRooms($packageId, string $date, array $options = [])
    {
        try {
            if (!$packageId) {
                return [];
            }

            //If null date, will get list rooms no price
            //And its promotions.
            if (is_null($date)) {
                return [];
            }

            $uri = self::API_URL . "/package/price/detail";

            $params["package_id"] = $packageId;
            $params["check_in_date"] = $date;
            $params["language"] = Language::getCurrentLanguageKey();

            if (array_key_exists("room_id", $options)) {
                $params["room_id"] = $options["room_id"];
            }

            $response = $this->client->get($uri, [
                'query' => array_merge(
                    $params,
                    $this->getTokenParam()
                )
            ]);

            $data = $response->getBody()->getContents();
            $data = @Helper::jsonDecode($data, true);

            if (is_array($data) && array_key_exists("results", $data)) {
                return $data['results'];
            }

            return [];
        } catch (Throwable $exception) {
            return [];
        }
    }

    public function getPackageInfo($packageId)
    {
        try {
            if (!$packageId) {
                return [];
            }

            $uri = self::API_URL . "/package/details";

            $response = $this->client->get($uri, [
                'query' => array_merge(
                    ["package_id" => $packageId, 'language' => Language::getCurrentLanguageKey()],
                    $this->getTokenParam()
                )
            ]);

            $data = $response->getBody()->getContents();
            $data = @Helper::jsonDecode($data, true);

            if (is_array($data) && array_key_exists("results", $data)) {
                return $data['results'];
            }

            return [];
        } catch (Throwable $exception) {
            return [];
        }
    }

    private function getTokenParam(): array
    {
        return [
            'token' => self::API_TOKEN
        ];
    }
}
