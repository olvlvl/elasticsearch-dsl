# ElasticsearchDSL

The `olvlvl/elasticsearch-dsl` package provides an objective query builder for Elasticsearch. It
helps you create [Elasticsearch](https://www.elastic.co/products/elasticsearch) queries using
the same language as you would use writing arrays by hand.

I created this library because I found using [ongr-io/ElasticsearchDSL](https://github.com/ongr-io/ElasticsearchDSL), the only other available option, very cumbersome, and I wanted an interface that would feel more natural regarding Elasticsearch language.

### Disclaimer

I've been working on this library since January, it's far from being feature complete, but I'm getting there :) If you feel like helping please submit a PR.





## Examples

The following example demonstrates how a simple boolean query can be created: 

```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query; 
$query->bool->must
	->term("user", "kimchy");
$query->bool->must_not
	->range("age", function (Query\Term\RangeQuery $range) {
		$range->from(10)->to(10);
	});
$query->bool->should
	->term("tag", "wow")
	->term("tag", "elasticsearch");
$query->bool
	->minimum_should_match(1)
	->boost(1.5);

echo $query;
```
```json
{
    "query": {
        "bool": {
            "must": {
                "term": {
                    "user": "kimchy"
                }
            },
            "should": [
                {
                    "term": {
                        "tag": "wow"
                    }
                },
                {
                    "term": {
                        "tag": "elasticsearch"
                    }
                }
            ],
            "must_not": {
                "range": {
                    "age": {
                        "from": 10,
                        "to": 10
                    }
                }
            },
            "minimum_should_match": 1,
            "boost": 1.5
        }
    }
}
```

The following example demonstrates how to create a _should_ query with two _bool_ queries:

```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query; 
$query->bool->should->bool()->must
	->match("preference_1", "Apples")
	->match("preference_2", "Bananas");
$query->bool->should->bool()->must
	->match("preference_1", "Apples")
	->match("preference_2", "Cherries");
$query->bool->should->match("preference_1", "Grapefruit");
$query->bool->filter->term("grade", "2");

echo $query;
```
```json
{
    "query": {
        "bool": {
            "filter": {
                "term": {
                    "grade": "2"
                }
            },
            "should": [
                {
                    "bool": {
                        "must": [
                            {
                                "match": {
                                    "preference_1": "Apples"
                                }
                            },
                            {
                                "match": {
                                    "preference_2": "Bananas"
                                }
                            }
                        ]
                    }
                },
                {
                    "bool": {
                        "must": [
                            {
                                "match": {
                                    "preference_1": "Apples"
                                }
                            },
                            {
                                "match": {
                                    "preference_2": "Cherries"
                                }
                            }
                        ]
                    }
                },
                {
                    "match": {
                        "preference_1": "Grapefruit"
                    }
                }
            ]
        }
    }
}
```

The following example demonstrates how to create a nested query:

```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query; 
$query->nested("menus")
	->score_mode('avg')
	->ignore_unmapped(true)
	->query->bool->filter
		->term("menus.week", "2018-W03")
		->term("menus.product", "express-box");
echo $query;
```
```json
{
    "query": {
        "nested": {
            "path": "menus",
            "score_mode": "avg",
            "ignore_unmapped": true,
            "query": {
                "bool": {
                    "filter": [
                        {
                            "term": {
                                "menus.week": "2018-W03"
                            }
                        },
                        {
                            "term": {
                                "menus.product": "express-box"
                            }
                        }
                    ]
                }
            }
        }
    }
}
```





----------





## Requirements

The package requires PHP 7.1 or later.





## Installation

The recommended way to install this package is through [Composer](http://getcomposer.org/):

	$ composer require olvlvl/elasticsearch-dsl





### Cloning the repository

The package is [available on GitHub][https://github.com/olvlvl/elasticsearch-dsl],
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
