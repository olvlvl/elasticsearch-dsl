<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\Text\MatchAllQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchNoneQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchPhrasePrefixQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchPhraseQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MatchQuery;
use olvlvl\ElasticsearchDSL\Query\Text\MultiMatchQuery;

trait TextQueries
{
	/**
	 * @var MatchAllQuery[]
	 */
	private $match_all = [];

	public function match_all(array $options = [])
	{
		$this->match_all[] = new MatchAllQuery($options);

		return $this;
	}

	/**
	 * @var MatchNoneQuery[]
	 */
	private $match_none = [];

	public function match_none()
	{
		$this->match_none[] = new MatchNoneQuery();

		return $this;
	}

	/**
	 * @var MatchQuery[]
	 */
	private $match = [];

	public function match(string $field, string $query, array $options = [])
	{
		$this->match[] = new MatchQuery($field, $query, $options);

		return $this;
	}

	/**
	 * @var MatchPhraseQuery[]
	 */
	private $match_phrase = [];

	public function match_phrase(string $field, string $query, array $options = [])
	{
		$this->match_phrase[] = new MatchPhraseQuery($field, $query, $options);

		return $this;
	}

	/**
	 * @var MatchPhrasePrefixQuery[]
	 */
	private $match_phrase_prefix = [];

	public function match_phrase_prefix(string $field, string $query, array $options = [])
	{
		$this->match_phrase_prefix[] = new MatchPhrasePrefixQuery($field, $query, $options);

		return $this;
	}

	/**
	 * @var MultiMatchQuery[]
	 */
	private $multi_match = [];

	public function multi_match(array $fields, string $query, array $options = [])
	{
		$this->multi_match[] = new MultiMatchQuery($fields, $query, $options);

		return $this;
	}

	protected function jsonSerializeTextQueries(): array
	{
		return Helpers::filter_merge(
			$this->match_all,
			$this->match_none,
			$this->match,
			$this->match_phrase,
			$this->match_phrase_prefix,
			$this->multi_match
		);
	}
}
