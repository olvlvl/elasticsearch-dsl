<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

/**
 * @property-read BoolQuery $bool
 */
interface HasBoolQueries
{
	public function bool(): BoolQuery;
}
