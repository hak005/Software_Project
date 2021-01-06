<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<!--This is the home page designed by bootstrap and programmed by php - Author: Hassan Ali Khalil-->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Kfar Tebenit Sports Club</title>
  <style media="screen">
  .heading{
      font-family: Bitter,Georgia,"Times New Roman",Times,serif;
      font-weight: bold;
       color: #005E90;
  }
  .heading:hover{
    color: #0090DB;
  }
  </style>
  
</head>
<body>
<main>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
     
	  <ul class="navbar-nav ml-auto">
	    <button  class="btn btn-success" name="Login"><a href="login.php" style="text-decoration:none; color:white;" >تسجيل الدخول</a></button>&nbsp;
        <form class="form-inline d-none d-sm-block" action="Blog.php">
          <div class="form-group">
		  
		  <button  class="btn btn-primary" name="SearchButton">إبحث</button>&nbsp;
          <input dir="rtl" class="form-control mr-2" type="text" name="Search" placeholder="إبحث هنا"value="">
          
          </div>
        </form>
      </ul>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav ml-auto flex-column-reverse flex-md-row">
        
        <li class="nav-item">
          <a href="about.php" class="nav-link">حول النادي</a>
        </li>
		<li class="nav-item">
          <a href="calendar.php" class="nav-link">الأحداث</a>
        </li>
		<li class="nav-item">
          <a href="gallery.php" class="nav-link">الصور</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">الأخبار</a>
        </li>
		<li class="nav-item">
          <a href="index.php" class="nav-link ">الصفحة الرئيسة</a>
        </li>
      </ul>
	  
	  <ul class="navbar-nav">
        <li class="nav-item">
          <img src="Uploads/logo1.jpeg" width="100px" height="100px" class="nav-link">
        </li>
      </ul>
      
      </div>
    </div>
  </nav>
  <div style="height:10px; background:#27aae1;"></div>
    
    <!-- NAVBAR END -->
    <!-- HEADER -->
    
      

        <!-- Main Area Start-->
        
          <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
          <?php
          global $ConnectingDB;/*!<a variable that refers to the database we are connected to*/
          
		  
		    $sql1  = "select * from posts ORDER BY id DESC LIMIT 1";/*!< a variable that defines an sql statement to get the breaking news which is the latest news inserted in the database*/
            $stmt1 =$ConnectingDB->query($sql1);/*!< a variable to perform the sql1 statement by the database*/ 
			while ($DataRow = $stmt1->fetch()) {/*loop over all the rows in the posts table in the database*/
				$brk       = $DataRow["title"];
            
		  ?>
		  <svg width="100%" height="100" style="font-size:20px; font-weight:bold; margin-top:10px;">
			<text x="20" y="15" style="color=red;" fill="red">
				 خبر عاجل: <?php  echo htmlentities($brk);?>
				<animate attributeName="x" from="-500" to="1500" dur="10s" repeatCount="indefinite" fill="freeze">
			</text>
		  </svg>
		  <center><h1>أهلاً و سهلاً بكم في صفحة بلدة كفرتبنيت</h1></center>
		 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="Images/home1.jpeg" alt="First slide" height="700" >
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="Images/home2.jpeg" alt="Second slide" height="600" >
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="Images/home3.jpeg" alt="Third slide" height="600" >
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">السابق</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">التالي</span>
			</a>
		</div>

	</main>
	<br>
		
					
			
		
	   
		  
	
		  
    <!-- FOOTER -->
    <footer class="bg-dark text-white" style="margin-top:100px;>
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center"> جميع الحقوق محفوظة&nbsp;&copy;<span id="year"></span><a href="https://www.facebook.com/shabab.kafartibnit.sc" style="text-align:center;"><img src="Images/download.png" width="30" height="30"></a> </p>
           </div>
         </div>
      </div>
    </footer>
        <div style="height:10px; background:#27aae1;"></div>
    <!-- FOOTER END-->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
  $('#year').text(new Date().getFullYear());
</script>
</body>
</html>
<?php //require_once("footer.php");
			}?> 
