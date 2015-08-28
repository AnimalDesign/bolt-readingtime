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
        $words = str_word_count($content);
        $wordsPerSecond = $this->config['wordsPerMinute'] / 60;
        $readingTimeSeconds = $words / $wordsPerSecond;
        $readingTimeMinutes = $readingTimeSeconds / 60;

        switch ($this->config['round']) {
            case true:
                $readingTimeMinutes = round($readingTimeMinutes);
                break;
            case 'up':
                $readingTimeMinutes = ceil($readingTimeMinutes);
                break;
            case 'down':
                $readingTimeMinutes = floor($readingTimeMinutes);
                break;
            default:
                $readingTimeMinutes = (int)$readingTimeMinutes;
        }

        return $readingTimeMinutes;
    }

    /**
     * Set the defaults for configuration parameters.
     *
     * @return array
     */
    protected function getDefaultConfig()
    {
        return array(
            'wordsPerMinute' => 270,
            'round' => true,
        );
    }

    public function getName()
    {
        return 'Reading Time';
    }
}
