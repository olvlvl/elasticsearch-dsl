<?php

namespace olvlvl\ElasticsearchDSL;

use olvlvl\ElasticsearchDSL\Query\QueryCollection;

class Query extends QueryCollection
{
	const NAME = 'query';

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => parent::jsonSerialize() ?: (object) [] ];
	}

	public function to_array(): array
	{
		return $this->jsonSerialize();
	}
}
