.DEFAULT_GOAL := help

CURRENT_DIR := $(shell pwd)
check_var = $(if $(strip $(shell echo "$2")),,$(error "$1" is not defined))

.PHONY: help
help:
	@echo ""
	@echo "Badger available targets: "
	@echo ""
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'


################################################### Static analytics ###################################################
.PHONY: stan
stan: ## Run PHPStan
	docker-compose exec fpm vendor/bin/phpstan analyse src -c config/tests/phpstan.neon -l 7


####################################################### Docker     #####################################################

.PHONY: start
start: ## Start the project
	docker-compose up -d

.PHONY: stop
stop: ## Stop the projet
	docker-compose stop

.PHONY: down
down: ## Down the project
	docker-compose down -v

.PHONY: install
install: ## Composer install
	docker-compose exec fpm composer install

.PHONY: composer
composer: ## composer
	docker-compose exec fpm composer ${F}

.PHONY: update
update: ## Composer update
	docker-compose exec fpm composer update

##################################################### Gamification #####################################################
.PHONY: run-gamification-cs
run-gamification-cs: ## Run Gamification Coding Style fixer
	docker-compose exec fpm vendor/bin/php-cs-fixer fix --config=config/tests/gamification/.php_cs --diff --dry-run

.PHONY: run-gamification-phpspec
run-gamification-phpspec: ## Run Gamification PHPSpec
	docker-compose exec fpm vendor/bin/phpspec run --config config/tests/gamification/phpspec.yml

.PHONY: run-gamification-phpspec-desc
run-gamification-phpspec-desc: ## Run Gamification PHPSpec describe
	docker-compose exec fpm vendor/bin/phpspec describe --config config/tests/gamification/phpspec.yml

.PHONY: run-gamification-acceptance
run-gamification-acceptance: ## Run Gamification acceptance tests
	docker-compose exec fpm vendor/bin/behat -p gamification_acceptance -f progress -c config/tests/gamification/behat.yml

.PHONY: gamification
gamification: run-gamification-cs run-gamification-phpspec run-gamification-acceptance
