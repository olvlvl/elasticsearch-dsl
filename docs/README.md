# Elasticsearch DSL

The following documents are usage examples of the library, they focus on each query class
individually, but keep in mind that building a query using the fluent interface you will never have
to create instances. Queries are usually built for a `Query` instance, we recommend that you first
have a look at the [Query][1] chapter.

- Query DSL
    - Full text queries
        - [match](Query/Text/Match.md)
        - [match_all](Query/Text/MatchAll.md)
        - [match_none](Query/Text/MatchNone.md)
        - [match_phrase](Query/Text/MatchPhrase.md)
        - [match_phrase_prefix](Query/Text/MatchPhrasePrefix.md)
        - [multi_match](Query/Text/MultiMatch.md)
    - Term level queries
        - [exists](Query/Term/Exists.md)
        - [ids](Query/Term/Ids.md)
        - [fuzzy](Query/Term/Fuzzy.md)
        - [prefix](Query/Term/Prefix.md)
        - [range](Query/Term/Range.md)
        - [regexp](Query/Term/Regexp.md)
        - [term](Query/Term/Term.md)
        - [terms](Query/Term/Terms.md)
        - [type](Query/Term/Type.md)
        - [wildcard](Query/Term/Wildcard.md)
    - Joining
        - [nested](Query/Joining/Nested.md)





[1]: Query.md
