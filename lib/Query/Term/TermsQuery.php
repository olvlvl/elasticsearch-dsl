<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-terms-query.html
 */
class TermsQuery extends QueryAbstract
{
	const NAME = 'terms';

	private const OPTION_INDEX = 'index';
	private const OPTION_TYPE = 'type';
	private const OPTION_ID = 'id';
	private const OPTION_PATH = 'path';
	private const OPTION_ROUTING = 'routing';

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @var array
	 */
	private $values;

	/**
	 * @param string $field
	 * @param array $values
	 */
	public function __construct(string $field, array $values)
	{
		$this->field = $field;
		$this->values = $values;
	}

	/**
	 * @param null|string $index
	 *
	 * @return $this
	 */
	public function index(?string $index)
	{
		$this->options[self::OPTION_INDEX] = $index;

		return $this;
	}

	/**
	 * @param null|string $type
	 *
	 * @return $this
	 */
	public function type(?string $type)
	{
		$this->options[self::OPTION_TYPE] = $type;

		return $this;
	}

	/**
	 * @param null|string $id
	 *
	 * @return $this
	 */
	public function id(?string $id)
	{
		$this->options[self::OPTION_ID] = $id;

		return $this;
	}

	/**
	 * @param null|string $path
	 *
	 * @return $this
	 */
	public function path(?string $path)
	{
		$this->options[self::OPTION_PATH] = $path;

		return $this;
	}

	/**
	 * @param null|string $routing
	 *
	 * @return $this
	 */
	public function routing(?string $routing)
	{
		$this->options[self::OPTION_ROUTING] = $routing;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		$options = parent::jsonSerialize();

		if ($options) {
			return [ self::NAME => $options ];
		}

		return [ self::NAME => [ $this->field => $this->values ] ];
	}
}
