<?php

namespace Tests;

use Jonathanbell\Firstphpcli\Line;
use Jonathanbell\Firstphpcli\Transcription;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase
{

  public function testItLoadsAVttFileAsAString() {
    $file = __DIR__ . '/stubs/basic-example.vtt';
    $transcription = Transcription::load($file);

    $this->assertStringContainsString('Here is a', $transcription);
    $this->assertStringContainsString('example of a VTT file', $transcription);
  }

  public function testItCanConvertAStringToAnArrayOfLineObjects() {
    $file = __DIR__ . '/stubs/basic-example.vtt';

    $lines = Transcription::load($file)->lines();
    $this->assertCount(2, $lines);
    $this->assertContainsOnlyInstancesOf(Line::class, $lines);
  }

  public function testItDiscardsIrrelevantVttLines() {
    $file = __DIR__ . '/stubs/basic-example.vtt';

    $transcription = Transcription::load($file);

    $this->assertStringNotContainsString('WEBVTT', $transcription);
    $this->assertCount(2, $transcription->lines());
  }
}
