<?php

namespace Tests;

use Jonathanbell\Firstphpcli\Line;
use Jonathanbell\Firstphpcli\Transcription;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase
{
  function testItLoadsAVttFileAsAString()
  {
    $file = __DIR__ . '/stubs/basic-example.vtt';

    $transcription = Transcription::load($file);

    $this->assertStringContainsString('Here is a', $transcription);
    $this->assertStringContainsString('example of a VTT file', $transcription);
  }

  function testItCanConvertAnArrayOfLineObjects()
  {
    $file = __DIR__ . '/stubs/basic-example.vtt';

    $lines = Transcription::load($file)->lines();

    $this->assertCount(2, $lines);

    $this->assertContainsOnlyInstancesOf(Line::class, $lines);
  }

  function testItDiscardsIrrelevantLinesInAVttFile()
  {
    $transcription = Transcription::load(__DIR__ . '/stubs/basic-example.vtt');

    $this->assertStringNotContainsString('WEBVTT', $transcription);
    $this->assertCount(2, $transcription->lines());
  }

  function testItCanRenderVttFileLineObjectsAsHtml()
  {
    $transcription = Transcription::load(__DIR__ . '/stubs/basic-example.vtt');

    $expected = <<<EOT
<a href="?time=00:03">Here is a</a>
<a href="?time=00:04">example of a VTT file.</a>
EOT;

    $this->assertEquals($expected, $transcription->htmlLines());
  }
}
