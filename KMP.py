NO_OF_CHARS = 256

def get_prefix_arr(pattern, b):
'''Helper function to compute prefix array for pattern'''
    prefix_arr = [0] * b
    n = 0
    m = 1
    while m != b:
        if pattern[m] == pattern[n]:
            n += 1
            prefix_arr[m] = n
            m += 1
        elif n != 0:
            n = prefix_arr[n-1]
        else:
            prefix_arr[m] = 0
            m += 1
    return prefix_arr
    
def KMP_String(pattern, text):
'''KMP string matching algorithm'''
    a = len(text)
    b = len(pattern)
    prefix_arr = get_prefix_arr(pattern, b)
    initial_point = []
    m = 0
    n = 0

    while m != a:
        if text[m] == pattern[n]:
            m += 1
            n += 1
        else:
            n = prefix_arr[n-1]
        if n == b:
            initial_point.append(m-n)
            n = prefix_arr[n-1]
        elif n == 0:
            m += 1
    return initial_point

def DFA(pat, txt):
'''DFA algorithm for pattern matching'''
    global NO_OF_CHARS
    M = len(pat)
    N = len(txt)
    TF = computeTF(pat, M)    
  
    state=0
    for i in range(N):
        state = TF[state][ord(txt[i])]
        if state == M:
            return i-M+1
    return -1

def getNextState(pat, state, x, M):
'''Helper function to get next state in DFA'''
    if state < M and x == ord(pat[state]):
        return state+1
    i=0
    for ns in range(state,0,-1):
        if ord(pat[ns-1]) == x:
            while(i<ns-1):
                if pat[i] != pat[state-ns+1+i]:
                    break
                i+=1
            if i == ns-1:
                return ns 
    return 0

def computeTF(pat, M):
'''Computes transition function for DFA'''
    global NO_OF_CHARS
  
    TF = [[0 for i in range(NO_OF_CHARS)]\
          for _ in range(M+1)]
  
    for state in range(M+1):
        for x in range(NO_OF_CHARS):
            z = getNextState(pat, state, x, M)
            TF[state][x] = z
    return TF

def validate_uname(username):
'''Main function to validate username against patterns'''
    with open('pattens/Patterns.csv') as f:
        array = f.readlines()
    array = [x.strip() for x in array]    
    for pattern in array:
        res1 = KMP_String(pattern, username)
        res2 = DFA(pattern, username)
        # If any matching index is found, return the input username
        if (res1 or res2) > 0:
            return username
    return None
