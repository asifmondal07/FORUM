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
    #ques {
        min-height: 433vh;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `adiscuss` WHERE categories_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row= mysqli_fetch_assoc($result)){
        $catname=$row['categories_name'];
        $catdesc=$row['categories_desc'];
    }
    ?>
    <?php
    $showalert=false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST' ){
        $th_title=$_POST['title'];

        $th_title=str_replace("<","gt",$th_title);
        $th_title=str_replace(">","lt",$th_title);
        // this using for no javacript run
        $th_desc=$_POST['desc'];
        // this using for no javacript run
        $th_desc=str_replace("<","bt",$th_desc);
        $th_desc=str_replace(">","tt",$th_desc);

        $sno=$_POST['sno'];
        $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_user_id`, `thread_cat_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$sno', '$id', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
    }
    ?>
    <?php
         if($showalert){
             echo'<div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                </div>';
        }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Weawlcome to <?php echo $catname ?> forums</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p> Create unique posts.
                Keep posts courteous.
                Use respectful language when posting.
                Edit and delete posts as necessary using the tools provided by the forum.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    
    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
        echo'<div class="container my-3">
                <h1 class="py-3">Start A Discussion</h1>
                <form action="'. $_SERVER['REQUEST_URI'].'" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Thread Title</label>
                        <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
                        <div id="titleHelp" class="form-text">Keep Your Title As Crisp And Short As Possible .</div>
                    </div>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'"> 
                    <div class="mb-3">
                        <label for="floatingTextarea">Elaborate Your Concern</label>
                        <textarea class="form-control" id="desc" name="desc"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success my-2">Submit</button>
                </form>
            </div>';
        }
        else{
            echo'
            <div class="container">
            <h1 class="py-2">Start A Discussion</h1>
            <p class="lead">Your are not logged in. PLease login to able Start a discussion.</p>
            </div>';    
        }
        ?>
    <div class="container my-3">
        <h1 class="py-3">Browse Question</h1>
        <!-- Media top -->
        <?php
            $id=$_GET['catid'];
            $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result=mysqli_query($conn,$sql);
            $noresult=true;
            while($row= mysqli_fetch_assoc($result)){
                $noresult=false;
                $id=$row['thread_id'];
                $t_title=$row['thread_title'];
                $t_desc=$row['thread_desc'];
                $t_time=$row['timestamp'];
                $user_id=$row['thread_user_id'];

                $sql2="SELECT user_email FROM `users` WHERE sno='$user_id'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                

                echo'<div class="media my-3  id="ques"">
                        <div class="media-left media-top">
                            <img src="img/img_avatar1.png" class="media-object" style="width:60px">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading mt-0"><a class="text-dark" href="threadlist.php?threadid='. $id .'">'. $t_title .'</a></h4>
                            <p>'.$t_desc.'</p>   
                        </div>
                        <h7 calss="font-weight-bold my-0">Asked by: '. $row2['user_email'] .'  at '.$t_time.'</h7>    
                    </div>';
            }
           if($noresult){
               echo'<div class="alert alert-success alert-dismissible">
                        <strong><h2>No Question Found</h2></strong><br> Be the first person ask the question.
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