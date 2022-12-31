<?php

namespace Jonathanbell\Firstphpcli;

class Transcription
{

  public function __construct(protected array $lines)
  {
    $this->lines = $this->discardIrrelevantLines(array_map('trim', $lines));
  }

  public static function load(string $path): self
  {
    return new static(file($path));
  }

  public function lines(): array
  {
    $lines = [];

    for ($i = 0; $i < count($this->lines); $i += 2) {
      $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
    }

    return $lines;
  }

  protected function discardIrrelevantLines(array $lines): array {
    return array_values(array_filter($lines, callback: function ($line) {
      return Line::valid($line);
    }));
  }

  public function __toString(): string {
    return implode('', $this->lines);
  }

}
