<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to aDiscuss - coding forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <!-- slider start here -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2540x600/?coding,python" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2540x600/?coding,html" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2540x600/?coding,css" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories start here -->
    <div class="container my-1">
      <h2 class="text-center my-3">aDiscuss - Browse Categories </h2>
        <div class="row">
          <?php
            $sql="SELECT * FROM `adiscuss`";
            $result=mysqli_query($conn,$sql);
            while($row= mysqli_fetch_assoc($result)){
              // echo $row['categories_id'];
              // echo $row['categories_name'];
              $id=$row['categories_id']; 
              $cat=$row['categories_name'];
              $desc=$row['categories_desc'];
              echo'<div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">
                      <img src="https://source.unsplash.com/500x400/?'. $cat .',coding" class="card-img-top" alt="...">
                      <div class="card-body">
                          <h5 class="card-title"><a href="threads.php?catid=' .$id. '">'.$cat.'</a></h5>
                          <p class="card-text">'. substr($desc, 0, 50) .'</p>
                          <a href="threads.php?catid=' .$id. '" class="btn btn-primary">View Threads</a>
                      </div>
                    </div>
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