<?php

namespace App\Jobs;

use App\Models\ZInsPhoto;
use App\Services\IgService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreIgMediaData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * StoreIgMediaData constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;

        do {
            //Break if starting store old media.
            if (!ZInsPhoto::storeFromIgMediaData($data['data'])) {
                break;
            }

            if (!empty($data['paging']) && !empty($data['paging']['next'])) {
                $data = IgService::getUserMediaByUri($data['paging']['next']);
            } else {
                $data = [];
            }

        } while (!empty($data['data']));
    }
}
