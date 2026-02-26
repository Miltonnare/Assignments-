def longestCommonPrefix(strs):
    if not strs:
        return ""
    
    strs.sort()
    
    first = strs[0]
    last = strs[-1]
    
    i = 0
    while i < len(first) and first[i] == last[i]:
        i += 1
    
    return first[:i]


result=longestCommonPrefix(["flower", "flow", "flight"])
time=longestCommonPrefix(["dog", "racecar", "car"])

print(result)
print(time)
