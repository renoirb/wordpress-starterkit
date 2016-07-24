SHELL         := bash
PATH          := bin:${PATH}
PWD           := $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))


.DEFAULT_GOAL: default


.PHONY: default
default: dependencies
		$(info  > Done!)


dependencies: composer_modules/autoload.php \
							public/bower_modules \
							config.wordpress.php \
							public/wp-content/themes/twentyfifteen
		$(info  > Update dependencies)


composer.json:
		$(info  > Check if Composer dependencies changed)
		touch composer.json


composer_modules:
		$(info  > Install composer dependencies)
		composer install --no-interaction --working-dir ${PWD}


composer_modules/autoload.php: composer.json
		$(info  > Composer dependencies seem to have changed)
		composer update


bower.json:
		$(info  > Check if Bower dependencies changed)
		bower update


public/bower_modules: bower.json
		$(info  > Check if Bower components folder exists)
		bower install


config.wordpress.php:
		$(info  > Copy development configuration stash)
		cp config.wordpress.php.dist config.wordpress.php


public/wp-content/themes/twentyfifteen:
		cp -r public/backoffice/wp-content/themes/twentyfifteen public/wp-content/themes/twentyfifteen
