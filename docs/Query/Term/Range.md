# RangeQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "range": {
        "age": {
            "gte": 10,
            "lte": 20,
            "boost": 1.5
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\RangeQuery;

$query = (new RangeQuery('age'))
    ->gte(10)
    ->lte(20)
    ->boost(1.5);
```

Date format in range queries:

```json
{
    "range": {
        "born": {
            "gte": "01/01/2012",
            "lte": "2013",
            "format": "dd/MM/yyyy||yyyy"
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\RangeQuery;

$query = (new RangeQuery('born'))
    ->gte("01/01/2012")
    ->lte("2013")
    ->format("dd/MM/yyyy||yyyy");
```

[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-range-query.html
