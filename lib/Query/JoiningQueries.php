<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\Joining\NestedQuery;

trait JoiningQueries
{
	/**
	 * @var NestedQuery[]
	 */
	private $nested = [];

	public function nested(string $path, callable $config = null): NestedQuery
	{
		$this->nested[] = $q = new NestedQuery($path);

		if ($config) {
			$config($q);
		}

		return $q;
	}

	protected function jsonSerializeJoiningQueries(): array
	{
		return Helpers::filter_merge(
			$this->nested
		);
	}
}
