# phpunitci

# Description

As PHPUnit does not allow you to add custom parameters on its command, this is a trick to use your own arguments for tests running

The current trick is using Symfony 4 in order to create command that would generate a .env.test file using input arguments that will be loaded by bootstrap.php

# How does it work ?

First, you have a file named `.env.test.dist` that contains different custom env variables with specific placeholder

Next take a look at `CustomizeTestCommand` in which you'll be able to add new custom arguments

And then you will have to launch the command `bin/console customize:test [OPTIONS + VALUES]` to make it work

__So.. what will it do ?__

The code will execute as following :

1. Copy `.env.test.dist` to `.env.test`
2. Retrieve and replace each parameters you passed while running the command

That's it !

# Finally !

Simply run tests as following :

1. `bin/console customize:test [OPTIONS + VALUES]`
2. `vendor/bin/phpunit`

While running `vendor/bin/phpunit`, it will execute `config/bootstrap.php` and load `.env.test` file as environment data

That's how it let's you retrieve your custom arguments as Environment variables
