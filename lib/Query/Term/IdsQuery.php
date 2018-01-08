<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @property string|null $type
 */
class IdsQuery extends QueryAbstract
{
	const NAME = 'ids';

	const OPTION_TYPE = 'type';

	protected const OPTIONS = [

		self::OPTION_TYPE,

	];

	/**
	 * @var array
	 */
	private $values;

	/**
	 * @param array $values
	 */
	public function __construct(array $values)
	{
		$this->values = $values;
	}

	/**
	 * @param string|null $type
	 *
	 * @return $this
	 */
	public function type(?string $type)
	{
		$this->options[self::OPTION_TYPE] = $type;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => [ 'values' => $this->values ] + parent::jsonSerialize() ];
	}
}
