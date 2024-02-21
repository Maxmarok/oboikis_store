<?php

namespace App\Jobs;

use App\Services\Sbis\SbisInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddItemsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $page;

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
    public function handle(SbisInterface $service): void
    {
        $service->addItems($this->page);
    }
}
