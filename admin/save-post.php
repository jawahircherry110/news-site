<?php
 
 include "confiq.php";
     if(isset($_FILES['fileToUpload'])){
        $errors = array();

        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $file_ext =  end(explode('.',$file_name));
        $extentions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extentions) === false){
            $errors[] = "This extentiuon file is not alowed, please choose a jpg jpeg and png files";

        }
        if($file_size > 2097152){
            $errors[] = " File size must be 2MB or lower";
        }
        $new_name =  time(). "-".basename($file_name) ;
        $target = "upload/".$new_name;
        if(empty($errors) == true){
            move_uploaded_file($file_tmp,$target);
        }else{
            print_r($errors);
            die();
        }
     }
     session_start();
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
     $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
     $category = mysqli_real_escape_string($conn, $_POST['category']);
     $date = date("d M, Y");
     $author = $_SESSION['user_id'];
     
     $sql = "INSERT INTO post(title,description,category,post_date,author,post_img) 
             VALUES('{$title}','{$description}',{$category},'{$date}',{$author},'$new_name');";
    echo $sql;

    $sql .="UPDATE category SET post = post + 1 WHERE category_id = {$category}";
    if(mysqli_multi_query($conn, $sql)){
        header("location:{$hostname}/admin/post.php");
    }else{
        echo "<div class='alert alert-danger'>Query Failed</div>";
    }

?>