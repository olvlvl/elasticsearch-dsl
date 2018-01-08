<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Option\HasMatchOptions;
use olvlvl\ElasticsearchDSL\Query\Option\MatchOptions;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MultiMatchQuery extends QueryAbstract implements HasMatchOptions
{
	use MatchOptions;

	const NAME = 'multi_match';

	/**
	 * @var array
	 */
	private $fields;

	/**
	 * @var string
	 */
	private $query;

	public function __construct(array $fields, string $query)
	{
		$this->fields = $fields;
		$this->query = $query;
	}

	public function type(?string $type)
	{
		$this->options[__FUNCTION__] = $type;

		return $this;
	}

	public function tie_breaker(?float $tie_breaker)
	{
		$this->options[__FUNCTION__] = $tie_breaker;

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
