<?php

namespace olvlvl\ElasticsearchDSL\Query;

interface HasTextQueries
{
	/**
	 * @param array $options
	 *
	 * @return $this
	 */
	public function match_all(array $options = []);

	/**
	 * @return $this
	 */
	public function match_none();

	/**
	 * @param string $field
	 * @param string $query
	 * @param array $options
	 *
	 * @return $this
	 */
	public function match(string $field, string $query, array $options = []);

	/**
	 * @param string $field
	 * @param string $query
	 * @param array $options
	 *
	 * @return $this
	 */
	public function match_phrase(string $field, string $query, array $options = []);

	/**
	 * @param string $field
	 * @param string $query
	 * @param array $options
	 *
	 * @return $this
	 */
	public function match_phrase_prefix(string $field, string $query, array $options = []);

	/**
	 * @param array $fields
	 * @param string $query
	 * @param array $options
	 *
	 * @return $this
	 */
	public function multi_match(array $fields, string $query, array $options = []);
}
