<?php

namespace App\Console\Commands;

use App\Jobs\AddItemsJob;
use Illuminate\Console\Command;

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
