<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\BoostingQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\ConstantScoreQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\DisMaxQuery;

trait CompoundQueries
{
	/**
	 * @var BoolQuery[]
	 */
	private $bool_queries = [];

	protected function get_bool()
	{
		$query = reset($this->bool_queries);

		return $query ? $query : $this->bool();
	}

	public function bool(): BoolQuery
	{
		$this->bool_queries[] = $query = new BoolQuery();

		return $query;
	}

	/**
	 * @var BoostingQuery[]
	 */
	private $boosting_queries = [];

	protected function get_boosting()
	{
		$query = reset($this->boosting_queries);

		return $query ? $query : $this->boosting();
	}

	public function boosting(float $negative_boost = .5): BoostingQuery
	{
		$this->boosting_queries[] = $query = new BoostingQuery($negative_boost);

		return $query;
	}

	/**
	 * @var ConstantScoreQuery[]
	 */
	private $constant_score_queries = [];

	protected function get_constant_score()
	{
		$query = reset($this->constant_score_queries);

		return $query ? $query : $this->constant_score();
	}

	public function constant_score(float $score = 1.0): ConstantScoreQuery
	{
		$this->constant_score_queries[] = $query = new ConstantScoreQuery($score);

		return $query;
	}

	/**
	 * @var DisMaxQuery[]
	 */
	private $dis_max_queries = [];

	protected function get_dis_max()
	{
		$query = reset($this->dis_max_queries);

		return $query ? $query : $this->dis_max();
	}

	public function dis_max(array $options = []): DisMaxQuery
	{
		$this->dis_max_queries[] = $query = new DisMaxQuery($options);

		return $query;
	}

	protected function jsonSerializeCompoundQueries(): array
	{
		return Helpers::filter_merge(
			$this->bool_queries,
			$this->boosting_queries,
			$this->constant_score_queries,
			$this->dis_max_queries
		);
	}
}
