# RegexpQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "regexp": {
        "name.first": "s.*y"
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\RegexpQuery;

$query = new RegexpQuery('name.first', "s.*y");
```

Boosting is also supported:

```json
{
    "regexp": {
        "name.first": {
            "value": "s.*y",
            "boost": 1.5
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\RegexpQuery;

$query = (new RegexpQuery('name.first', "s.*y"))
    ->boost(1.5);
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-regexp-query.html
