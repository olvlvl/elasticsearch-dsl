# TypeQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "type": {
        "value": "my_type"
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\TypeQuery;

$query = new TypeQuery("my_type");
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-type-query.html
