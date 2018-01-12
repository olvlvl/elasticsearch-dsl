<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

trait BoolQueries
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

	protected function jsonSerializeBoolQueries()
	{
		return Helpers::filter_merge(
			$this->bool_queries
		);
	}
}
