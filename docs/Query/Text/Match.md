# MatchQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "match" : {
        "message" : "this is a test"
    }
}
```

```php
<?php

use olvlvl\ElasticsearchDSL\Query\Text\MatchQuery;

$query = new MatchQuery('message', "this is a test");

echo $query;
```

[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-query.html
