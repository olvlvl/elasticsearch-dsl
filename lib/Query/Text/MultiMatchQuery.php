<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\Option\HasMatchOptions;
use olvlvl\ElasticsearchDSL\Query\Option\MatchOptions;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MultiMatchQuery extends QueryAbstract implements HasMatchOptions
{
	use MatchOptions;
	use JsonSerializeAsSimpleOrExtended;

	const NAME = 'multi_match';

	const OPTION_TYPE = 'type';
	const OPTION_TIE_BREAKER = 'tie_breaker';

	protected const OPTIONS = self::MATCH_OPTIONS + [

		self::OPTION_TYPE,
		self::OPTION_TIE_BREAKER,

	];

	/**
	 * @var array
	 */
	private $fields;

	/**
	 * @var string
	 */
	private $query;

	public function __construct(array $fields, string $query, array $options = [])
	{
		$this->fields = $fields;
		$this->query = $query;

		parent::__construct($options);
	}

	public function type(?string $type)
	{
		$this->options[self::OPTION_TYPE] = $type;

		return $this;
	}

	public function tie_breaker(?float $tie_breaker)
	{
		$this->options[self::OPTION_TIE_BREAKER] = $tie_breaker;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => [ 'query' => $this->query, 'fields' => $this->fields ] + parent::jsonSerialize() ];
	}
}
