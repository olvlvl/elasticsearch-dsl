# FuzzyQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "fuzzy": {
        "user": "ki"
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\FuzzyQuery;

$query = new FuzzyQuery('user', "ki");
```

Or with more advanced settings:

```json
{
    "fuzzy": {
        "user": {
            "value": "ki",
            "boost": 1.5,
            "fuzziness": 2,
            "prefix_length": 0,
            "max_expansions": 100
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\FuzzyQuery;

$query = (new FuzzyQuery('user', "ki"))
    ->boost(1.5)
    ->fuzziness(2)
    ->prefix_length(0)
    ->max_expansions(100);
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-fuzzy-query.html
