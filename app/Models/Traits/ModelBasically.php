<?php

namespace App\Models\Traits;

use App\Exceptions\NotFoundRecord;

trait ModelBasically
{
    /**
     * To get list eloquent builder.
     *
     * @param array $params
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getEloquentList($params = [], $with = [])
    {
        $query = self::query()->with($with);

        if (method_exists(self::class, "getEloquentFilter")) {
            $query = self::getEloquentFilter($query, $params);
        }

        return $query;
    }

    /**
     * To get list and filter by params with relation.
     *
     * @param array $params
     * @param array $with
     * @return self[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getList($params = [], $with = [])
    {
        return self::getEloquentList($params, $with)->get();
    }

    /**
     * To get detail.
     *
     * @param $id
     * @param array $with
     * @return self|null
     */
    public static function getById($id, $with = [])
    {
        return self::query()
            ->whereKey($id)
            ->with($with)
            ->first();
    }

    /**
     * To store or update record.
     *
     * @param $dataOrId
     * @param array $params
     * @return self
     * @throws NotFoundRecord
     */
    public static function storeUpdate(array $params, $dataOrId = null)
    {
        if ($dataOrId instanceof self) {
            $data = $dataOrId;
        } elseif (!is_null($dataOrId)) {
            $data = self::getById($dataOrId);

            if (!$data) {
                throw new NotFoundRecord();
            }
        } else {
            $data = new self();
        }

        $data->fill($params);
        $data->save();

        return $data;
    }

    /**
     * To destroy records.
     *
     * @param $ids
     * @return bool
     */
    public static function destroyByIds($ids)
    {
        $ids       = (is_array($ids) ? $ids : [$ids]);
        $findCount = 0;

        foreach ($ids as $id) {
            if ($data = self::getById($id)) {
                $data->delete();
                $findCount++;
            }
        }

        return ($findCount === count($ids));
    }

    /**
     * To get record by slug (current locale).
     *
     * @param string $slug
     * @param array $with
     * @return self|null
     */
    public static function getBySlug(string $slug, array $with = [])
    {
        if (in_array(HasLocale::class, class_uses(self::class))) {
            return self::getEloquentList([], $with)
                ->active()
                ->whereTranslation("slug", $slug, curLocale())
                ->first();
        }

        return self::getEloquentList([], $with)
            ->where("slug", $slug)
            ->first();
    }
}
