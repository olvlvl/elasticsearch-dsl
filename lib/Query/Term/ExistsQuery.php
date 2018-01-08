<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class ExistsQuery extends QueryAbstract
{
	const NAME = 'exists';

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @param string $field
	 */
	public function __construct(string $field)
	{
		$this->field = $field;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => [ 'field' => $this->field ] ];
	}
}
