<?php

namespace olvlvl\ElasticsearchDSL\Query;

use olvlvl\ElasticsearchDSL\Helpers;
use olvlvl\ElasticsearchDSL\Query\Term\ExistsQuery;
use olvlvl\ElasticsearchDSL\Query\Term\FuzzyQuery;
use olvlvl\ElasticsearchDSL\Query\Term\IdsQuery;
use olvlvl\ElasticsearchDSL\Query\Term\PrefixQuery;
use olvlvl\ElasticsearchDSL\Query\Term\RangeQuery;
use olvlvl\ElasticsearchDSL\Query\Term\RegexpQuery;
use olvlvl\ElasticsearchDSL\Query\Term\TermQuery;
use olvlvl\ElasticsearchDSL\Query\Term\TermsQuery;
use olvlvl\ElasticsearchDSL\Query\Term\TypeQuery;
use olvlvl\ElasticsearchDSL\Query\Term\WildcardQuery;

trait TermQueries
{
	/**
	 * @var TermQuery[]
	 */
	private $term = [];

	public function term(string $field, $value, array $options = [])
	{
		$this->term[] = new TermQuery($field, $value, $options);

		return $this;
	}

	/**
	 * @var TermsQuery[]
	 */
	private $terms = [];

	public function terms(string $field, array $values, array $options = [])
	{
		$this->terms[] = new TermsQuery($field, $values, $options);

		return $this;
	}

	/**
	 * @var RangeQuery[]
	 */
	private $range = [];

	public function range(string $field, $optionsOrConfigurator = null)
	{
		$options = is_array($optionsOrConfigurator) ? $optionsOrConfigurator : [];

		$this->range[] = $range = new RangeQuery($field, $options);

		if (is_callable($optionsOrConfigurator)) {
			$optionsOrConfigurator($range);
		}

		return $this;
	}

	/**
	 * @var ExistsQuery[]
	 */
	private $exists = [];

	public function exists(string $field)
	{
		$this->exists[] = new ExistsQuery($field);

		return $this;
	}

	/**
	 * @var PrefixQuery[]
	 */
	private $prefix = [];

	public function prefix(string $field, $value, array $options = [])
	{
		$this->prefix[] = new PrefixQuery($field, $value, $options);

		return $this;
	}

	/**
	 * @var WildcardQuery[]
	 */
	private $wildcard = [];

	public function wildcard(string $field, $value, array $options = [])
	{
		$this->wildcard[] = new WildcardQuery($field, $value, $options);

		return $this;
	}

	/**
	 * @var RegexpQuery[]
	 */
	private $regexp = [];

	public function regexp(string $field, $value, array $options = [])
	{
		$this->regexp[] = new RegexpQuery($field, $value, $options);

		return $this;
	}

	/**
	 * @var FuzzyQuery[]
	 */
	private $fuzzy = [];

	public function fuzzy(string $field, $value, array $options = [])
	{
		$this->fuzzy[] = new FuzzyQuery($field, $value, $options);

		return $this;
	}

	/**
	 * @var TypeQuery[]
	 */
	private $type = [];

	public function type(string $type)
	{
		$this->type[] = new TypeQuery($type);

		return $this;
	}

	/**
	 * @var IdsQuery[]
	 */
	private $ids = [];

	public function ids(array $ids, array $options = [])
	{
		$this->ids[] = new IdsQuery($ids, $options);

		return $this;
	}

	protected function jsonSerializeTermQueries(): array
	{
		return Helpers::filter_merge(
			$this->term,
			$this->terms,
			$this->range,
			$this->exists,
			$this->prefix,
			$this->wildcard,
			$this->regexp,
			$this->fuzzy,
			$this->type,
			$this->ids
		);
	}
}
