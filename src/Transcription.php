<?php

namespace Jonathanbell\Firstphpcli;

class Transcription
{
  public function __construct(protected array $lines)
  {
    $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
  }

  public static function load(string $path): self
  {
    return new static(file($path));
  }

  public function lines(): array
  {
    $lines = [];

    // += 2 because we want to get each set of 2 lines
    for ($i = 0; $i < count($this->lines); $i += 2) {
      $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
    }

    return $lines;
  }

  public function htmlLines()
  {
    return implode(PHP_EOL, array_map(
      function (Line $line) {
        return $line->toAnchorTag();
      }, $this->lines()
    ));
  }

  protected function discardInvalidLines(array $lines): array
  {
    return array_values(array_filter(
      $lines,
      fn($line) => Line::valid($line)
    ));
  }

  public function __toString(): string
  {
    return implode("\n", $this->lines);
  }
}
