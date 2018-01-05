<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\Option\BoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\FuzzyOptions;
use olvlvl\ElasticsearchDSL\Query\Option\HasBoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\HasFuzzyOptions;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-fuzzy-query.html
 */
class FuzzyQuery extends QueryAbstract implements HasFuzzyOptions, HasBoostOption
{
	use FuzzyOptions;
	use BoostOption;
	use JsonSerializeAsSimpleOrExtended {
		jsonSerializeAsSimpleOrExtended as public jsonSerialize;
	}

	const NAME = 'fuzzy';

	protected const OPTIONS = self::FUZZY_OPTIONS + [

		self::OPTION_BOOST,

	];

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @var mixed
	 */
	private $value;

	public function __construct(string $field, $value, array $options = [])
	{
		$this->field = $field;
		$this->value = $value;

		parent::__construct($options);
	}
}
