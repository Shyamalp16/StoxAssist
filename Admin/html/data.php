<?php 
    header('Content-Type: application/json');
    require('connection.inc.php');
    $query = "select name, qty from product";
    $result =mysqli_query($con,$query);

    $data = array();
    foreach ($result as $row){
        $data[] = $row;
    }

    print(json_encode($data));
    // print_r($data);
?>