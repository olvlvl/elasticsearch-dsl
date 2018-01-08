<?php

namespace olvlvl\ElasticsearchDSL\Query;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Helpers;

abstract class QueryAbstract implements \JsonSerializable
{
	use AccessorTrait;

	protected const OPTIONS = [];

	protected $options = [];

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
		return Helpers::filter_not_null($this->options);
	}
}
