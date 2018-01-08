<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

class ConstantScoreQuery extends BoolQuery
{
	const NAME = 'constant_score';

	public function __construct(float $score = 1.0)
	{
		$this->boost($score);

		parent::__construct();
	}
}
