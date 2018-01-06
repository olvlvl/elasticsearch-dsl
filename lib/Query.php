<?php

namespace olvlvl\ElasticsearchDSL;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Query\CompoundQueries;
use olvlvl\ElasticsearchDSL\Query\HasCompoundQueries;
use olvlvl\ElasticsearchDSL\Query\HasTextQueries;
use olvlvl\ElasticsearchDSL\Query\TextQueries;

class Query implements HasCompoundQueries, HasTextQueries, \JsonSerializable
{
	const NAME = 'query';

	use AccessorTrait;
	use CompoundQueries;
	use TextQueries;

	public function __toString()
	{
		return json_encode($this, JSON_PRETTY_PRINT);
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => Helpers::merge_and_prefer_single(
			$this->jsonSerializeCompoundQueries(),
			$this->jsonSerializeTextQueries()
		) ];
	}

	public function to_array(): array
	{
		return json_decode(json_encode($this));
	}
}
