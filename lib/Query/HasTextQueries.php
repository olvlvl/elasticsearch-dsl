<?php

namespace olvlvl\ElasticsearchDSL\Query;

interface HasTextQueries
{
	/**
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function match_all(callable $config = null);

	/**
	 * @return $this
	 */
	public function match_none();

	/**
	 * @param string $field
	 * @param string $query
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function match(string $field, string $query, callable $config = null);

	/**
	 * @param string $field
	 * @param string $query
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function match_phrase(string $field, string $query, callable $config = null);

	/**
	 * @param string $field
	 * @param string $query
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function match_phrase_prefix(string $field, string $query, callable $config = null);

	/**
	 * @param array $fields
	 * @param string $query
	 * @param callable|null $config
	 *
	 * @return $this
	 */
	public function multi_match(array $fields, string $query, callable $config = null);
}
