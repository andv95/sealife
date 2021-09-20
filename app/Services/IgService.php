<?php

namespace App\Services;

use App\Helpers\Helper;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Cache;

class IgService
{
    private $accessToken;

    const API_URL = "https://api.instagram.com/oauth";
    const MEDIA_API_URL = "https://graph.instagram.com";

    const CLIENT_ID = "272515350427386";
    const CLIENT_SECRET = "0662c12cf1727d1e9eb53042cacf1f4f";
    const REDIRECT_URI = "https://www.sealifegroup.com/admin/ig/auth";
    const CACHE_KEY = 'ig_access_token';

    public function setAccessTokenByCode(string $code)
    {
        $response = (new Client())->post(self::API_URL . "/access_token", [
            'form_params' => [
                'client_id' => self::CLIENT_ID,
                'client_secret' => self::CLIENT_SECRET,
                'redirect_uri' => self::REDIRECT_URI,
                'grant_type' => 'authorization_code',
                'code' => $code
            ]
        ]);

        $content = $response->getBody()->getContents();
        $content = @Helper::jsonDecode($content, true);

        if (!$accessToken = @$content["access_token"]) {
            throw new Exception(@$content['error_message'] ?? "Code error");
        }
        //
        Cache::forget(self::CACHE_KEY);
        Cache::add(self::CACHE_KEY, $accessToken, now()->addHour());

        $this->setAccessToken($accessToken);
    }

    public function setAccessToken(string $token)
    {
        $this->accessToken = $token;
    }

    public function getAccessToken()
    {
        return Cache::get(self::CACHE_KEY, '');
        //return $this->accessToken;
    }

    public static function getUserMediaByUri($uri = null)
    {
        $response = (new Client())->get($uri);
        $data = @Helper::jsonDecode($response->getBody()->getContents(), true);

        return is_array($data) ? $data : [];
    }

    public function getUserMedia()
    {
        $params = http_build_query([
            "fields" => "id,media_url,caption,media_type,permalink",
            "access_token" => $this->getAccessToken()
        ]);

        return $this->getUserMediaByUri(self::MEDIA_API_URL . "/me/media?" . $params);
    }

    public static function getLoginUrl(): string
    {
        $params = http_build_query([
            'client_id' => self::CLIENT_ID,
            'redirect_uri' => self::REDIRECT_URI,
            'scope' => 'user_profile,user_media',
            'response_type' => 'code',
            'state' => 1
        ]);

        return self::API_URL . "/authorize?" . $params;
    }
}
