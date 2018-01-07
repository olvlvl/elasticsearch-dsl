<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use ICanBoogie\Accessor\AccessorTrait;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery\FilterQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery\MustNotQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery\MustQuery;
use olvlvl\ElasticsearchDSL\Query\Compound\BoolQuery\ShouldQuery;
use olvlvl\ElasticsearchDSL\Query\Option\BoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\HasBoostOption;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @property-read FilterQuery $filter
 * @property-read MustQuery $must
 * @property-read ShouldQuery $should
 * @property-read MustNotQuery $must_not
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.5/query-dsl-bool-query.html
 */
class BoolQuery extends QueryAbstract implements HasBoostOption
{
	use AccessorTrait;
	use BoostOption;

	const NAME = 'bool';

	const OPTION_MINIMUM_SHOULD_MATCH = 'minimum_should_match';

	protected const OPTIONS = [

		self::OPTION_MINIMUM_SHOULD_MATCH,
		self::OPTION_BOOST,

	];

	/**
	 * @var MustQuery
	 */
	private $must;

	/**
	 * @return MustQuery
	 */
	protected function get_must(): MustQuery
	{
		return $this->must;
	}

	/**
	 * @var FilterQuery
	 */
	private $filter;

	/**
	 * @return FilterQuery
	 */
	protected function get_filter(): FilterQuery
	{
		return $this->filter;
	}

	/**
	 * @var ShouldQuery
	 */
	private $should;

	/**
	 * @return ShouldQuery
	 */
	protected function get_should(): ShouldQuery
	{
		return $this->should;
	}

	/**
	 * @var MustNotQuery
	 */
	private $must_not;

	/**
	 * @return MustNotQuery
	 */
	protected function get_must_not(): MustNotQuery
	{
		return $this->must_not;
	}

	/**
	 * @param array $options
	 */
	public function __construct(array $options = [])
	{
		$this->must = new MustQuery();
		$this->filter = new FilterQuery();
		$this->should = new ShouldQuery();
		$this->must_not = new MustNotQuery();

		parent::__construct($options);
	}

	/**
	 * @param int|null $minimum_should_match
	 *
	 * @return $this
	 */
	public function minimum_should_match(?int $minimum_should_match)
	{
		$this->options[self::OPTION_MINIMUM_SHOULD_MATCH] = $minimum_should_match;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [ static::NAME => array_filter([

			MustQuery::NAME => $this->must->jsonSerialize(),
			FilterQuery::NAME => $this->filter->jsonSerialize(),
			ShouldQuery::NAME => $this->should->jsonSerialize(),
			MustNotQuery::NAME => $this->must_not->jsonSerialize(),

		]) + parent::jsonSerialize() ];
	}
}
