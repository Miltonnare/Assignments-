
# 🧠 Data Structures – Part 2: Stacks, Queues & Linked Lists

---

## 🧱 1. Stacks

### 💡 Definition
A **stack** is a **linear data structure** that follows the **LIFO (Last In, First Out)** principle.  
Think of it like a stack of plates — the last plate placed on top is the first one removed.

### ⚙️ Key Operations
| Operation | Description |
|------------|--------------|
| `push()` | Add an element to the top |
| `pop()` | Remove the top element |
| `peek()` or `top()` | View the top element without removing it |
| `isEmpty()` | Check if the stack is empty |

---

### 🐍 Python Implementation (Using List)
```python
class Stack:
    def __init__(self):
        self.stack = []

    def push(self, item):
        self.stack.append(item)

    def pop(self):
        if not self.is_empty():
            return self.stack.pop()
        return "Stack is empty"

    def peek(self):
        return self.stack[-1] if not self.is_empty() else None

    def is_empty(self):
        return len(self.stack) == 0

    def display(self):
        print("Stack:", self.stack)

# Example
s = Stack()
s.push(10)
s.push(20)
s.push(30)
s.display()
print("Popped:", s.pop())
print("Top element:", s.peek())
```
---

### 💻 JavaScript Implementation
```javascript
class Stack {
  constructor() {
    this.items = [];
  }

  push(element) {
    this.items.push(element);
  }

  pop() {
    return this.items.length ? this.items.pop() : "Stack is empty";
  }

  peek() {
    return this.items[this.items.length - 1];
  }

  isEmpty() {
    return this.items.length === 0;
  }

  display() {
    console.log("Stack:", this.items);
  }
}

// Example
const stack = new Stack();
stack.push(5);
stack.push(10);
stack.push(15);
stack.display();
console.log("Popped:", stack.pop());
console.log("Top:", stack.peek());
```

---

## 🧮 2. Queues

### 💡 Definition
A **queue** is a **linear data structure** that follows the **FIFO (First In, First Out)** principle.  
Think of it like a queue of people at a ticket counter — the first to arrive is served first.

### ⚙️ Key Operations
| Operation | Description |
|------------|--------------|
| `enqueue()` | Add an element to the rear |
| `dequeue()` | Remove an element from the front |
| `front()` | View the front element |
| `isEmpty()` | Check if queue is empty |

---

### 🐍 Python Implementation (Using `collections.deque`)
```python
from collections import deque

class Queue:
    def __init__(self):
        self.queue = deque()

    def enqueue(self, item):
        self.queue.append(item)

    def dequeue(self):
        if not self.is_empty():
            return self.queue.popleft()
        return "Queue is empty"

    def front(self):
        return self.queue[0] if not self.is_empty() else None

    def is_empty(self):
        return len(self.queue) == 0

    def display(self):
        print("Queue:", list(self.queue))

# Example
q = Queue()
q.enqueue("A")
q.enqueue("B")
q.enqueue("C")
q.display()
print("Dequeued:", q.dequeue())
print("Front:", q.front())
```
---

### 💻 JavaScript Implementation
```javascript
class Queue {
  constructor() {
    this.items = [];
  }

  enqueue(element) {
    this.items.push(element);
  }

  dequeue() {
    return this.items.length ? this.items.shift() : "Queue is empty";
  }

  front() {
    return this.items[0];
  }

  isEmpty() {
    return this.items.length === 0;
  }

  display() {
    console.log("Queue:", this.items);
  }
}

// Example
const q = new Queue();
q.enqueue("A");
q.enqueue("B");
q.enqueue("C");
q.display();
console.log("Dequeued:", q.dequeue());
console.log("Front:", q.front());
```

---

## 🔗 3. Linked Lists

### 💡 Definition
A **linked list** is a **linear data structure** where elements are stored in **nodes**, and each node contains:
- **Data** (the actual value)
- **Pointer** (reference to the next node)

Unlike arrays, linked lists do **not** store elements in contiguous memory.

### 🧠 Analogy
Think of linked list nodes as **train cars** — each car (node) carries data and is connected to the next via a **link**.

---

### 🧩 Types of Linked Lists
| Type | Description |
|------|--------------|
| **Singly Linked List** | Each node points to the next node |
| **Doubly Linked List** | Nodes point both to the next and previous nodes |
| **Circular Linked List** | Last node points back to the first node |

---

### 🐍 Python Implementation (Singly Linked List)
```python
class Node:
    def __init__(self, data):
        self.data = data
        self.next = None

class LinkedList:
    def __init__(self):
        self.head = None

    def append(self, data):
        new_node = Node(data)
        if not self.head:
            self.head = new_node
            return
        current = self.head
        while current.next:
            current = current.next
        current.next = new_node

    def display(self):
        current = self.head
        while current:
            print(current.data, end=" -> ")
            current = current.next
        print("None")

# Example
ll = LinkedList()
ll.append(10)
ll.append(20)
ll.append(30)
ll.display()
```
---

### 💻 JavaScript Implementation (Singly Linked List)
```javascript
class Node {
  constructor(data) {
    this.data = data;
    this.next = null;
  }
}

class LinkedList {
  constructor() {
    this.head = null;
  }

  append(data) {
    const newNode = new Node(data);
    if (!this.head) {
      this.head = newNode;
      return;
    }
    let current = this.head;
    while (current.next) {
      current = current.next;
    }
    current.next = newNode;
  }

  display() {
    let current = this.head;
    let output = "";
    while (current) {
      output += current.data + " -> ";
      current = current.next;
    }
    console.log(output + "null");
  }
}

// Example
const list = new LinkedList();
list.append(5);
list.append(10);
list.append(15);
list.display();
```

---

### ⚡ Key Differences Between Arrays and Linked Lists
| Feature | Array | Linked List |
|----------|--------|--------------|
| Memory | Contiguous | Non-contiguous |
| Access time | O(1) random access | O(n) traversal |
| Insertion/Deletion | Costly | Efficient (no shifting) |
| Size | Fixed (static) | Dynamic (grows/shrinks easily) |

![alt text](<_- visual selection.png>)