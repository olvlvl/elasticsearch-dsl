<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\TermQueries;

class FilterQuery implements \JsonSerializable
{
	use TermQueries;

	const NAME = 'filter';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return Helpers::prefer_single(
			$this->jsonSerializeTermQueries()
		);
	}
}
