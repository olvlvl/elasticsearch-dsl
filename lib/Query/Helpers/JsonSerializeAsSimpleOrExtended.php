<?php

namespace olvlvl\ElasticsearchDSL\Query\Helpers;

trait JsonSerializeAsSimpleOrExtended
{
	private function jsonSerializeAsSimpleOrExtended(string $property = 'value')
	{
		$options = parent::jsonSerialize();

		if ($options) {
			return [ static::NAME => [ $this->field => [ $property => $this->$property ] + $options ] ];
		}

		return [ static::NAME => [ $this->field => $this->$property ] ];
	}
}
