<?php

namespace App\Jobs;

use App\Services\Dashboard\ItemsController\SbisService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddItemsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    var $page;

    /**
     * Create a new job instance.
     */
    public function __construct(int $page = 0)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sbis = new SbisService();
        $sbis->addItems($this->page);
    }
}
