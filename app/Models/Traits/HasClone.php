<?php


namespace App\Models\Traits;


trait HasClone
{
    function getCloneUrl()
    {
        return route('admin.clone', [class_basename($this), $this->id]);
    }
}
