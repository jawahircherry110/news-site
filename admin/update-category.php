    

<?php include "header.php";
 
if($_SESSION["user_role"] == '0'){
  header("Location:{$hostname}/admin/post.php");
}


if(isset($_POST['submit'])){
    include "confiq.php";
    $catid =mysqli_real_escape_string($conn, $_POST['cat_id']);
    $catname =mysqli_real_escape_string($conn, $_POST['cat_name']);
    $post =mysqli_real_escape_string($conn,$_POST['post']);
    

 $sql = "UPDATE category SET category_name = '{$catname}', post = '{$post}' WHERE catagory_id = {$catid}";

    if(mysqli_query($conn,$sql)){
        header("Location:{$hostname}/admin/catagory.php");
    }
}



?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="Html" placeholder="" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
