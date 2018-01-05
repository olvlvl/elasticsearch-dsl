<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

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
		$bool = reset($this->bool_queries);

		return $bool ? $bool : $this->bool();
	}

	public function bool(): BoolQuery
	{
		$this->bool_queries[] = $bool = new BoolQuery();

		return $bool;
	}

	protected function jsonSerializeCompoundQueries(): array
	{
		return Helpers::filter_merge(
			$this->bool_queries
		);
	}
}
