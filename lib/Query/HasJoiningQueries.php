<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Query\Joining\NestedQuery;

interface HasJoiningQueries
{
	public function nested(string $path, callable $config = null): NestedQuery;
}
