# NestedQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "nested": {
        "path": "obj1",
        "score_mode": "avg",
        "query": {
            "bool": {
                "must": [
                    { "match": { "obj1.name": "blue" } },
                    { "range": { "obj1.count": { "gt": 5 } } }
                ]
            }
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Joining\NestedQuery;
use olvlvl\ElasticsearchDSL\Query\Term\RangeQuery;

$query = (new NestedQuery('obj1'))
    ->score_mode('avg')
    ->query->bool->must
        ->match('obj1.name', "blue")
        ->range('obj1.count', function (RangeQuery $range) {
        	$range->gt(5);
        });
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-nested-query.html
