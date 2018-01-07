# MatchPhraseQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "match_phrase": {
        "message": {
            "query": "this is a test",
            "analyzer": "my_analyzer"
        }
    }
}
```

```php
<?php

use olvlvl\ElasticsearchDSL\Query\Text\MatchPhraseQuery;

$query = (new MatchPhraseQuery('message', "this is a test"))
    ->analyzer("my_analyzer");

echo $query;
```

[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-query-phrase.html
