<?php

namespace App\Jobs;

use App\Events\OrderChangedEvent;
use App\Events\PaymentSuccess;
use App\Models\Managers;
use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Orders $order
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $managers = Managers::all();

        foreach($managers as $manager) {
            event(new PaymentSuccess($this->order));
        }
    }
}
