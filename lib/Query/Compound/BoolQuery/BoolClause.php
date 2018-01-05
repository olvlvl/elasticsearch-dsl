<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\CompoundQueries;
use olvlvl\ElasticsearchDSL\Query\HasCompoundQueries;
use olvlvl\ElasticsearchDSL\Query\HasTermQueries;
use olvlvl\ElasticsearchDSL\Query\HasTextQueries;
use olvlvl\ElasticsearchDSL\Query\TermQueries;
use olvlvl\ElasticsearchDSL\Query\TextQueries;

class BoolClause implements \JsonSerializable, HasCompoundQueries, HasTextQueries, HasTermQueries
{
	use AccessorTrait;
	use CompoundQueries;
	use TextQueries;
	use TermQueries;

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return Helpers::merge_and_prefer_single(
			$this->jsonSerializeCompoundQueries(),
			$this->jsonSerializeTextQueries(),
			$this->jsonSerializeTermQueries()
		);
	}
}
