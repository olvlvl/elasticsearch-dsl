<?php

namespace olvlvl\ElasticsearchDSL\Query;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Helpers;

abstract class QueryAbstract implements \JsonSerializable
{
	use AccessorTrait;

	protected const OPTIONS = [];

	protected $options = [];

	public function __construct(array $options = [])
	{
		$this->handle_options($options, static::OPTIONS);
	}

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

	protected function handle_options(array $options, array $possible_options): void
	{
		foreach ($options as $option => $value) {
			$this->{ $option }($value);
		}
	}
}
