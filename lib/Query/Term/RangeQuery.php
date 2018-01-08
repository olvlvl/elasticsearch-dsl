<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\Option\BoostOption;
use olvlvl\ElasticsearchDSL\Query\Option\HasBoostOption;
use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @property mixed|null $gte
 * @property mixed|null $gt
 * @property mixed|null $lte
 * @property mixed|null $lt
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-range-query.html
 */
class RangeQuery extends QueryAbstract implements HasBoostOption
{
	use BoostOption;

	const NAME = 'range';

	/**
	 * @var string
	 */
	private $field;

	public function __construct(string $field)
	{
		$this->field = $field;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function from($value = null)
	{
		$this->options[__FUNCTION__] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function to($value = null)
	{
		$this->options[__FUNCTION__] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function gte($value = null)
	{
		$this->options[__FUNCTION__] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function gt($value = null)
	{
		$this->options[__FUNCTION__] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function lte($value = null)
	{
		$this->options[__FUNCTION__] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function lt($value = null)
	{
		$this->options[__FUNCTION__] = $value;

		return $this;
	}

	/**
	 * @param string $format
	 *
	 * @return $this
	 */
	public function format(string $format)
	{
		$this->options[__FUNCTION__] = $format;

		return $this;
	}

	public function jsonSerialize()
	{
		return [
			self::NAME => [
				$this->field => parent::jsonSerialize()
			]
		];
	}
}
