<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class TypeQuery extends QueryAbstract
{
	const NAME = 'type';

	protected const OPTIONS = [

	];

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @param string $type
	 */
	public function __construct(string $type)
	{
		$this->type = $type;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => [ 'value' => $this->type ] ];
	}
}
