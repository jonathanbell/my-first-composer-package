<?php

namespace Tests;

use Jonathanbell\Firstphpcli\Transcription;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase
{

  public function testItLoadsAVttFile() {
    $transcription = Transcription::load(__DIR__.'/stubs/basic-example.vtt');
    $expected = file_get_contents(__DIR__.'/stubs/basic-example.vtt');

    $this->assertEquals($expected, $transcription);
  }

}
