<?php
session_start();

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
<div class="container-fluid">
  <a class="navbar-brand" href="/Forum/index.php">aDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse"                    ia-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Forum/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categorise
          </a>
          <ul class="dropdown-menu">';
          $sql="SELECT categories_name,categories_id FROM `adiscuss` LIMIT 5";
          $result=mysqli_query($conn,$sql);
          while($row= mysqli_fetch_assoc($result)){
           echo' <li><a class="dropdown-item" href="threads.php?catid='.$row['categories_id'].'">'.$row['categories_name'].'</a></li>';
            
          }
            
      echo'</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" tabindex="-1" href="contact.php">contact</a>
        </li>
    </ul>';
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
      echo'<form class="d-flex" role="search  method="get" action="search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success type="submit">Search</button>
          <p class="text-light mt-2 mx-2 text-justify">Welcome:>'.$_SESSION['useremail'].'</p>
          <a href="partials/_logout.php" type="logout" class="btn btn-outline-success">Logout </a>   
         </form>';  
      }
      
    else{
      echo'<form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
          <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button  type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
        </form>';
    }
 echo'</div>
</div>
</nav>';
include 'partials/_login-modal.php';
include 'partials/_signup-modal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo'<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
        <strong>SUCCESS</strong> Your login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
  echo'<div class="alert alert-warning my-0 alert-dismissible fade show" role="alert">
        <strong>warning</strong> Passwoard not match.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
?>