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

	const OPTION_FROM = 'from';
	const OPTION_TO = 'to';
	const OPTION_GTE = 'gte';
	const OPTION_GT = 'gt';
	const OPTION_LTE = 'lte';
	const OPTION_LT = 'lt';
	const OPTION_FORMAT = 'format';

	protected const OPTIONS = [

		self::OPTION_FROM,
		self::OPTION_TO,
		self::OPTION_GTE,
		self::OPTION_GT,
		self::OPTION_LTE,
		self::OPTION_LT,
		self::OPTION_FORMAT,
		self::OPTION_BOOST,

	];
	/**
	 * @var string
	 */
	private $field;

	public function __construct(string $field, array $options = [])
	{
		$this->field = $field;

		parent::__construct($options);
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function from($value = null)
	{
		$this->options[self::OPTION_FROM] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function to($value = null)
	{
		$this->options[self::OPTION_TO] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function gte($value = null)
	{
		$this->options[self::OPTION_GTE] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function gt($value = null)
	{
		$this->options[self::OPTION_GT] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function lte($value = null)
	{
		$this->options[self::OPTION_LTE] = $value;

		return $this;
	}

	/**
	 * @param mixed|null $value
	 *
	 * @return $this
	 */
	public function lt($value = null)
	{
		$this->options[self::OPTION_LT] = $value;

		return $this;
	}

	/**
	 * @param string $format
	 *
	 * @return $this
	 */
	public function format(string $format)
	{
		$this->options[self::OPTION_FORMAT] = $format;

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
