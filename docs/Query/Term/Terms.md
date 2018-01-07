# TermsQuery

> More info about this query in the [official elasticsearch docs][1].

```json
{
    "terms": {
        "user": [ "Kimchy", "Elasticsearch" ]
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\TermsQuery;

$query = new TermsQuery('user', [ "Kimchy", "Elasticsearch" ]);
```

Terms lookup mechanism:

```json
{
    "terms": {
        "user": {
            "index": "users",
            "type": "user",
            "id": "2",
            "path": "followers"
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query\Term\TermsQuery;

$query = (new TermsQuery(null, null))
    ->index("users")
    ->type("user")
    ->id("2")
    ->path("followers");
```





[1]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-terms-query.html
