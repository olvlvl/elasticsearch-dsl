# IdsQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "ids" : {
        "type" : "my_type",
        "values": [ "1", "4", "100" ]
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\IdsQuery;

$query = (new IdsQuery([ "1", "4", "100" ]))
    ->type("my_type");
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-ids-query.html
