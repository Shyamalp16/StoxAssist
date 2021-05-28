<?php

require('connection.inc.php');
require('functions.inc.php');

$categories_id = get_safe_value($con, $_POST['categories_id']);
$sub_category_id = get_safe_value($con, $_POST['sub_cat_id']);

$res=mysqli_query($con, "select * from sub_category where category_id='$categories_id' and status='1'");
if(mysqli_num_rows($res) > 0){
    $html='';
    while($row=mysqli_fetch_assoc($res)){
        if($sub_category_id==$row['id']){
            $html.="<option value=".$row['id']." selected>".$row['sub_category']."</option>";
        }else{
            $html.="<option value=".$row['id'].">".$row['sub_category']."</option>";
        }
    }
    echo $html;
}else{
    echo "<option value=''> No Sub Categories</option>";
}

?>