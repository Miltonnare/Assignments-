
# Stack Data Structure: Complete Implementation Guide

## What is a Stack?

A **Stack** is a linear data structure that follows the **LIFO (Last-In, First-Out)** principle. The last element added to the stack is the first one to be removed. Think of it like a stack of plates - you add plates to the top and remove from the top.

### Common Use Cases:
- Function call management (call stack)
- Undo/Redo functionality
- Expression evaluation
- Back/Forward navigation in browsers
- Depth-First Search algorithms
- Syntax parsing and matching brackets

---

## Implementation Methods

## 1. Using an Array or List

### How it Works
We use a dynamic array/list and maintain a pointer (or use the end of the array) to track the top element.

### Python Implementation
```python
class StackUsingArray:
    def __init__(self):
        self.stack = []

    def push(self, item):
        self.stack.append(item)

    def pop(self):
        if self.is_empty():
            return None
        return self.stack.pop()

    def peek(self):
        if self.is_empty():
            return None
        return self.stack[-1]

    def is_empty(self):
        return len(self.stack) == 0

    def size(self):
        return len(self.stack)

    def display(self):
        print("Stack:", self.stack)

if __name__ == "__main__":
    stack = StackUsingArray()
    stack.push(10)
    stack.push(20)
    stack.push(30)
    stack.display()
    print("Popped:", stack.pop())
    print("Top element:", stack.peek())
    print("Stack size:", stack.size())
```
### JavaScript Implementation
```javascript
class StackUsingArray {
    constructor() { this.stack = []; }
    push(item) { this.stack.push(item); }
    pop() { return this.isEmpty() ? null : this.stack.pop(); }
    peek() { return this.isEmpty() ? null : this.stack[this.stack.length - 1]; }
    isEmpty() { return this.stack.length === 0; }
    size() { return this.stack.length; }
    display() { console.log("Stack:", this.stack); }
}

const stack = new StackUsingArray();
stack.push(10); stack.push(20); stack.push(30);
stack.display();
console.log("Popped:", stack.pop());
console.log("Top element:", stack.peek());
console.log("Stack size:", stack.size());
```
### Advantages
- Simple implementation
- Cache friendly
- Random access
- Efficient for small to medium datasets

### Disadvantages
- Fixed size in some languages
- Costly resizing when full
- Possible memory waste

### Time Complexities
| Operation | Time Complexity | Notes |
|----------|----------------|-------|
| Push     | O(1) avg       | O(n) worst-case if resizing |
| Pop      | O(1)           | - |
| Peek     | O(1)           | - |
| isEmpty  | O(1)           | - |
| Search   | O(n)           | - |

### Real-Life Analogy
📚 Cafeteria Plate Dispenser.

---

## 2. Using a Linked List

### How it Works
Each element (node) contains data and a reference to the next node. The top of the stack is the head of the linked list.

### Python Implementation
```python
class Node:
    def __init__(self, data):
        self.data = data
        self.next = None

class StackUsingLinkedList:
    def __init__(self):
        self.top = None
        self._size = 0

    def push(self, item):
        new_node = Node(item)
        new_node.next = self.top
        self.top = new_node
        self._size += 1

    def pop(self):
        if self.is_empty():
            return None
        popped_item = self.top.data
        self.top = self.top.next
        self._size -= 1
        return popped_item

    def peek(self):
        return None if self.is_empty() else self.top.data

    def is_empty(self):
        return self.top is None

    def size(self):
        return self._size

    def display(self):
        current = self.top
        elements = []
        while current:
            elements.append(current.data)
            current = current.next
        print("Stack:", elements)

stack = StackUsingLinkedList()
stack.push(10); stack.push(20); stack.push(30)
stack.display()
print("Popped:", stack.pop())
print("Top element:", stack.peek())
print("Stack size:", stack.size())
```
### JavaScript Implementation
```javascript
class Node {
    constructor(data) { this.data = data; this.next = null; }
}

class StackUsingLinkedList {
    constructor() { this.top = null; this.size = 0; }
    push(item) { const n = new Node(item); n.next = this.top; this.top = n; this.size++; }
    pop() { if(this.isEmpty()) return null; const v = this.top.data; this.top = this.top.next; this.size--; return v; }
    peek() { return this.isEmpty() ? null : this.top.data; }
    isEmpty() { return this.top === null; }
    display() { let c = this.top, e = []; while(c){ e.push(c.data); c = c.next; } console.log("Stack:", e); }
}
```
### Advantages
- Dynamic size
- No resizing
- Suitable for large datasets

### Disadvantages
- Extra memory for pointers
- Less cache efficiency

---

## 3. Using Built-in Structures

### Python
```python
from collections import deque
stack = deque()
stack.append(10)
stack.append(20)
stack.append(30)
print(stack.pop())
print(stack[-1])
```

### JavaScript
```javascript
const stack = [];
stack.push(10); stack.push(20); stack.push(30);
console.log(stack.pop());
console.log(stack[stack.length - 1]);
```

---

## Practical Example: Balanced Parentheses
```python
def is_balanced(expression):
    stack = []
    mapping = {')': '(', '}': '{', ']': '['}
    for char in expression:
        if char in mapping.values():
            stack.append(char)
        elif char in mapping:
            if not stack or stack.pop() != mapping[char]:
                return False
    return len(stack) == 0
```
```javascript
function isBalanced(expression) {
    const stack = [];
    const mapping = { ')': '(', '}': '{', ']': '[' };
    for (let char of expression) {
        if (Object.values(mapping).includes(char)) stack.push(char);
        else if (mapping[char] && stack.pop() !== mapping[char]) return false;
    }
    return stack.length === 0;
}
```

---

### When to Choose Each Method
## 🟢 Choose Array Implementation When:
Memory efficiency is critical

You're working with fixed or predictable data sizes

Cache performance is important

Implementing in resource-constrained environments

Simple applications where resizing isn't a major concern

## 🟡 Choose Linked List Implementation When:
You need truly dynamic sizing without resizing overhead

Implementing complex stack variations (min-stack, etc.)

Educational purposes to understand data structures

Memory fragmentation isn't a primary concern

Working with large, unpredictable datasets

## 🔵 Choose Built-in Implementation When:
Production code where reliability is paramount

Quick prototyping and development

You want optimized performance without implementation effort

Working in team environments with standardized APIs

Maintainability and readability are important

## 🎯 General Recommendation:
Start with built-in implementations for most practical purposes as they're optimized, well-tested, and maintained. Only implement custom stacks when you have specific requirements that built-in solutions don't meet, such as:

Special memory constraints

Unique functionality requirements

Educational purposes

Performance optimization for specific use cases

## Conclusion
Stacks are simple yet powerful. Choose implementation based on:
- ✅ Arrays for efficiency
- ✅ Linked Lists for scalability
- ✅ Built-in stacks for production readiness
