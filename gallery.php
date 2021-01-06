<!DOCTYPE html>
<!--This is the gallery page designed by bootstrap and programmed by google drive api - Authors: HAK-->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Gallery Page</title>
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

  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
     
	  <ul class="navbar-nav ml-auto">
		<button  class="btn btn-success" name="Login"><a href="login.php" style="text-decoration:none; color:white;" >تسجيل الدخول</a></button>&nbsp;
      </ul>
	  <form class="form-inline d-none d-sm-block" action="Blog.php">
          <div class="form-group">
		  <button  class="btn btn-primary" name="SearchButton">إبحث</button>&nbsp;
          <input dir="rtl" class="form-control mr-2" type="text" name="Search" placeholder="إبحث هنا"value="">
          
          </div>
        </form>
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
    <div style="height:10px; background:#27aae1;"></div><br>
    <!-- NAVBAR END -->
	<!-- Gallery -->
	
	
  
  <style>
* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.33%;
  padding: 15px;
  height: 300px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
          <div class="row">
              <div class="column">
                  <img src="Uploads/logo1.jpeg" alt="Snow" style="width:100%">
              </div>
              <div class="column">
                  <img src="Images/home3.jpeg" alt="Forest" style="width:100%">
              </div>
            <div class="column">
                <img src="Images/home2.jpeg" alt="Mountains" style="width:100%">
            </div>
           
            </div>
       
	<br>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
  $('#year').text(new Date().getFullYear());
</script>
</html>
<?php //require_once("footer.php");?> 


</html>
