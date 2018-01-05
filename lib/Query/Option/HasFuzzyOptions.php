<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

interface HasFuzzyOptions
{
	const OPTION_FUZZINESS = 'fuzziness';
	const OPTION_PREFIX_LENGTH = 'prefix_length';
	const OPTION_MAX_EXPANSIONS = 'max_expansions';

	const FUZZY_OPTIONS = [

		self::OPTION_FUZZINESS,
		self::OPTION_PREFIX_LENGTH,
		self::OPTION_MAX_EXPANSIONS,

	];

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
