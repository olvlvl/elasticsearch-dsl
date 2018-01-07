# BoolQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "bool": {
        "must": {
            "term": { "user": "kimchy" }
        },
        "filter": {
            "term": { "tag": "tech" }
        },
        "must_not": {
            "range": {
                "age": { "gte": 10, "lte": 20 }
            }
        },
        "should": [
            { "term": { "tag": "wow" } },
            { "term": { "tag": "elasticsearch" } }
        ],
        "minimum_should_match": 1,
        "boost": 1.5
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;
use olvlvl\ElasticsearchDSL\Query\Term\RangeQuery;

$query = (new BoolQuery)
    ->minimum_should_match(1)
    ->boost(1.5);
$query->must->term("user", "kimchy");
$query->filter->term("tag", "tech");
$query->must_not->range("age", function (RangeQuery $range) {
	$range->gte(10)->lte(20);
});
$query->should
    ->term("tag", "wow")
    ->term("tag", "elasticsearch");
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-bool-query.html
