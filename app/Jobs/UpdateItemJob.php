<?php

namespace App\Jobs;

use App\Services\Dashboard\ItemsController\SbisService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $name;

    /**
     * Create a new job instance.
     */
    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sbis = new SbisService();
        $sbis->updateItem($this->name);
    }
}
