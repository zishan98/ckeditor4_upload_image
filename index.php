<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <!-- TITLE -->
  <title> Blog </title>

  <!-- FAVICON -->
  <link rel="icon" href="assets/img/favicons.png">
		 
  <!-- BOOTSTRAP CSS -->
  <link  id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
  <!-- ckediter cdn link-->
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <!-- 	ckfinder folder link paste folder as per your require -->
  <script src="ckfinder/ckfinder.js"></script>
 
  <style>
   .ck-editor__editable_inline{
      height: 200px;
   }
  </style>

    </head>
<body>
 <form action="blog_function.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label class="">Title</label>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                  <div class="ql-wrapper ql-wrapper-demo mb-3">
                    <label class="">Blog Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="ckeditor" required></textarea>
                  </div>
                  <label class="">Upload Image</label>
                  <div class="p-4 border rounded-6 mb-4 form-group">
                    <div>
                      <input id="demo" type="file" name="image" accept="image/jpg, image/jpeg, image/png" required>
                    </div>
                  </div>
                </div>
                <div class="card-footer mb-1">
                  <button class="btn btn-primary" type="submit" name="submit_post">Post</button>
                  <a class="btn btn-secondary" href="blog-list.php">Back</a>
                </div>
              </form>
<!-- as a same code from here-->

 <script>
                    var description=    CKEDITOR.replace( 'description' );
                        CKFinder.setupCKEditor( description );
                </script>

</body>
</html>


