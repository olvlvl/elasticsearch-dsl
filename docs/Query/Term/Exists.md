# ExistsQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "exists" : {
        "field" : "user"
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\ExistsQuery;

$query = new ExistsQuery('user');
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-exists-query.html
