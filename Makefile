################################################### Static analytics ###################################################
.PHONY: stan
stan:
	vendor/bin/phpstan analyse src -c config/tests/phpstan.neon -l 7

##################################################### Gamification #####################################################
.PHONY: run-gamification-cs
run-gamification-cs:
	vendor/bin/php-cs-fixer fix --config=config/tests/gamification/.php_cs --diff --dry-run

.PHONY: run-gamification-phpspec
run-gamification-phpspec:
	vendor/bin/phpspec run --config config/tests/gamification/phpspec.yml

.PHONY: run-gamification-acceptance
run-gamification-acceptance:
	vendor/bin/behat -p gamification_acceptance -f progress -c config/tests/gamification/behat.yml
