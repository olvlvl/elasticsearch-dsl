<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class ExistsQuery extends QueryAbstract
{
	const NAME = 'exists';

	protected const OPTIONS = [

	];

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @param string $field
	 * @param array $options
	 */
	public function __construct(string $field, array $options = [])
	{
		$this->field = $field;

		parent::__construct($options);
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => [ 'field' => $this->field ] ];
	}
}
