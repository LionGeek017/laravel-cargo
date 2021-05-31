<?php

namespace App\Listeners;

use App\Events\SendCargoTG;
use App\Models\Cargo;
use Facade\FlareClient\View;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendCargoTGFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendCargoTG  $event
     * @return void
     */
    public function handle(SendCargoTG $event)
    {
        $cargo = $event->cargo; //Cargo::find($event->cargoId)->toArray();

        define('TOKEN', '1693517629:AAFJ0C-X-DewXYxkgQb26FcU5fTPxm2SSn4');
        define('BASE_URL', 'https://api.telegram.org/bot' . TOKEN . '/');

        function sendRequest($method, $params = []) {
            if(!empty($params)) {
                $url = BASE_URL . $method . '?' . http_build_query($params);
            } else {
                $url = BASE_URL . $method;
            }

            $response = Http::get($url);
            $responseDecode = json_decode($response, JSON_OBJECT_AS_ARRAY);
            return $responseDecode;
        }

        //$message = (string) view('telegram.messageNewCargo');
        $message = view('telegram.message-new-cargo', compact('cargo'))->render();

        sendRequest('sendMessage', ['chat_id' => '@testcanal2021', 'text' => $message, 'parse_mode' => 'HTML']);
    }
}
