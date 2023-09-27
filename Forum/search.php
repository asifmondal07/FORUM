<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to aDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <style>
        .container{
            min-height:100vh;
        }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    
    <div class="container my-3 ">
    <h1 class="text-center">Search result for "<?php echo $_GET['search']?>" </h1>
        <div class="result my-3">
            <?php
                $noresult=true;

                $query= $_GET['search'];
                $sql="SELECT * FROM adiscuss WHERE match (categories_name) against('$query');";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($result);
                while($row){
                    $catname=$row['categories_name'];
                    $catdesc=$row['categories_desc'];
                    $catid=$row['categories_id'];
                    $url="threads.php?catid=$catid";
                    $noresult=false;
                    // echo' <h4><a  class="text-dark" href="'.$url.'">'.$catname.'</a></h4>
                    // <p>'.$catdesc.'</p>';
                    echo'<div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/500x400/?'. $catname .',coding" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><a href="'.$url. '">'.$catname.'</a></h5>
                                <p class="card-text">'. substr($catdesc, 0, 50) .'</p>
                                <a href="threads.php?catid=' .$url. '" class="btn btn-primary">View Threads</a>
                            </div>
                            </div>
                        </div>';
                        exit();    
                }
                if($noresult){
                    echo'<div class="alert alert-success alert-dismissible">
                            <strong><h2>No result found</h2></strong><br> Be the correct language name search.
                        </div>';
                }
            ?>
        </div>
    </div>
    
    <?php include 'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>