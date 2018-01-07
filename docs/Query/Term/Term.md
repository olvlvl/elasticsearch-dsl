# TermQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "term": {
        "user": "Kimchy"
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\TermQuery;

$query = new TermQuery('user', "Kimchy");
```

Boosting is also supported:

```json
{
    "term": {
        "user": {
            "value": "Kimchy",
            "boost": 1.5
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\TermQuery;

$query = (new TermQuery('user', "Kimchy"))
    ->boost(1.5);
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-term-query.html
