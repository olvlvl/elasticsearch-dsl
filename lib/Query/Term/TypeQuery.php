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
	 * @param array $options
	 */
	public function __construct(string $type, array $options = [])
	{
		$this->type = $type;

		parent::__construct($options);
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => [ 'value' => $this->type ] ];
	}
}
