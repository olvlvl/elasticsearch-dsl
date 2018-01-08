<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\BoostingQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\ConstantScoreQuery;

/**
 * @property-read BoolQuery $bool
 * @property-read ConstantScoreQuery $constant_score
 * @property-read BoostingQuery $boosting
 */
interface HasCompoundQueries
{
	public function bool(): BoolQuery;
	public function constant_score(float $score = 1.0): ConstantScoreQuery;
	public function boosting(float $negative_boost = .5): BoostingQuery;
}
