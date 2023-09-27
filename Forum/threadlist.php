<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to aDiscuss - coding forums</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <style>
            #ques{
                min-height:100vh;
            }
        </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row= mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];

        $user_id=$row['thread_user_id'];                                                $sql2="SELECT user_email FROM `users` WHERE sno='$user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $POSTED_BY=$row2['user_email'];
    }
    ?>
    <?php
    $showalert=false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $comment=$_POST['comment'];
        // this using for no javacript run
        $comment=str_replace("<","gt",$comment);
        $comment=str_replace(">","lt",$comment);
        
        $sno=$_POST['sno'];
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
    }
    ?>
    <?php
         if($showalert){
             echo'<div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Success</h4>
                    <p>Your comment has been added.</p>
                </div>';
        }
    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p> Create unique posts.
                Keep posts courteous.
                Use respectful language when posting.
                Edit and delete posts as necessary using the tools provided by the forum.</p>
            <p><b>Psted by : <?php echo $POSTED_BY ?></b></p>
        </div>
    </div>
   
    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){  
            echo'<div class="container my-3">
                        <h1 class="py-3">Post A Comment</h1>
                        <form action="'. $_SERVER['REQUEST_URI'].'" method="POST">
                            <div class="mb-3">
                                <label for="floatingTextarea">Type Your Comment</label>
                                <textarea class="form-control" id="comment" name="comment"></textarea>
                                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                            </div>
                            <button type="submit" class="btn btn-success my-2">Post Comment</button>
                        </form>
                </div>';
        }
        else{
            echo'
            <div class="container">
            <h1 class="py-2">Post a comment</h1>
            <p class="lead">Your are not logged in. PLease login to able Post a comment.</p>
            </div>';    
        } 
    ?>        
    <div class="container my-3">
        <h1 class="py-3">Browse Question</h1>
        <!-- Media top -->
        <?php
            $id=$_GET['threadid'];
            $sql="SELECT * FROM `comments` WHERE thread_id=$id";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            while($row= mysqli_fetch_assoc($result)){
                $noresult=false;
                $id=$row['comment_id'];
                $content=$row['comment_content'];
                $comment_time=$row['comment_time'];

                $user_id=$row['comment_by'];
                $sql2="SELECT user_email FROM `users` WHERE sno='$user_id'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);

                echo'<div class="media my-3  id="ques"">
                        <div class="media-left media-top">
                            <img src="img/img_avatar1.png" class="media-object" style="width:60px">
                        </div>
                        <div class="media-body">
                            <h5>'.$row2['user_email'].' at '. $comment_time .'</h5>
                            <p>'.$content.'</p>   
                        </div>
                    </div>';
            }
           if($noresult){
               echo'<div class="alert alert-success alert-dismissible">
                        <strong><h2>No Comments Found</h2></strong><br> Be the first person ask the Comments.
                    </div>';
           }
        ?>
    </div>  
    
    <?php include 'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>