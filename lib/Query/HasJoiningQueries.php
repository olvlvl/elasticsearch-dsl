<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Joining\NestedQuery;

interface HasJoiningQueries
{
	/**
	 * @param string $path
	 * @param array $options
	 *
	 * @return NestedQuery
	 */
	public function nested(string $path, array $options = []);
}
