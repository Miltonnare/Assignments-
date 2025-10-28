
<?php
$array=array(
    array("name"=>"Burger",
            "price"=>5,
            "quantity"=>4
),
array("name"=>"Cola",
            "price"=>2,
            "quantity"=>4
),
array("name"=>"Juice",
            "price"=>3,
            "quantity"=>7
),
array("name"=>"Milk",
            "price"=>2,
            "quantity"=>6
),
);

echo '<table border="1">';
echo "<tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>";

foreach($array as $row){
    echo "<tr>";
    echo "<td> ". $row['name'] . "</td>";
    echo "<td> ". $row['price'] . "</td>";
    echo "<td> ". $row['quantity'] . "</td>";
    echo "<td> ".( $row['price']*$row['quantity'] ). "</td>";

    echo "</tr>";
    


};

echo "</table>";
?>