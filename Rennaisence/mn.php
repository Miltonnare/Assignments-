
<?php
function rray(){
    $nums=[40,50,60,70,80];
    $total=0;

    foreach($nums as $num){
        $total+=$num;

    }
    $average=0;
    $average=$total/count($nums);

    echo $total ."\n";
    echo $average;



    
}

rray();

?>