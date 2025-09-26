array=[4,5,10,7,6]
def largest():
    indexOne=array[0]
    for i in array:
        if i>indexOne:
            
        
            indexOne=i
    return indexOne
     
    
    

print("Largest number is:",largest())

