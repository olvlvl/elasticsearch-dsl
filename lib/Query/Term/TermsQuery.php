<?php

namespace olvlvl\ElasticsearchDSL\Query\Term;

use olvlvl\ElasticsearchDSL\Query\QueryAbstract;

/**
 * @property string|null $index
 * @property string|null $type
 * @property string|null $id
 * @property string|null $path
 * @property string|null $routing
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-terms-query.html
 */
class TermsQuery extends QueryAbstract
{
	const NAME = 'terms';

	const OPTION_INDEX = 'index';
	const OPTION_TYPE = 'type';
	const OPTION_ID = 'id';
	const OPTION_PATH = 'path';
	const OPTION_ROUTING = 'routing';

	protected const OPTIONS = [

		self::OPTION_INDEX,
		self::OPTION_TYPE,
		self::OPTION_ID,
		self::OPTION_PATH,
		self::OPTION_ROUTING,

	];

	/**
	 * @var string
	 */
	private $field;

	/**
	 * @var mixed
	 */
	private $values;

	/**
	 * @param string $field
	 * @param mixed $values
	 * @param array $options
	 */
	public function __construct(string $field, array $values, array $options = [])
	{
		$this->field = $field;
		$this->values = $values;

		parent::__construct($options);
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
		$this->options[self::OPTION_INDEX] = $type;

		return $this;
	}

	/**
	 * @param null|string $id
	 *
	 * @return $this
	 */
	public function id(?string $id)
	{
		$this->options[self::OPTION_INDEX] = $id;

		return $this;
	}

	/**
	 * @param null|string $path
	 *
	 * @return $this
	 */
	public function path(?string $path)
	{
		$this->options[self::OPTION_INDEX] = $path;

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
