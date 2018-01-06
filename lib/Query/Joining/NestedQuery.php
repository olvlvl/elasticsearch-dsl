<?php

namespace olvlvl\ElasticsearchDSL\Query\Joining;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Query;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @property-read Query $query
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-nested-query.html
 */
class NestedQuery extends QueryAbstract
{
	use AccessorTrait;

	const NAME = 'nested';

	const OPTION_SCORE_MODE = 'score_mode';
	const OPTION_IGNORE_UNMAPPED = 'ignore_unmapped';

	/**
	 * @var string
	 */
	private $path;

	/**
	 * @var Query
	 */
	private $query;

	protected function get_query(): Query
	{
		return $this->query;
	}

	public function __construct(string $path, array $options = [])
	{
		$this->path = $path;
		$this->query = new Query();

		parent::__construct($options);
	}

	/**
	 * @param null|string $score_mode
	 *
	 * @return $this
	 */
	public function score_mode(?string $score_mode)
	{
		$this->options[self::OPTION_SCORE_MODE] = $score_mode;

		return $this;
	}

	/**
	 * @param bool $ignore_unmapped
	 *
	 * @return $this
	 */
	public function ignore_unmapped(bool $ignore_unmapped)
	{
		$this->options[self::OPTION_IGNORE_UNMAPPED] = $ignore_unmapped;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ self::NAME => [

			'path' => $this->path,

		] + parent::jsonSerialize() + $this->query->jsonSerialize() ];
	}
}
