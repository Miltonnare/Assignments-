
<?php

$score=100;

if($score>=90){
    echo "Grade:A";
}

elseif($score>=80&&$score<90){
    echo "Grade:B";
}
elseif($score>=70 && $score<80){
    echo "Grade:C";
}

elseif($score>=60 && $score<70){
    echo "Grade:D";
}
else{
    echo"Failed";

}




?>