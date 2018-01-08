<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Term\FuzzyQuery;
use olvlvl\ElasticsearchDSL\Query\Term\IdsQuery;
use olvlvl\ElasticsearchDSL\Query\Term\PrefixQuery;
use olvlvl\ElasticsearchDSL\Query\Term\RegexpQuery;
use olvlvl\ElasticsearchDSL\Query\Term\TermQuery;
use olvlvl\ElasticsearchDSL\Query\Term\TermsQuery;
use olvlvl\ElasticsearchDSL\Query\Term\WildcardQuery;

class TermQueriesTest extends TestCase
{
	public function provideSerialization(): array
	{
		return [

			[
				<<<JSON
[
    {
        "term": {
            "field1": "value1"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->term('field1', 'value1');
				}
			],

			[
				<<<JSON
[
    {
        "term": {
            "field1": "value1"
        }
    },
    {
        "term": {
            "field2": {
                "value": "value2",
                "boost": 1.3
            }
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->term('field1', 'value1')
						->term('field2', 'value2', function (TermQuery $term) {
							$term->boost(1.3);
						});
				}
			],

			[
				<<<JSON
[
    {
        "terms": {
            "field1": [
                "value1",
                "value2"
            ]
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->terms('field1', [ 'value1', 'value2' ]);
				}
			],

			[
				<<<JSON
[
    {
        "terms": {
            "field1": [
                "value1",
                "value2"
            ]
        }
    },
    {
        "terms": {
            "field2": [
                "value3",
                "value4"
            ]
        }
    },
    {
        "terms": {
            "path": "path1",
            "id": "id1",
            "type": "type1",
            "index": "index1",
            "routing": "routing1"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->terms('field1', [ 'value1', 'value2' ])
						->terms('field2', [ 'value3', 'value4' ])
						->terms('', [], function (TermsQuery $terms) {
							$terms
								->path('path1')
								->id('id1')
								->type('type1')
								->index('index1')
								->routing('routing1');
						});
				}
			],

			[
				<<<JSON
[
    {
        "exists": {
            "field": "field1"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->exists('field1');
				}
			],

			[
				<<<JSON
[
    {
        "exists": {
            "field": "field1"
        }
    },
    {
        "exists": {
            "field": "field2"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->exists('field1')
						->exists('field2');
				}
			],

			[
				<<<JSON
[
    {
        "prefix": {
            "field1": "value1"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->prefix('field1', 'value1');
				}
			],

			[
				<<<JSON
[
    {
        "prefix": {
            "field1": "value1"
        }
    },
    {
        "prefix": {
            "field2": {
                "value": "value2",
                "boost": 1.5
            }
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->prefix('field1', 'value1')
						->prefix('field2', 'value2', function (PrefixQuery $query) {
							$query->boost(1.5);
						});
				}
			],

			[
				<<<JSON
[
    {
        "wildcard": {
            "field1": "value1"
        }
    }
]
JSON
				, [], function (HasTermQueries $query) {
					$query->wildcard('field1', 'value1');
				}
			],

			[
				<<<JSON
[
    {
        "wildcard": {
            "field1": "value1"
        }
    },
    {
        "wildcard": {
            "field2": {
                "value": "value2",
                "boost": 1.5
            }
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->wildcard('field1', 'value1')
						->wildcard('field2', 'value2', function (WildcardQuery $query) {
							$query->boost(1.5);
						});
				}
			],

			[
				<<<JSON
[
    {
        "regexp": {
            "field1": "value1"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->regexp('field1', 'value1');
				}
			],

			[
				<<<JSON
[
    {
        "regexp": {
            "field1": "value1"
        }
    },
    {
        "regexp": {
            "field2": {
                "value": "value2",
                "boost": 1.2,
                "flags": "my_flags",
                "max_determinized_states": 32
            }
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->regexp('field1', 'value1')
						->regexp('field2', 'value2', function (RegexpQuery $query) {
							$query
								->boost(1.2)
								->flags('my_flags')
								->max_determinized_states(32);
						});
				}
			],

			[
				<<<JSON
[
    {
        "fuzzy": {
            "field1": "value1"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->fuzzy('field1', 'value1');
				}
			],

			[ <<<JSON
[
    {
        "fuzzy": {
            "field1": "value1"
        }
    },
    {
        "fuzzy": {
            "field2": {
                "value": "value2",
                "boost": 1.7,
                "fuzziness": 12,
                "prefix_length": 3,
                "max_expansions": 32
            }
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->fuzzy('field1', 'value1')
						->fuzzy('field2', 'value2', function (FuzzyQuery $query) {
							$query
								->boost(1.7)
								->fuzziness(12)
								->prefix_length(3)
								->max_expansions(32);
						});
				}
			],

			[
				<<<JSON
[
    {
        "type": {
            "value": "type1"
        }
    }
]
JSON
			, [],
				function (HasTermQueries $query) {
					$query->type('type1');
				}
			],

			[
				<<<JSON
[
    {
        "type": {
            "value": "type1"
        }
    },
    {
        "type": {
            "value": "type2"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->type('type1')
						->type('type2');
				}
			],

			[
				<<<JSON
[
    {
        "ids": {
            "values": [
                "id1",
                "id2"
            ]
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->ids([ 'id1', 'id2' ]);
				}
			],

			[
				<<<JSON
[
    {
        "ids": {
            "values": [
                "id1",
                "id2"
            ]
        }
    },
    {
        "ids": {
            "values": [
                "id3",
                "id4"
            ],
            "type": "my_type"
        }
    }
]
JSON
				, [],
				function (HasTermQueries $query) {
					$query->ids([ 'id1', 'id2' ])
						->ids([ 'id3', 'id4' ], function (IdsQuery $query) {
							$query->type('my_type');
						});
				}
			],

		];
	}

	protected function makeInstance(array $args)
	{
		return new class() implements \JsonSerializable, HasTermQueries
		{
			use TermQueries {
				jsonSerializeTermQueries as public jsonSerialize;
			}

			public function __toString()
			{
				return json_encode($this, JSON_PRETTY_PRINT);
			}
		};
	}
}
