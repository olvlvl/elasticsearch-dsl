<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\Option\HasMatchOptions;
use olvlvl\ElasticsearchDSL\Query\Option\MatchOptions;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MatchQuery extends QueryAbstract implements HasMatchOptions
{
	use MatchOptions;
	use JsonSerializeAsSimpleOrExtended;

	const NAME = 'match';

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @var string
	 */
	private $query;

	public function __construct(string $field, string $query)
	{
		$this->field = $field;
		$this->query = $query;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return $this->jsonSerializeAsSimpleOrExtended('query');
	}
}
