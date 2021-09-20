<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CloneController extends BaseController
{
    protected $item_type;
    protected $base_table;
    protected $trans_table;
    protected $relation_key;
    protected $item;

    function index(Request $request, $type, $id)
    {
        $this->item_type = $type;
        $this->item = app('App\\Models\\' . $type)->find($id);
        $this->base_table = $this->item->getTable();
        $this->trans_table = Str::singular($this->base_table) . '_translations';
        $this->relation_key = Str::singular($this->base_table) . '_id';
        // copy
        $this->copy();
        // redirect
        return redirect()->back();
    }

    function copy()
    {
        // copy new item
        $new_item = $this->item->replicate();
        $new_item->global_name = $this->item->global_name . ' - Copy';
        $new_item->save();
        // relationship
        $this->copy_relationship($new_item);
        // language
        foreach (['en', 'vi'] as $locale) {
            $trans = $this->item->translate($locale);
            if ($trans) {
                $new_trans = $trans->replicate();
                $new_trans->{$this->relation_key} = $new_item->id;
                if (isset($new_trans->slug)) {
                    $new_trans->slug = $new_trans->slug . '-copy';
                }
                $new_trans->save();
            }
        }
    }

    function copy_relationship($new_item)
    {
        $relationships = [];
        switch ($this->item_type) {
            case 'ZCruise':
                $relationships = ['zPosts'];
                break;
            case 'ZPackage':
                $relationships = ['zDestinations', 'zOffers', 'zPosts', 'zReviews', 'zSpecialOffers', 'zTransfers'];
                break;
            case 'ZReview':
            case 'ZTransfer':
                $relationships = ['zPackages'];
                break;
            case 'ZNewsPost':
                $relationships = ['zNewsTypes', 'zPackages'];
                break;

        }
        if ($relationships) {
            foreach ($relationships as $key) {
                try {
                    $items = $this->item->{$key};
                    if ($items->isNotEmpty()) {
                        $new_item->{$key}()->sync($items->pluck('id')->toArray());
                    }
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }
    }
}
