<?php

namespace olvlvl\ElasticsearchDSL\Query\Text;

use olvlvl\ElasticsearchDSL\Query\Helpers\JsonSerializeAsSimpleOrExtended;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

class MatchPhraseQuery extends QueryAbstract
{
	use JsonSerializeAsSimpleOrExtended;

	const NAME = 'match_phrase';

	const OPTION_ANALYZER = 'analyzer';

	protected const OPTIONS = [

		self::OPTION_ANALYZER

	];

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @var string
	 */
	private $query;

	public function __construct(string $field, string $query, array $options = [])
	{
		$this->field = $field;
		$this->query = $query;

		parent::__construct($options);
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
