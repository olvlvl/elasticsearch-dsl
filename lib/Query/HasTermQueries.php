<?php

namespace olvlvl\ElasticsearchDSL\Query;

interface HasTermQueries
{
	/**
	 * @param string $field
	 * @param mixed $value
	 * @param array $options
	 *
	 * @return $this
	 */
	public function term(string $field, $value, array $options = []);

	/**
	 * @param string $field
	 * @param array $values
	 * @param array $options
	 *
	 * @return $this
	 */
	public function terms(string $field, array $values, array $options = []);

	/**
	 * @param string $field
	 * @param callable|array|null $optionsOrConfigurator
	 *
	 * @return $this
	 */
	public function range(string $field, $optionsOrConfigurator = null);

	/**
	 * @param string $field
	 *
	 * @return $this
	 */
	public function exists(string $field);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param array $options
	 *
	 * @return $this
	 */
	public function prefix(string $field, $value, array $options = []);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param array $options
	 *
	 * @return $this
	 */
	public function wildcard(string $field, $value, array $options = []);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param array $options
	 *
	 * @return $this
	 */
	public function regexp(string $field, $value, array $options = []);

	/**
	 * @param string $field
	 * @param mixed $value
	 * @param array $options
	 *
	 * @return $this
	 */
	public function fuzzy(string $field, $value, array $options = []);

	/**
	 * @param string $type
	 *
	 * @return $this
	 */
	public function type(string $type);

	/**
	 * @param array $ids
	 * @param array $options
	 *
	 * @return $this
	 */
	public function ids(array $ids, array $options = []);
}
