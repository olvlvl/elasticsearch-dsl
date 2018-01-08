<?php

namespace olvlvl\ElasticsearchDSL;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Query\QueryCollection;

class Query extends QueryCollection
{
	use AccessorTrait;

	const NAME = 'query';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => parent::jsonSerialize() ];
	}

	public function to_array(): array
	{
		return json_decode(json_encode($this));
	}
}
