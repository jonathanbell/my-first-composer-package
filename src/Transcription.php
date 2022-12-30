<?php

namespace Jonathanbell\Firstphpcli;

class Transcription
{

  protected array $lines;

  public static function load(string $path): self
  {
    $instance = new static();

    $instance->lines = $instance->discardIrrelevantLines(file($path));

    return $instance;
  }

  public function lines(): array
  {
    return $this->lines;
  }

  protected function discardIrrelevantLines(array $lines): array {
    $lines = array_map('trim', $lines);

    return array_values(array_filter($lines, callback: function ($line) {
      $line = trim($line);
      return !str_contains($line, 'WEBVTT') && !empty($line) && !is_numeric($line);
    }));
  }

  public function __toString(): string {
    return implode('', $this->lines);
  }

}
