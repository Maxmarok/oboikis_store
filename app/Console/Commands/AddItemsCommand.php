<?php

namespace App\Console\Commands;

use App\Jobs\AddItemsJob;
use App\Services\Dashboard\ItemsController\SbisService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddItemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        AddItemsJob::dispatchAfterResponse();
    }
}
