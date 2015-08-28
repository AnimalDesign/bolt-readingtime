<?php

namespace Bolt\Extension\Animal\ReadingTime;

use Bolt\BaseExtension;

class Extension extends BaseExtension
{
    public function initialize()
    {
        // Add twig function for display the reading time in frontend
        $this->addTwigFunction('readingtime', 'calculateReadingTimeAction');
    }

    public function calculateReadingTimeAction($content)
    {
        $readingTime = new ReadingTime;

        $readingTime->wordcount = str_word_count($content);
        $readingTime->wordsPerMinute = $this->config['wordsPerMinute'];
        $readingTime->wordsPerSecond = $readingTime->wordsPerMinute / 60;
        $readingTime->readingTimeSeconds = $readingTime->wordcount / $readingTime->wordsPerSecond;
        $readingTime->readingTimeMinutes = $readingTime->readingTimeSeconds / 60;

        switch ($this->config['round']) {
            case true:
                $readingTime->readingTimeMinutes = round($readingTime->readingTimeMinutes);
                break;
            case 'up':
                $readingTime->readingTimeMinutes = ceil($readingTime->readingTimeMinutes);
                break;
            case 'down':
                $readingTime->readingTimeMinutes = floor($readingTime->readingTimeMinutes);
                break;
            default:
                $readingTime->readingTimeMinutes = (int)$readingTime->readingTimeMinutes;
        }

        return $readingTime;
    }

    /**
     * Set the defaults for configuration parameters.
     *
     * @return array
     */
    protected function getDefaultConfig()
    {
        return array(
            'wordsPerMinute' => 225,
            'round' => true,
        );
    }

    public function getName()
    {
        return 'Reading Time';
    }
}
