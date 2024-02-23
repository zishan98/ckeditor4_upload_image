<?php

session_start();
include_once('config.php');
if (isset($_POST['submit_post'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $image = basename($_FILES['image']['name']);
    $time = "blog-" . date("d-m-Y") . "-" . rand(99, 00);
    $file_name1 = $time . "-" . $image;
    $folder = "blog-image/";
    $targetfile1 = $folder . $file_name1;
    $imageFileType1 = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    if (
        $imageFileType1 == "jpg" || $imageFileType1 == "png" || $imageFileType1 == "jpeg"
    ) {
        $max_size = 1024 * 1024; // 1MB 
        if ($_FILES['image']['size'] <= $max_size) {
            $insert_first = "INSERT INTO `blog`(`title`, `description`, `images`) VALUES ('$title','$description','$file_name1')";
            $res = mysqli_query($con, $insert_first);
            move_uploaded_file($_FILES['image']['tmp_name'], $targetfile1);
            if ($res) {
                $_SESSION['message'] = 'Blog Post Successfully..!';
                header("location:add-blog.php");
                exit();
            } else {
                $_SESSION['error'] = "Oops something went wrong..!";
                header("location:add-blog.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Sorry, your file is too large. Please upload an image of size 1MB or less.";
            header("Location:add-blog.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, and PNG files are allowed.";
        header("Location:add-blog.php");
        exit();
    }
}

// update code
else if (isset($_POST['post_edit'])) {
    $id = $_POST['id'];
    $update_name = mysqli_real_escape_string($con, $_POST['title']);
    $update_designation = mysqli_real_escape_string($con, $_POST['description']);
    // $image = basename($_FILES['image']['name']);       
    $old_img = $_POST['old_img'];    
    $max_size = 1024 * 1024; // 1024KB    
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $blog_img = uniqid() . '_' . basename($_FILES['image']['name']);        
        if (file_exists("blog-image".$old_img)) {
            unlink("blog-image".$old_img);
        }        
        if ($_FILES["image"]["size"] <= $max_size) {            
                move_uploaded_file($_FILES["image"]["tmp_name"], 'blog-image/' . $blog_img);                
                $update = "UPDATE `blog` SET `title`='$update_name',`description`='$update_designation',
                `images`='$blog_img' WHERE id='$id'";
                $update_run = mysqli_query($con, $update);
                if($update_run){
                    $_SESSION['message'] ="Data Updated Successfully..!";
                    header("location:edit.php?id=".$id);
                    exit();
                 }else{
                    $_SESSION['error'] ="Something went wrong!";
                    header("location:edit.php?id=".$id);
                    exit();                    
                 }            
        } else {
            $_SESSION['error'] = "Sorry, your file is too large. Please upload an image of size 500KB or less.";
            header("location:edit.php?id=".$id);
            exit();
        }
    }
     else {
        // If no new image is uploaded, use the existing image name
        $blog_img = $old_img;
        $update = "UPDATE `blog` SET `title`='$update_name',`description`='$update_designation',
        `images`='$blog_img' WHERE id='$id'";
        $update_run = mysqli_query($con, $update);

        if ($update_run) {
            $_SESSION['message'] = "Data Updated Successfully..!";
            header("location:edit.php?id=".$id);
            exit();
        } else {
            $_SESSION['error'] = "Something went wrong!";
            header("location:edit.php?id=".$id);
            exit();
        }
    }
}
?>
