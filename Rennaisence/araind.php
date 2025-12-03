
<?php

$serveName="localhost";
$passworsd="";
$username="";

$conn=new mysqli($serveName,$passworsd,$username);

if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

echo "succesfully connected";


$array=[70,68,78,90,56];

foreach ($array as $index){
    echo $index. "\n";
}


$Array2=[[
    "Name"=>"Milton",
    "Color"=>"White",

],


[
    "Name"=>"Mike",
    "Color"=>"Chocolate"
]
];

foreach ($Array2 as $item){

echo "Name:" . $item['Name'] ."\n";
echo "Color:" . $item['Color']. "\n";
}

?>