# Trees and Graphs Notes

## 🌳 Trees

### Analogy
A tree is like a family tree or computer folder structure.

### Key Terms
| Term | Meaning |
|------|---------|
| Node | A single element |
| Root | Top-most node |
| Child | Node under a parent |
| Parent | Node above a child |
| Leaf | Node with no children |
| Edge | Connection between nodes |
| Height | Number of levels in tree |

### Binary Tree Example
```
        A
       / \
      B   C
     / \
    D   E
```

### Python Example
```python
class Node:
    def __init__(self, value):
        self.value = value
        self.left = None
        self.right = None

root = Node("A")
root.left = Node("B")
root.right = Node("C")
root.left.left = Node("D")
root.left.right = Node("E")
```

### Preorder Traversal (Python)
```python
def preorder(node):
    if not node:
        return
    print(node.value, end=" ")
    preorder(node.left)
    preorder(node.right)

preorder(root)  # A B D E C
```

### JavaScript Example
```javascript
class Node {
  constructor(value) {
    this.value = value;
    this.left = null;
    this.right = null;
  }
}

const root = new Node("A");
root.left = new Node("B");
root.right = new Node("C");
root.left.left = new Node("D");
root.left.right = new Node("E");
```

### Preorder Traversal (JavaScript)
```javascript
function preorder(node) {
  if (!node) return;
  console.log(node.value);
  preorder(node.left);
  preorder(node.right);
}
preorder(root);
```

---

## 🌐 Graphs

### Analogy
A graph is like a city map where intersections are nodes and roads are edges.

### Key Concepts
| Term | Meaning |
|------|---------|
| Vertex/Node | Data point |
| Edge | Connection between vertices |
| Directed Graph | One-way connections |
| Undirected Graph | Two-way connections |
| Weighted Graph | Edges have cost (distance/time) |

### Adjacency List Representation
```
A → [B, C]
B → [D]
C → []
D → [A]
```

### Python Example
```python
graph = {
    "A": ["B", "C"],
    "B": ["D"],
    "C": [],
    "D": ["A"]
}
```

### DFS (Python)
```python
def dfs(node, visited=set()):
    if node in visited:
        return
    visited.add(node)
    print(node, end=" ")
    for neighbor in graph[node]:
        dfs(neighbor, visited)

dfs("A")  # A B D C
```

### JavaScript Example
```javascript
const graph = {
  A: ["B", "C"],
  B: ["D"],
  C: [],
  D: ["A"]
};

function dfs(node, visited = new Set()) {
  if (visited.has(node)) return;
  visited.add(node);
  console.log(node);
  for (let neighbor of graph[node]) {
    dfs(neighbor, visited);
  }
}

dfs("A");
```

---

## ⭐ Tree vs Graph Comparison

| Feature | Tree | Graph |
|--------|------|-------|
| Structure | Hierarchical | Network |
| Cycles | None | Can have cycles |
| Root | Always present | May not exist |
| Paths | One unique path | Multiple possible paths |

