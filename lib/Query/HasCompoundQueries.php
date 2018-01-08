<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\BoostingQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\ConstantScoreQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\DisMaxQuery;

/**
 * @property-read BoolQuery $bool
 * @property-read BoostingQuery $boosting
 * @property-read ConstantScoreQuery $constant_score
 * @property-read DisMaxQuery $dis_max
 */
interface HasCompoundQueries
{
	public function bool(): BoolQuery;
	public function boosting(float $negative_boost = .5): BoostingQuery;
	public function constant_score(float $score = 1.0): ConstantScoreQuery;
	public function dis_max(array $options): DisMaxQuery;
}
