![Alt](https://repobeats.axiom.co/api/embed/bda93ae6beb88772669b2de0205353eed65441ac.svg "Repobeats analytics image")

# KA-SD

KA-SD is a kind of SQL injection detection based on KMP and DFA string matching, which can effectively improve the detection rate and reduce false positives. It's still in development
 
It's public for others to contribute and improve it.

# Time Complexity
1. The time complexity of get_prefix_arr() function is O(b), where b is the length of the pattern.
2. The time complexity of KMP_String() function is O(a+b), where a is the length of the text and b is the length of the pattern.
3. The time complexity of computeTF() function is O(M*NO_OF_CHARS), where M is the length of the pattern and NO_OF_CHARS is the number of unique characters in the input alphabet.
4. The time complexity of getNextState() function is O(M), where M is the length of the pattern.
5. The time complexity of validate_uname() function is O(n * (a+b+M*NO_OF_CHARS)), where n is the number of patterns, a is the length of the text, b is the length of the pattern, and M is the length of the longest pattern.

Therefore, the overall time complexity of the program is O(n * (a+b+M*NO_OF_CHARS)), where n is the number of patterns, a is the length of the text, b is the length of the pattern, and M is the length of the longest pattern.
