<?php

namespace App\Http\Controllers;

use Log;
use App\User;
use Buzz\Browser;
use App\Engine\ProjectMoss;
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
    $payLoad = json_decode($request->all()['data']);

    if (!User::onboard($payLoad->from)) {
      return $this->send(User::addUser($payLoad->from), $payLoad->from);
    }

    $user   = User::where('phone_number', $payLoad->from)->first();
    $engine = new ProjectMoss($user);

    $this->send($engine->read($payLoad->text), $engine->user->phone_number);
  }

  /**
   * send message
   *
   * @param string $message
   * @param mixed $numbers
   * @return void
   */
  private function send($message, $numbers)
  {
    $key = urlencode(config('services.whatsapp.key'));
    $url = config('services.whatsapp.url');

    $numbers = urlencode($numbers);
    $message = urlencode($message);

    $url = "{$url}?apikey={$key}&number={$numbers}&text={$message}";
    $response = json_decode(file_get_contents($url, false));
    Log::info('', [$response]);
  }
}
