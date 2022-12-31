<?php

namespace Jonathanbell\Firstphpcli;

class Line
{
  public function __constructor(string $timestamp, string $body) {
    //
  }

  public static function valid($line): bool {
    return !str_contains($line, 'WEBVTT') && !empty($line) && !is_numeric($line);
  }
}
