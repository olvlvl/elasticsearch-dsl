<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\Option\BoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\HasBoostOption;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-prefix-query.html
 */
class PrefixQuery extends QueryAbstract implements HasBoostOption
{
	use BoostOption;
	use JsonSerializeAsSimpleOrExtended {
		jsonSerializeAsSimpleOrExtended as public jsonSerialize;
	}

	const NAME = 'prefix';

	protected const OPTIONS = [

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
