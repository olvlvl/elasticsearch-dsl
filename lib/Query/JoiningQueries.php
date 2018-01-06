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

	public function nested(string $path, array $options = [])
	{
		$this->nested[] = $nested = new NestedQuery($path, $options);

		return $nested;
	}

	protected function jsonSerializeJoiningQueries(): array
	{
		return Helpers::filter_merge(
			$this->nested
		);
	}
}
