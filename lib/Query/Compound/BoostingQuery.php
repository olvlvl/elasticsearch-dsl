<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery\FilterQuery;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @property-read FilterQuery $positive
 * @property-read FilterQuery $negative
 */
class BoostingQuery extends QueryAbstract
{
	const NAME = 'boosting';

	/**
	 * @var FilterQuery
	 */
	private $positive;

	protected function get_positive(): FilterQuery
	{
		return $this->positive ?: $this->positive = new FilterQuery;
	}

	/**
	 * @var FilterQuery
	 */
	private $negative;

	protected function get_negative(): FilterQuery
	{
		return $this->negative ?: $this->negative = new FilterQuery;
	}

	/**
	 * @var float
	 */
	private $negative_boost;

	public function __construct(float $negative_boost = 0.5)
	{
		$this->negative_boost = $negative_boost;

		parent::__construct();
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
