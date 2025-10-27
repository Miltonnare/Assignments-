
# 🧠 DATA STRUCTURES NOTES (Part 1) — Python Focus

## 🔹 1. Definition of Data Structures

A **Data Structure** is a **way of organizing, managing, and storing data** so that it can be accessed and modified efficiently.  

In simpler terms, it’s **how data is arranged in memory** so that algorithms can process it easily.

### 🧩 Analogy:
Think of a **data structure as a storage container**:
- A **list** is like a **shopping list**.
- A **dictionary** is like a **real dictionary** (word → meaning).
- A **tuple** is like a **receipt** (you can read it, but can’t change it).
- A **set** is like a **bag of unique marbles** — no duplicates allowed.

---

## 🔹 2. Types of Data Structures

Data structures can be broadly classified into **two categories**:

### A. Linear Data Structures
Data elements are arranged in a **sequential manner** — one after another.  
Each element is connected to the previous and next elements.

**Examples:**
- Array
- List
- Stack
- Queue
- Linked List

📘 **Analogy:** Like a **train**, where each compartment follows the other in a line.

### B. Non-Linear Data Structures
Data elements are **not arranged sequentially**.  
They are organized **hierarchically or as a network**.

**Examples:**
- Tree
- Graph
- Hash Table

📘 **Analogy:** Like a **family tree** or a **map of cities** — not in a straight line, but connected in various ways.

---

![alt text](<Create a visual diagram that clearly explains the types of data structures in programming. - visual selection.png>)


## 🔹 3. Built-in Python Data Structures

### A. Arrays

An **array** is a collection of items stored at **contiguous memory locations**.  
All elements must be of the **same data type**.

#### ✅ Python Example
```python
import array

numbers = array.array('i', [10, 20, 30, 40])
print(numbers[0])        # Accessing first element
numbers.append(50)       # Adding an element
numbers.remove(20)       # Removing an element

for num in numbers:
    print(num)
```

💡 **Analogy:** Think of an **array** like a **row of identical lockers** — each can only store one type of item.

---

### B. Lists

A **list** is a **dynamic array** — it can store **different data types** and can grow or shrink in size.

#### ✅ Python Example
```python
fruits = ["apple", "banana", "cherry"]
fruits.append("mango")      # Add an element
fruits.remove("banana")     # Remove element
print(fruits[1])            # Access by index
print(fruits)               # Display full list
```

💡 **Analogy:** A **list** is like a **shopping list** — you can add or remove items anytime.

#### ⚙️ Common List Methods

| Method | Description | Example |
|--------|--------------|----------|
| `.append(x)` | Add element at the end | `list.append(5)` |
| `.insert(i, x)` | Insert at position | `list.insert(2, 'apple')` |
| `.remove(x)` | Remove element | `list.remove('banana')` |
| `.pop()` | Remove last element | `list.pop()` |
| `.sort()` | Sort elements | `list.sort()` |
| `.reverse()` | Reverse order | `list.reverse()` |

---

### C. Tuples

A **tuple** is an **ordered, immutable** collection of items.  
Once created, its elements **cannot be changed**.

#### ✅ Python Example
```python
coordinates = (10.5, 20.7)
print(coordinates[0])     # Accessing first item

# coordinates[0] = 5  ❌ Error: Tuples are immutable
```

💡 **Analogy:** A **tuple** is like a **sealed envelope** — you can read what’s inside, but can’t modify it.

#### ⚙️ When to Use Tuples
- When data **should not change** (e.g., GPS coordinates, dates).
- For **faster performance** (tuples are faster than lists).
- When used as **dictionary keys** (lists can’t be keys because they’re mutable).

---

### D. Dictionaries

A **dictionary** stores data in **key-value pairs**.  
It’s **unordered**, **mutable**, and allows **fast lookups**.

#### ✅ Python Example
```python
student = {
    "name": "Abdi",
    "age": 21,
    "course": "Computer Science"
}

print(student["name"])          # Access value by key
student["age"] = 22             # Update value
student["university"] = "MUT"   # Add new key-value pair

print(student)
```

💡 **Analogy:** A **dictionary** is like a **real dictionary** — you look up a *word* (key) to find its *meaning* (value).

#### ⚙️ Common Dictionary Methods

| Method | Description | Example |
|--------|--------------|----------|
| `.keys()` | Returns all keys | `student.keys()` |
| `.values()` | Returns all values | `student.values()` |
| `.items()` | Returns key-value pairs | `student.items()` |
| `.get(key)` | Safely get value | `student.get("age")` |
| `.pop(key)` | Remove key-value | `student.pop("age")` |

---

### E. Sets

A **set** is an **unordered collection of unique elements** — no duplicates allowed.

#### ✅ Python Example
```python
numbers = {1, 2, 3, 3, 4, 5}
print(numbers)  # {1, 2, 3, 4, 5}

numbers.add(6)
numbers.remove(2)
print(numbers)
```

💡 **Analogy:** A **set** is like a **bag of unique coins** — duplicates don’t count.

#### ⚙️ Set Operations

| Operation | Description | Example |
|------------|-------------|----------|
| `A.union(B)` | Combine both sets | `{1,2,3}.union({3,4,5})` → `{1,2,3,4,5}` |
| `A.intersection(B)` | Common elements | `{1,2,3}.intersection({2,3,4})` → `{2,3}` |
| `A.difference(B)` | Elements in A not in B | `{1,2,3}.difference({2,3,4})` → `{1}` |

---

## 🧾 Summary Table

| Data Structure | Ordered | Mutable | Allows Duplicates | Indexed | Example |
|----------------|----------|----------|------------------|----------|----------|
| **Array** | ✅ | ✅ | ✅ | ✅ | `[10, 20, 30]` |
| **List** | ✅ | ✅ | ✅ | ✅ | `["a", "b", "c"]` |
| **Tuple** | ✅ | ❌ | ✅ | ✅ | `(1, 2, 3)` |
| **Dictionary** | ❌ | ✅ | Keys unique | Keys only | `{"name": "Abdi"}` |
| **Set** | ❌ | ✅ | ❌ | ❌ | `{1, 2, 3}` |
