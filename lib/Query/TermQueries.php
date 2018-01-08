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

	public function term(string $field, $value, callable $config = null)
	{
		$this->term[] = $q = new TermQuery($field, $value);

		if ($config) {
			$config($q);
		}

		return $this;
	}

	/**
	 * @var TermsQuery[]
	 */
	private $terms = [];

	public function terms(string $field, array $values, callable $config = null)
	{
		$this->terms[] = $q = new TermsQuery($field, $values);

		if ($config) {
			$config($q);
		}

		return $this;
	}

	/**
	 * @var RangeQuery[]
	 */
	private $range = [];

	public function range(string $field, callable $config = null)
	{
		$this->range[] = $q = new RangeQuery($field);

		if ($config) {
			$config($q);
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

	public function prefix(string $field, $value, callable $config = null)
	{
		$this->prefix[] = $q = new PrefixQuery($field, $value);

		if ($config) {
			$config($q);
		}

		return $this;
	}

	/**
	 * @var WildcardQuery[]
	 */
	private $wildcard = [];

	public function wildcard(string $field, $value, callable $config = null)
	{
		$this->wildcard[] = $q = new WildcardQuery($field, $value);

		if ($config) {
			$config($q);
		}

		return $this;
	}

	/**
	 * @var RegexpQuery[]
	 */
	private $regexp = [];

	public function regexp(string $field, $value, callable $config = null)
	{
		$this->regexp[] = $q = new RegexpQuery($field, $value);

		if ($config) {
			$config($q);
		}

		return $this;
	}

	/**
	 * @var FuzzyQuery[]
	 */
	private $fuzzy = [];

	public function fuzzy(string $field, $value, callable $config = null)
	{
		$this->fuzzy[] = $q = new FuzzyQuery($field, $value);

		if ($config) {
			$config($q);
		}

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

	public function ids(array $ids, callable $config = null)
	{
		$this->ids[] = $q = new IdsQuery($ids);

		if ($config) {
			$config($q);
		}

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
