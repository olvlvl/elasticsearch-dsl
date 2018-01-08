# MatchPhrasePrefixQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "match_phrase_prefix": {
        "message": {
            "query": "quick brown f",
            "max_expansions": 10
        }
    }
}
```

```php
<?php

use olvlvl\ElasticsearchDSL\Query\Text\MatchPhrasePrefixQuery;

$query = (new MatchPhrasePrefixQuery('message', "quick brown f"))
    ->max_expansions(10);
```

[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-query-phrase-prefix.html
