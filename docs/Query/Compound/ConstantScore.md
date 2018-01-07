# ConstantScoreQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "constant_score": {
        "filter": {
            "term": { "user": "kimchy" }
        },
        "boost": 1.2
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Compound\ConstantScoreQuery;

$query = new ConstantScoreQuery(1.2);
$query->filter->term("user", "kimchy");
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-constant-score-query.html
