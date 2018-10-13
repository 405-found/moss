<?php

namespace App\Http\Controllers;

use Log;
use Buzz\Browser;
use Illuminate\Http\Request;
use Buzz\Client\FileGetContents;

class WhatsAppController extends Controller
{
  /**
   * listen to the user
   *
   * @param Request $request
   * @return void
   */
  public function listen(Request $request)
  {
    // Log::info($request->all());
    $this->send('27786331190');
  }

  /**
   * send message
   *
   * @param mixed $numbers
   * @return void
   */
  public function send($numbers)
  {
    $key = urlencode(config('services.whatsapp.key'));
    $url = config('services.whatsapp.url');

    $numbers = urlencode($numbers);
    $message = urlencode("Hello World!");

    $url = "{$url}?apikey={$key}&number={$numbers}&text={$message}";
    $response = json_decode(file_get_contents($url, false));

    // $client = new FileGetContents([], new Psr17ResponseFactory());
    // $factory = new Browser($client, new \Psr17RequestFactory());
    // $response = $factory->get("");
    Log::info('', [$response]);
  }
}
