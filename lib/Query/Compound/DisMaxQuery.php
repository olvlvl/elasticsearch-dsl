<?php

namespace olvlvl\ElasticsearchDSL\Query\Compound;

use olvlvl\ElasticsearchDSL\Query\Option\BoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\HasBoostOption;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;
use olvlvl\ElasticsearchDSL\Query\QueryCollection;

/**
 * @property-read QueryCollection $queries
 */
class DisMaxQuery extends QueryAbstract implements HasBoostOption
{
	use BoostOption;

	const NAME = 'dis_max';

	/**
	 * @var QueryCollection
	 */
	private $queries;

	protected function get_queries(): QueryCollection
	{
		return $this->queries;
	}

	public function __construct()
	{
		$this->queries = new QueryCollection;
		$this->tie_breaker(1.0);
	}

	public function tie_breaker(float $tie_breaker)
	{
		$this->options[__FUNCTION__] = $tie_breaker;

		return $this;
	}

	public function jsonSerialize()
	{
		return [ self::NAME => parent::jsonSerialize() + [

			'queries' => $this->queries,

		] ];
	}
}
