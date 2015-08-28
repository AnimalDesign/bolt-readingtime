<?php

namespace Bolt\Extension\Animal\ReadingTime;

class ReadingTime {
    public $readingTimeSeconds;
    public $readingTimeMinutes;
    public $wordcount;
	public $wordsPerMinute;
	public $wordsPerSecond;

    public function __toString() {
        return (string)$this->readingTimeMinutes;
    }
}
