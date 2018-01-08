<?php

namespace olvlvl\ElasticsearchDSL\Query;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Helpers;

class QueryCollection implements
	HasTextQueries,
	HasTermQueries,
	HasCompoundQueries,
	HasJoiningQueries,
	\JsonSerializable
{
	use AccessorTrait;
	use TextQueries;
	use TermQueries;
	use CompoundQueries;
	use JoiningQueries;

	/**
	 * @inheritdoc
	 */
	public function __toString()
	{
		return json_encode($this, JSON_PRETTY_PRINT);
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return Helpers::merge_and_prefer_single(
			$this->jsonSerializeTextQueries(),
			$this->jsonSerializeTermQueries(),
			$this->jsonSerializeCompoundQueries(),
			$this->jsonSerializeJoiningQueries()
		);
	}
}
