<?php

namespace Tests;

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

  public function testItCanConvertAStringToAnArray() {
    $file = __DIR__ . '/stubs/basic-example.vtt';

    $this->assertCount(4, Transcription::load($file)->lines());
  }

  public function testItDiscardsIrrelevantVttLines() {
    $file = __DIR__ . '/stubs/basic-example.vtt';

    $transcription = Transcription::load($file);

    $this->assertStringNotContainsString('WEBVTT', $transcription);
    $this->assertCount(4, $transcription->lines());
  }
}
