<?php
    $file = $_FILES['imageurl'];
    var_dump($file); 
    $uploaddir = '../image/production/'; //이미지폴더이름
    $uploadfile = $uploaddir .basename($file['name']);
    move_uploaded_file($file['tmp_name'],$uploadfile);
    $con = mysqli_connect("localhost", "corona0113", "kimdh991!", "corona0113");
    $sql = "insert into shopproduction(name,price,brief,brand,imageurl,recommend,type,sales)
    values('{$_POST['name']}',
    '{$_POST['price']}',
    '{$_POST['brief']}','{$_POST['brand']}',
    '/teamplay/image/production/{$file['name']}',
    {$_POST['recommend']},'{$_POST['type']}',{$_POST['sales']})
    ";
    echo $sql; 
    $result = mysqli_query($con,$sql);
    if($result){
        header("Location:../productwrite.php");
    }else{
        echo "게시글 작성에 실패했습니다.";
    }
?>