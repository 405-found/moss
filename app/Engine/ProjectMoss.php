<?php

namespace App\Engine;

class ProjectMoss
{
  /**
   * $user
   *
   * @var Model
   */
  public $user;

  /**
   * __construct
   *
   * @param mixed $user
   * @return void
   */
  public function __construct($user)
  {
    $this->user = $user;
  }

  /**
   * Engine commands
   */
  public $options = [
    'onboard' => 'Welcome to our Masive Open Skill set.

Type "Business ready" if you are business ready, or type "Start my own business" if you want to start your own business',
    'commands' => [
      'Business ready',
      'Start my own business'
    ],
  ];

  /**
   * read and reply
   *
   * @param mixed $numbers
   * @param mixed $message
   * @return void
   */
  public function read($message, $results = [])
  {
    foreach($this->options['commands'] as $command) {
      similar_text(strtolower($message), strtolower($command), $p);
      array_push($results, $p);
    }

    $highest = max($results);

    if ($highest > 72) {
      for ($i = 0; $i < count($results); $i++) {
        if ($results[$i] == $highest) {
          if (in_array($this->options['commands'][$i], [
            'Business ready',
            ])) {
            return 'Do this..';
          }
        }
      }
    }

    return "I do not understand";
  }
}