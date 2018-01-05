<?php

namespace olvlvl\ElasticsearchDSL;

class Helpers
{
	static public function filter_not_null(array $input)
	{
		return array_filter($input, function ($value) {
			return !is_null($value);
		});
	}

	static public function filter_merge(...$input)
	{
		return array_values(array_filter(array_merge(...$input)));
	}

	static public function prefer_single(array $input)
	{
		if (count($input) !== 1) {
			return $input;
		}

		return reset($input);
	}

	static public function merge_and_prefer_single(...$input)
	{
		return Helpers::prefer_single(self::filter_merge(...$input));
	}
}
