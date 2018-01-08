# BoostingQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "boosting": {
        "positive": {
            "term": { "field1": "value1" }
        },
        "negative": {
            "term": { "field2": "value2" }
        },
        "negative_boost": 0.2
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Compound\BoostingQuery;

$query = new BoostingQuery(.2);
$query->positive->term("field1", "value1");
$query->negative->term("field2", "value2");
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-boosting-query.html
