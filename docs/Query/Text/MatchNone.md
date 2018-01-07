# MatchNoneQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "match_none" : {}
}
```

```php
<?php

use olvlvl\ElasticsearchDSL\Query\Text\MatchNoneQuery;

$match = new MatchNoneQuery;

echo $match;
```

[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-all-query.html#query-dsl-match-none-query
