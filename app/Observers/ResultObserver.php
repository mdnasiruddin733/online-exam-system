<?php

namespace App\Observers;

use App\Events\ResultEvent;
use App\Models\Result;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResultObserver 
{
    /**
     * Handle the Result "created" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function created(Result $result)
    {
        broadcast(new ResultEvent($result));
    }

    /**
     * Handle the Result "updated" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function updated(Result $result)
    {
        //
    }

    /**
     * Handle the Result "deleted" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function deleted(Result $result)
    {
        //
    }

    /**
     * Handle the Result "restored" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function restored(Result $result)
    {
        //
    }

    /**
     * Handle the Result "force deleted" event.
     *
     * @param  \App\Models\Result  $result
     * @return void
     */
    public function forceDeleted(Result $result)
    {
        //
    }
}
