Advent of Code 2024

Playing with Symfony UX, Live Components, Stimulus, Tagged services, etc.

First run

    $ composer install

Initialize Tailwind CSS with

    $ bin/console tailwind:init
    $ bin/console tailwind:build

Run in a console command with `bin/console aoc <day> <part>` You first have to copy your input to `src/Solutions/day{$day}.txt`

Run in a browser with `$ symfony serve -d`, then go to the url listed.

Run unit tests with `$ bin/phpunit`
