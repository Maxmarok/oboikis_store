<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MakeOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Orders $order,
        public Collection $items,
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->order->user)->send(new OrderShipped($this->order, $this->items));
    }
}
