# DisMaxQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "dis_max": {
        "tie_breaker": 0.7,
        "boost": 1.2,
        "queries": [
            {
                "term": { "age": 34 }
            },
            {
                "term": { "age": 35 }
            }
        ]
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Compound\DisMaxQuery;

$query = (new DisMaxQuery)->tie_breaker(0.7)->boost(1.2);
$query->queries->term("age", 34);
$query->queries->term("age", 35);
```





## Inside a query

```json
{
    "query": {
        "dis_max": {
            "tie_breaker": 0.7,
            "boost": 1.2,
            "queries": [
                {
                    "term": { "age": 34 }
                },
                {
                    "term": { "age": 35 }
                }
            ]
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query;
$query->dis_max->tie_breaker(0.7)->boost(1.2);
$query->dis_max->queries->term("age", 34);
$query->dis_max->queries->term("age", 35);
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-dis-max-query.html
