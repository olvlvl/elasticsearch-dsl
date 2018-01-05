<?php

namespace olvlvl\ElasticsearchDSL\Query\Option;

interface HasMatchOptions extends HasFuzzyOptions
{
	const OPTION_OPERATOR = 'operator';
	const OPTION_ZERO_TERMS_QUERY = 'zero_terms_query';
	const OPTION_CUTOFF_FREQUENCY = 'cutoff_frequency';

	const MATCH_OPTIONS = [

		self::OPTION_OPERATOR,
		self::OPTION_ZERO_TERMS_QUERY,
		self::OPTION_CUTOFF_FREQUENCY,

	] + self::FUZZY_OPTIONS;
}
