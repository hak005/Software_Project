

<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<!--This is the news page designed by bootstrap and programmed by php - Authors: Hassan Ali Khalil - Hussein Saleh -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Blog Page</title>
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
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
        <div class="col-sm-12">
          <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
          <?php
          global $ConnectingDB; 
          // SQL query when Searh button is active
          if(isset($_GET["SearchButton"])){
            $Search = $_GET["Search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':search','%'.$Search.'%');
            $stmt->execute();
          }// Query When Pagination is Active i.e Blog.php?page=1
          elseif (isset($_GET["page"])) {
            $Page = $_GET["page"];
            if($Page==0||$Page<1){
            $ShowPostFrom=0;
          }else{
            $ShowPostFrom=($Page*5)-5;
          }
            $sql ="SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
            $stmt=$ConnectingDB->query($sql);
          }
          // Query When Category is active in URL Tab
          elseif (isset($_GET["category"])) {
            $Category = $_GET["category"];
            $sql = "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
            $stmt=$ConnectingDB->query($sql);
          }

          // The default SQL query
          else{
            $sql  = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";/*!< Show only 4 posts per page*/
            $stmt =$ConnectingDB->query($sql);
          }
          while ($DataRows = $stmt->fetch()){/*! looping over all the posts table rows*/ 
            $PostId          = $DataRows["id"];
            $DateTime        = $DataRows["datetime"];
            $PostTitle       = $DataRows["title"];
            $Category        = $DataRows["category"];
            $Admin           = $DataRows["author"];
            $Image           = $DataRows["image"];
            $PostDescription = $DataRows["post"];
          ?>
          <div class="card">
            <img src="Uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" />
            <div class="card-body">
              <h4 class="card-title" style="text-align:right;"><?php echo htmlentities($PostTitle); ?></h4>
              <small class="text-muted" style="float:right;"><span class="text-dark"> <a href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> :الفئة <span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin); ?></a></span> :بواسطة <span class="text-dark"><?php echo htmlentities($DateTime); ?></span> :تم النشر في</small>
              <span style="float:left;" class="badge badge-dark text-light">
                 <?php echo ApproveCommentsAccordingtoPost($PostId);?> : التعليقات
				 
              </span>
			  <br>
              <hr>
              <p class="card-text" style="text-align:right;">
                <?php if (strlen($PostDescription)>150){/*! Show 150 characters of the news full details in the news page */  $PostDescription = substr($PostDescription,0,150)."...";} echo htmlentities($PostDescription); ?></p>
              <a href="FullPost.php?id=<?php echo $PostId; ?>" style="float:left;">
                <span class="btn btn-info">المزيد </span>
              </a>
            </div>
          </div>
          <br>
          <?php   } ?>
          <!-- Pagination -->
          <nav style="float:right;">
            <ul class="pagination pagination-lg">
              <!-- Creating Backward Button -->
              <?php if( isset($Page) ) {
                if ( $Page>1 ) {?>
             <li class="page-item">
                 <a href="Blog.php?page=<?php  echo $Page+1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
            global $ConnectingDB;/*!< a variable to refer to the database we are connected to*/
            $sql           = "SELECT COUNT(*) FROM posts";/*!< a variable to define a database query which counts all the rows in the posts table in the database*/
            $stmt          = $ConnectingDB->query($sql);/*!< a varaiable to perform the $sql query by the database*/
            $RowPagination = $stmt->fetch();/*!< a variable to fetch the $sql statement*/
            $TotalPosts    = array_shift($RowPagination);/*!< a variable to save the total number of the rows in the database and remove the first row which contains the titles */
            // echo $TotalPosts."<br>";
            $PostPagination=$TotalPosts/5; /*!< a variable to distribute the posts into many pages instead of infinite scrolling down the page */
            $PostPagination=ceil($PostPagination);
            // echo $PostPagination;
            for ($i=$PostPagination; $i >= 1 ; $i--){/*!  looping over all the pages */ 
              if( isset($Page) ){
                if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if ( isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="Blog.php?page=<?php  echo $Page-1; ?>" class="page-link">&raquo;</a>
           </li>
         <?php } }?>
            </ul>
          </nav>
        </div>
        <!-- Main Area End-->

        


      </div>

    </div>

    <!-- HEADER END -->
<br>
    <!-- FOOTER -->
    <footer class="bg-dark text-white">
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
<?php //require_once("footer.php");?> 
