
class Node:
    def __init__(self,data):
        self.data=data
        self.next=None
    
class LinkedList:
    def __init__(self):
        self.head=None
    
    def insert_at_end(self,data):
        new_node=Node(data)

        if not self.head:
            self.head=new_node
            return
        temp=self.head
        while temp.next:
            temp=temp.next
        
        temp.next=new_node
    
    def insert_at_position(self,data,pos):
        new_node=Node(data)
        self.head=new_node