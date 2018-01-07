# MatchAllQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "match_all" : {
        "boost" : 1.5
    }
}
```

```php
<?php

use olvlvl\ElasticsearchDSL\Query\Text\MatchAllQuery;

$query = (new MatchAllQuery)
    ->boost(1.5);

echo $query;
```

[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-all-query.html
