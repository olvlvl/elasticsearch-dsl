<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

interface HasFuzzyOptions
{
	/**
	 * @param mixed|null $fuzziness
	 *
	 * @return $this
	 */
	public function fuzziness($fuzziness = null);

	/**
	 * @param int|null $prefix_length
	 *
	 * @return $this
	 */
	public function prefix_length(?int $prefix_length);

	/**
	 * @param int|null $max_expansions
	 *
	 * @return $this
	 */
	public function max_expansions(?int $max_expansions);
}
