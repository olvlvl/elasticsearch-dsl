<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\HasTermQueries;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;
use olvlvl\ElasticsearchDSL\Query\TermQueries;

class FilterQuery extends QueryAbstract implements HasTermQueries
{
	use TermQueries;

	const NAME = 'filter';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => Helpers::prefer_single(

			$this->jsonSerializeTermQueries()

		) ];
	}
}
