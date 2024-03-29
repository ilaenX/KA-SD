# KA-SD
KA-SD is a kind of SQL injection detection based on KMP and DFA string matching, which can effectively improve the detection rate and reduce false positives.
It's still in development. It's public for others to contribute and improve it.

# How it works
It defines a function 'validate_uname' that takes a username string as input and attempts to match it against a set of patterns stored in a CSV file. The pattern matching is performed using two different algorithms: the Knuth-Morris-Pratt (KMP) algorithm and the Deterministic Finite Automaton (DFA) algorithm.

The KMP algorithm is used to search for occurrences of the pattern within the username string. If a match is found, the starting index of the match is added to a list of initial points.

The DFA algorithm is used to validate the entire username string against the pattern. If a match is found, the starting index of the match is returned.

If any matching index is found using either algorithm, the function returns the input username. Otherwise, it returns None.

Note that the helper functions get_prefix_arr, KMP_String, DFA, getNextState, and computeTF are defined to support the pattern matching algorithms.

# Time Complexity
1. The time complexity of get_prefix_arr() function is O(b), where b is the length of the pattern.
2. The time complexity of KMP_String() function is O(a+b), where a is the length of the text and b is the length of the pattern.
3. The time complexity of computeTF() function is O(M*NO_OF_CHARS), where M is the length of the pattern and NO_OF_CHARS is the number of unique characters in the input alphabet.
4. The time complexity of getNextState() function is O(M), where M is the length of the pattern.

Therefore, the overall time complexity of the program is O(n * (a+b+M*NO_OF_CHARS)), where n is the number of patterns, a is the length of the text, b is the length of the pattern, and M is the length of the longest pattern.
