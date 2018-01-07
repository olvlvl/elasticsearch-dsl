<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\ConstantScoreQuery;

/**
 * @property-read BoolQuery $bool
 */
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

	protected function jsonSerializeCompoundQueries(): array
	{
		return Helpers::filter_merge(
			$this->bool_queries,
			$this->constant_score_queries
		);
	}
}
