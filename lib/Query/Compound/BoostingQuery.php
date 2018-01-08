<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;
use olvlvl\ElasticsearchDSL\Query\QueryCollection;

/**
 * @property-read QueryCollection $positive
 * @property-read QueryCollection $negative
 */
class BoostingQuery extends QueryAbstract
{
	const NAME = 'boosting';

	/**
	 * @var QueryCollection
	 */
	private $positive;

	protected function get_positive(): QueryCollection
	{
		return $this->positive ?: $this->positive = new QueryCollection;
	}

	/**
	 * @var QueryCollection
	 */
	private $negative;

	protected function get_negative(): QueryCollection
	{
		return $this->negative ?: $this->negative = new QueryCollection;
	}

	/**
	 * @var float
	 */
	private $negative_boost;

	public function __construct(float $negative_boost = 0.5)
	{
		$this->negative_boost = $negative_boost;
	}

	public function jsonSerialize()
	{
		return [ self::NAME => array_filter([

			'positive' => $this->positive,
			'negative' => $this->negative,
			'negative_boost' => $this->negative_boost,

		]) ];
	}
}
