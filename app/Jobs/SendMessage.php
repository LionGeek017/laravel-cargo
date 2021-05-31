<?php

namespace App\Jobs;

use App\Events\SendMail;
use App\Http\Controllers\EventController;
use App\Listeners\SendMailFired;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Event::dispatch(new SendMail($this->userId));
        $user = User::find($this->userId)->toArray();
        Mail::send('event-mail', $user, function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Theme message');
        });
    }
}
