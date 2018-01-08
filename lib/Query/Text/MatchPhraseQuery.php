<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MatchPhraseQuery extends QueryAbstract
{
	use JsonSerializeAsSimpleOrExtended;

	const NAME = 'match_phrase';
	private const OPTION_ANALYZER = 'analyzer';

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

	public function analyzer(?string $analyser)
	{
		$this->options[self::OPTION_ANALYZER] = $analyser;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return $this->jsonSerializeAsSimpleOrExtended('query');
	}
}
