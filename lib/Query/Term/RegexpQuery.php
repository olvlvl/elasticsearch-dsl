<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\Option\BoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\HasBoostOption;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @property string|null $flags
 * @property int|null $max_determinized_states
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-regexp-query.html
 */
class RegexpQuery extends QueryAbstract implements HasBoostOption
{
	use BoostOption;
	use JsonSerializeAsSimpleOrExtended {
		jsonSerializeAsSimpleOrExtended as public jsonSerialize;
	}

	const NAME = 'regexp';

	private const OPTION_FLAGS = 'flags';
	private const OPTION_MAX_DETERMINIZED_STATES = 'max_determinized_states';

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @var mixed
	 */
	private $value;

	public function __construct(string $field, $value)
	{
		$this->field = $field;
		$this->value = $value;
	}

	public function flags(?string $flags)
	{
		$this->options[self::OPTION_FLAGS] = $flags;

		return $this;
	}

	public function max_determinized_states(?int $max_determinized_states)
	{
		$this->options[self::OPTION_MAX_DETERMINIZED_STATES] = $max_determinized_states;

		return $this;
	}
}
