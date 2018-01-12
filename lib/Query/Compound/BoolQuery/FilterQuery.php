<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\BoolQueries;
use olvlvl\ElasticsearchDSL\Query\HasBoolQueries;
use olvlvl\ElasticsearchDSL\Query\HasTermQueries;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;
use olvlvl\ElasticsearchDSL\Query\TermQueries;

class FilterQuery extends QueryAbstract implements HasTermQueries, HasBoolQueries
{
	use TermQueries;
	use BoolQueries;

	const NAME = 'filter';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => Helpers::merge_and_prefer_single(

			$this->jsonSerializeTermQueries(),
			$this->jsonSerializeBoolQueries()

		) ];
	}
}
