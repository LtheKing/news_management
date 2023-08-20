<?php

namespace App\Listeners;

use App\Events\NewsProcessLogs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Logs;

class SendNewsLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //28 juli 2023
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewsProcessLogs  $event
     * @return void
     */
    public function handle(NewsProcessLogs $event)
    {
        $news = $event->getNews();
        // dd($news->toJson());
        Logs::create([
            'News_ID' => $news->id,
            'EventType' => $news->EventType,
            'Role' => $news->Role,
            'Message' => $news->Role,
            'RequestData' => $news->toJson(),
            'ResponseData' => $news->ResponseData,
            'ExceptionMessage' => $news->ExceptionMessage,
            'Status' => $news->Status
        ]);
    }
}
