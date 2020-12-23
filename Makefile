.DEFAULT_GOAL := help

CURRENT_DIR := $(shell pwd)
DOCKER_COMPOSE=docker-compose
PHP_RUN=$(DOCKER_COMPOSE) run --rm -u www-data php php
CURRENT_USER_ID=$(shell id -u)
CURRENT_GROUP_ID=$(shell id -g)

.PHONY: help
help:
	@echo ""
	@echo "Badger available targets: "
	@echo ""
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

####################################################### Docker     #####################################################

.PHONY: start
start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphan ${C}

.PHONY: stop
stop: ## Stop the projet
	$(DOCKER_COMPOSE) stop

.PHONY: down
down: ## Down the project
	$(DOCKER_COMPOSE) down -v

.PHONY: php-image-dev
php-image-dev: ## Build the dev docker image
	DOCKER_BUILDKIT=1 docker build --build-arg USER_ID=$(CURRENT_USER_ID) --build-arg USER_GROUP=$(CURRENT_GROUP_ID) --progress=plain --pull --tag badger/dev/php:7.4 --target dev ./infrastructure

.PHONY: php-image-dev-mac
php-image-dev-mac:
	DOCKER_BUILDKIT=1 docker image build --progress=plain --pull --tag badger/dev/php:7.4 --target dev ./infrastructure

.PHONY: php-image-prod
php-image-prod: ## Build the prod docker image
	DOCKER_BUILDKIT=1 docker build --progress=plain --pull --tag badger/prod:${IMAGE_TAG} --target prod ./infrastructure

.PHONY: php-images ## Build all docker image
php-images: php-image-dev php-image-prod

################################################# Install ##############################################################
application/composer.lock: application/composer.json
	$(PHP_RUN) /usr/local/bin/composer update

application/vendor: application/composer.lock
	$(PHP_RUN) /usr/local/bin/composer install

.PHONY: cache
cache: application/vendor ## Remove the cache
	rm -rf var/cache && $(PHP_RUN) bin/console cache:warmup

.PHONY: sf
sf: ## Call the symfony console
	$(PHP_RUN) bin/console ${F}

.PHONY: app-dev
app-dev: application/vendor
	APP_ENV=dev $(MAKE) start
	APP_ENV=dev $(MAKE) cache

.PHONY: db-schema
db-schema:
	$(PHP_RUN) bin/console d:s:u --dump-sql
	$(PHP_RUN) bin/console d:s:u --force


##################################################### Gamification #####################################################
.PHONY: gamification-phpstan
gamification-phpstan:
	$(PHP_RUN) vendor/bin/phpstan analyse src/Gamification --level=7 -c config/tests/gamification/phpstan.neon

.PHONY: gamification-cs
gamification-cs: ## Run Gamification Coding Style fixer
	$(PHP_RUN) vendor/bin/php-cs-fixer fix --config=config/tests/gamification/.php_cs --diff

.PHONY: gamification-back-static
gamification-back-static: gamification-phpstan gamification-cs

.PHONY: gamification-phpspec
gamification-phpspec: ## Run Gamification PHPSpec
	$(PHP_RUN) vendor/bin/phpspec run --config config/tests/gamification/phpspec.yml

.PHONY: gamification-phpspec-desc
gamification-phpspec-desc: ## Run Gamification PHPSpec describe
	$(PHP_RUN) vendor/bin/phpspec describe --config config/tests/gamification/phpspec.yml

.PHONY: gamification-acceptance
gamification-acceptance: ## Run Gamification acceptance tests
	$(PHP_RUN) vendor/bin/behat -p gamification_acceptance -f progress -c config/tests/gamification/behat.yml

.PHONY: gamification-end-to-end-api
gamification-end-to-end-api: ## Run Gamification end to end tests
	$(PHP_RUN) vendor/bin/behat -p gamification_end_to_end_api -f progress -c config/tests/gamification/behat.yml

.PHONY: gamification-back
gamification-back: gamification-back-static gamification-phpspec gamification-acceptance gamification-end-to-end-api

.PHONY: gamification ## Run all the gamification tests
gamification: gamification-back

.PHONY: db-init
db-init:
	$(PHP_RUN) bin/console doctrine:database:drop --force
	$(PHP_RUN) bin/console doctrine:database:create
	$(PHP_RUN) bin/console doctrine:schema:update --force
