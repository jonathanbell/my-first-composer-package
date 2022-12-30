<?php

namespace Jonathanbell\Firstphpcli;

class Transcription
{

  protected string $file;

  public function __toString(): string {
    return $this->file;
  }

  public static function load(string $path):string
  {
    $instance = new static();
    $instance->file = file_get_contents($path);

    return $instance;
  }

}
