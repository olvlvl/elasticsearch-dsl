<?php

namespace olvlvl\ElasticsearchDSL\Query;

interface HasTermQueries
{
	/**
	 * @param string $field
	 * @param mixed $value
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function term(string $field, $value, callable $config = null);

	/**
	 * @param string $field
	 * @param array $values
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function terms(string $field, array $values, callable $config = null);

	/**
	 * @param string $field
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function range(string $field, callable $config = null);

	/**
	 * @param string $field
	 *
	 * @return $this
	 */
	public function exists(string $field);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function prefix(string $field, $value, callable $config = null);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function wildcard(string $field, $value, callable $config = null);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function regexp(string $field, $value, callable $config = null);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function fuzzy(string $field, $value, callable $config = null);

	/**
	 * @param string $type
	 *
	 * @return $this
	 */
	public function type(string $type);

	/**
	 * @param array $ids
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function ids(array $ids, callable $config = null);
}
