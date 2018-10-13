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
  ];

  /**
   * read
   *
   * @param mixed $numbers
   * @param mixed $message
   * @return void
   */
  public function read($message)
  {
    return "I do not understand";
  }
}