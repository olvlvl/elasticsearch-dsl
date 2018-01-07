# WildcardQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "wildcard": {
        "user": "ki*y"
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\WildcardQuery;

$query = new WildcardQuery('user', "ki*y");
```

Boosting is also supported:

```json
{
    "wildcard": {
        "user": {
            "value": "ki*y",
            "boost": 1.5
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\WildcardQuery;

$query = (new WildcardQuery('user', "ki*y"))
    ->boost(1.5);
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-wildcard-query.html
