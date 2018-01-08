# How to build queries with Elasticsearch DSL

`olvlvl-elasticsearch-dsl` tries to keep things as simple as possible by using the same language
as Elasticsearch, there should almost no difference in the way you build your queries. Let's have
a look at some examples.





## A simple query

`match_all` is the most simple query. It matches all documents, giving them all a `_score` of `1.0`.

```json
{
    "query": {
        "match_all": {}
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query;
$query->match_all();
```

Granted, it's not super impressive, let's try something a little more complex.





## Query and filter context

> BTW, queries are rendered using JSON_PRETTY_PRINT but the following JSON examples have a more
> compact presentation.

```json
{
    "query": {
        "bool": {
            "must": [
                { "match": { "title": "Search" } },
                { "match": { "content": "Elasticsearch" } }
            ],
            "filter": [
                { "term": { "status": "published" } },
                { "range": { "publish_date": { "gte": "2015-01-01" } } }
            ]
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query;
$query->bool->must
    ->match('title', "Search")
    ->match('content', "Elasticsearch");
$query->bool->filter
    ->term('status', 'published')
    ->range('publish_date', function (Query\Term\RangeQuery $range) {
    	$range->gte("2015-01-01");
    });
```





## Multiple boolean queries

The following example demonstrates how to create a _should_ query with two _bool_ queries, notice
how we use `->bool()` instead of `->bool`. `bool` always returns the same instance while `bool()`
always create a new one.

```json
{
    "query": {
        "bool": {
            "filter": {
                "term": { "grade": "2" }
            },
            "should": [
                {
                    "bool": {
                        "must": [
                            { "match": { "preference_1": "Apples" } },
                            { "match": { "preference_2": "Bananas" } }
                        ]
                    }
                },
                {
                    "bool": {
                        "must": [
                            { "match": { "preference_1": "Apples" } },
                            { "match": { "preference_2": "Cherries" } }
                        ]
                    }
                },
                {
                    "match": { "preference_1": "Grapefruit" }
                }
            ]
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query; 
$query->bool->should->bool()->must
    ->match("preference_1", "Apples")
    ->match("preference_2", "Bananas");
$query->bool->should->bool()->must
    ->match("preference_1", "Apples")
    ->match("preference_2", "Cherries");
$query->bool->should->match("preference_1", "Grapefruit");
$query->bool->filter->term("grade", "2");
```





## A nested query

The following example demonstrates how to create a nested query:

```json
{
    "query": {
        "nested": {
            "path": "menus",
            "score_mode": "avg",
            "ignore_unmapped": true,
            "query": {
                "bool": {
                    "filter": [
                        { "term": { "menus.week": "2018-W03" } },
                        { "term": { "menus.product": "express-box" } }
                    ]
                }
            }
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query; 
$query->nested("menus")
    ->score_mode('avg')
    ->ignore_unmapped(true)
    ->query->bool->filter
        ->term("menus.week", "2018-W03")
        ->term("menus.product", "express-box");
```





## A nested query within a bool query

```json
{
    "query": {
        "bool": {
            "must": {
                "nested": {
                    "path": "menus",
                    "query": {
                        "bool": {
                            "filter": [
                                { "term": { "menus.product": "express-box" } },
                                { "term": { "menus.week": "2018-W03" } }
                            ]
                        }
                    }
                }
            },
            "filter": { "term": { "tags.slug": "under-30-minutes" } }
        }
    }
}
```
```php
<?php

use olvlvl\ElasticsearchDSL\Query;

$query = new Query;
$query->bool->filter
    ->term('tags.slug', "under-30-minutes");
$query->bool->must->nested("menus")->query->bool->filter
    ->term("menus.product", "express-box")
    ->term("menus.week", "2018-W03");
```





[Elasticsearch documentation]: https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl.html
