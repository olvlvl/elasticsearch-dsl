# PrefixQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "prefix" : {
        "user" : "ki"
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\PrefixQuery;

$query = new PrefixQuery('user', "ki");
```

A boost can also be associated with the query:

```json
{
    "prefix": {
        "user": {
            "value": "ki",
            "boost": 1.5
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\PrefixQuery;

$query = (new PrefixQuery('user', "ki"))
    ->boost(1.5);
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-prefix-query.html
