# customization

PACKAGE_NAME = olvlvl/elasticsearch-dsl
PACKAGE_VERSION = 1.0
PHPUNIT_VERSION = phpunit-7.5.phar
PHPUNIT_FILENAME = build/$(PHPUNIT_VERSION)
PHPUNIT = php $(PHPUNIT_FILENAME)

# do not edit the following lines

usage:
	@echo "test:  Runs the test suite.\ndoc:   Creates the documentation.\nclean: Removes the documentation, the dependencies and the Composer files."

vendor:
	@COMPOSER_ROOT_VERSION=$(PACKAGE_VERSION) composer install

update:
	@COMPOSER_ROOT_VERSION=$(PACKAGE_VERSION) composer update

$(PHPUNIT_FILENAME):
	mkdir -p build
	curl -o $(PHPUNIT_FILENAME) -L https://phar.phpunit.de/$(PHPUNIT_VERSION)

test-setup: vendor $(PHPUNIT_FILENAME)

test: test-setup
	@$(PHPUNIT)

test-coverage: test-setup
	@mkdir -p build/coverage
	@$(PHPUNIT) --coverage-html build/coverage

test-coveralls: test-setup
	@mkdir -p build/logs
	COMPOSER_ROOT_VERSION=$(PACKAGE_VERSION) composer require php-coveralls/php-coveralls '^2.0'
	@$(PHPUNIT) --coverage-clover build/logs/clover.xml
	php vendor/bin/php-coveralls -v

doc: vendor
	@mkdir -p build/docs
	@apigen generate \
	--source lib \
	--destination build/docs/ \
	--title "$(PACKAGE_NAME) v$(PACKAGE_VERSION)" \
	--template-theme "bootstrap"

clean:
	@rm -fR build
	@rm -fR vendor
	@rm -f composer.lock

.PHONY: all doc clean test test-coverage test-coveralls test-setup update
