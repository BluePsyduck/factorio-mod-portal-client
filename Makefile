.PHONY: help bash fix test update

help: ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

bash: ## Run the docker container and connect to it using bash.
	docker run -it --rm -v $(shell pwd):/project bluepsyduck/php-fpm bash

fix: ## Fixes the codestyle in the project.
	docker run -it --rm -v $(shell pwd):/project bluepsyduck/php-fpm composer phpcbf

test: ## Test the project.
	docker run -it --rm -v $(shell pwd):/project bluepsyduck/php-fpm composer test

update: ## Update the dependencies.
	docker run -it --rm -v $(shell pwd):/project bluepsyduck/php-fpm composer update
