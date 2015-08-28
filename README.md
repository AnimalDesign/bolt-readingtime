# Reading Time plugin for Bolt CMS

This plugin provides a simple twig function, that calculates the estimated reading time for a given content.

## Setup

Add the `readingtime` function somewhere to your template:

````
{{ readingtime(record.body) }} Min.
````

Will print something like `14 Min.`.

## Configuration

- `wordsPerMinute` (default: 270): Average read words per minute
- `round` (default: true, possible: true, 'up', 'down'): Define the used method to round the minutes

## About

„We build it“ — [ANIMAL](http://animal.at)
