# 🧠 User-Defined Data Structures — Amateur-Level Questions

This document contains theory, coding, and analytical questions that cover the basics of user-defined data structures, including **Linked Lists, Stacks, Queues, Trees, and Graphs**.  

---

## 🧩 Section 1: Conceptual / Theory Questions

1. What is a **user-defined data structure**, and how does it differ from a built-in data type in Python?  
2. Why do we need to create user-defined data structures when Python already provides lists, tuples, and dictionaries?  
3. Define the term **Node** in the context of linked data structures.  
4. Explain the difference between **linear** and **non-linear** data structures. Give examples.  
5. What is the difference between a **Stack** and a **Queue** in terms of data access and removal order?  
6. How is memory dynamically allocated in linked data structures like linked lists?  
7. What is the role of the `self.next` pointer/reference in a linked list node?  
8. In what situation would you prefer to use a **Linked List** over an **Array/List**?  
9. Define the operations that can be performed on a Stack.  
10. What is meant by **enqueue** and **dequeue** operations in a Queue?  
11. What is the **difference between a singly and doubly linked list**?  
12. Describe what happens during a **push** operation in a stack implemented using a linked list.  
13. How does a **circular queue** differ from a normal queue?  
14. What does the term **underflow** mean in the context of stacks and queues?  
15. Explain what a **Tree** is and mention its main components (root, node, child, leaf, etc.).  
16. What is the **difference between a binary tree and a binary search tree (BST)**?  
17. What is meant by **traversal** in a tree or graph?  
18. Define **adjacency list** and **adjacency matrix** in graph representation.  
19. Why are user-defined data structures important in large-scale software development?  
20. What are some advantages and disadvantages of implementing your own data structures?

---

## 💻 Section 2: Hands-On / Coding Questions (Python)

1. Write a Python class called `Node` that represents a node in a linked list.  
2. Implement a simple **Linked List** class with methods `insert_at_beginning(data)` and `print_list()`.  
3. Write a method `insert_at_position(data, pos)` for inserting a node at a specific position in a linked list.  
4. Write a Python program to implement a **Stack** using a Linked List.  
5. Implement the `push()` and `pop()` methods for your stack class and demonstrate their use.  
6. Write a Python program that uses a **Queue** implemented via linked list.  
7. Implement the operations `enqueue()`, `dequeue()`, and `peek()` for your queue.  
8. Write a program to reverse a linked list.  
9. Write a function to count the number of nodes in a linked list.  
10. Implement a **circular queue** using a list or an array.  
11. Create a **doubly linked list** class and implement `insert`, `delete`, and `display_forward()` methods.  
12. Write a Python program to check whether a given linked list is empty or not.  
13. Write a Python program to implement a **binary tree** and perform **inorder**, **preorder**, and **postorder** traversals.  
14. Implement a function to find the **minimum and maximum** value in a Binary Search Tree (BST).  
15. Write a function that inserts nodes into a BST according to BST rules.  
16. Implement a simple **graph** using an adjacency list representation.  
17. Write a function to add a vertex and an edge in a graph.  
18. Write a function to perform **Breadth-First Search (BFS)** on a graph represented using an adjacency list.  
19. Implement **Depth-First Search (DFS)** for the same graph.  
20. Create a custom data structure that behaves like a queue but limits the size to 5 elements (fixed-size queue).

---

## 🔍 Section 3: Analytical / Short-Answer Questions

1. Compare **Array-based** vs **Linked List-based** Stack implementations in terms of performance and memory.  
2. What happens internally when you pop an element from a linked-list-based stack?  
3. How can you detect a **loop** in a linked list?  
4. What is the **time complexity** of inserting at the beginning vs at the end of a linked list?  
5. Why is a **circular queue** useful for managing limited memory buffers?  
6. How can a **queue** be implemented using **two stacks**?  
7. Explain how you can represent a **graph** using both adjacency matrix and adjacency list.  
8. Compare the **DFS** and **BFS** traversal strategies.  
9. How would you modify a linked list to make it **doubly linked**?  
10. What are the benefits of using user-defined data structures in algorithm design?

---

## 🧩 Bonus: Mini Project-Style Tasks

1. Build a **Text Undo/Redo System** using two Stacks.  
2. Implement a **Task Scheduler** using a Queue (FIFO principle).  
3. Build a **Browser History** simulation using a doubly linked list.  
4. Implement a **Parking Lot Management System** using a circular queue.  
5. Build a simple **Contact Directory** using a Binary Search Tree (name → number).  
6. Create a **Graph of Friends** to show mutual connections using an adjacency list.

---

### ✨ Tip:
To master user-defined data structures, start by implementing:
- A **Node** class (foundation)
- Then build **Linked List**, **Stack**, **Queue**
- Progress to **Trees** and **Graphs**

Recreate each structure from scratch and trace how data flows through it!
