Advent of Code 2024

![CI](https://github.com/scottdriscoll/AdventOfCode2024/actions/workflows/php.yml/badge.svg)

Playing with Symfony UX, Live Components, Stimulus, Tagged services, etc.

First run

    $ composer install

Initialize Tailwind CSS with

    $ bin/console tailwind:init
    $ bin/console tailwind:build

Run in a console command with `bin/console aoc <day> <part>` You first have to copy your input to `src/Solutions/day{$day}.txt`

Some commands can output an animated gif of the puzzle. For this, add `--visualize` to the command call. You must have `php8.4-gd` installed.
Make sure `/tmp/images/` exists and is writable. Output will be at `/tmp/images/animated.gif`.
This will significantly increase the time to complete.
Then you should upload the gif to a site like ezgif.com to speed up the animation and lower the file size.

Run in a browser with `$ symfony serve -d`, then go to the url listed.

Run unit tests with `$ bin/phpunit`
