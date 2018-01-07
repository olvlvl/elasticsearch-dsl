# ElasticsearchDSL

[![Release](https://img.shields.io/packagist/v/olvlvl/elasticsearch-dsl.svg)](https://packagist.org/packages/olvlvl/elasticsearch-dsl)
[![Build Status](https://img.shields.io/travis/olvlvl/elasticsearch-dsl.svg)](http://travis-ci.org/olvlvl/elasticsearch-dsl)
[![Code Quality](https://img.shields.io/scrutinizer/g/olvlvl/elasticsearch-dsl.svg)](https://scrutinizer-ci.com/g/olvlvl/elasticsearch-dsl)
[![Code Coverage](https://img.shields.io/coveralls/olvlvl/elasticsearch-dsl.svg)](https://coveralls.io/r/olvlvl/elasticsearch-dsl)
[![Packagist](https://img.shields.io/packagist/dt/olvlvl/elasticsearch-dsl.svg)](https://packagist.org/packages/olvlvl/elasticsearch-dsl)

The `olvlvl/elasticsearch-dsl` package provides an objective query builder for Elasticsearch. It
helps you create [Elasticsearch](https://www.elastic.co/products/elasticsearch) queries using
the same language as you would use writing arrays by hand.

I created this library because I found using
[ongr-io/ElasticsearchDSL](https://github.com/ongr-io/ElasticsearchDSL), the only other
available option, very cumbersome, and I wanted an interface that would feel more natural
regarding Elasticsearch language.

> I've been working on this library since January, it's far from being feature complete, but I'm
> getting there :) If you'd like to help please submit a PR.





### A simple example

Here is a simple example, take from [Elasticsearch documentation][1]. More are available in
[our documentation](docs/README.md).

```json
{
    "query": {
        "bool": {
            "must": [
                { "match": { "title": "Search" } },
                { "match": { "content": "Elasticsearch" } }
            ],
            "filter": [
                { "term": { "status": "published" } },
                { "range": { "publish_date": { "gte": "2015-01-01" } } }
            ]
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query;
$query->bool->must
    ->match('title', "Search")
    ->match('content', "Elasticsearch");
$query->bool->filter
    ->term('status', 'published')
    ->range('publish_date', [
        Query\Term\RangeQuery::OPTION_GTE => "2015-01-01"
    ]);
```

[See more examples](docs/README.md)





----------





## Requirements

The package requires PHP 7.1 or later.





## Installation

The recommended way to install this package is through [Composer](http://getcomposer.org/):

	$ composer require olvlvl/elasticsearch-dsl





### Cloning the repository

The package is [available on GitHub](https://github.com/olvlvl/elasticsearch-dsl),
its repository can be cloned with the following command line:

	$ git clone https://github.com/olvlvl/elasticsearch-dsl.git





## Documentation

You can generate the documentation for the package and its dependencies with the `make doc` command.
The documentation is generated in the `build/docs` directory. [ApiGen](http://apigen.org/) is
required. The directory can later be cleaned with the `make clean` command.





## Testing

The test suite is ran with the `make test` command. [PHPUnit](https://phpunit.de/) and
[Composer](http://getcomposer.org/) need to be globally available to run the suite. The command
installs dependencies as required. The `make test-coverage` command runs test suite and also creates
an HTML coverage report in `build/coverage`. The directory can later be cleaned with the
`make clean` command.

The package is continuously tested by [Travis CI](http://about.travis-ci.org/).

[![Build Status](https://img.shields.io/travis/olvlvl/elasticsearch-dsl.svg)](http://travis-ci.org/olvlvl/elasticsearch-dsl)
[![Code Coverage](https://img.shields.io/coveralls/olvlvl/elasticsearch-dsl.svg)](https://coveralls.io/r/olvlvl/elasticsearch-dsl)





## License

**olvlvl/elasticsearch-dsl** is licensed under the New BSD License - See the [LICENSE](LICENSE) file for details.






[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-filter-context.html
