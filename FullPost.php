<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php $SearchQueryParameter = $_GET["id"]; /*!< a variable to get the news at the given id*/?>
<?php
if(isset($_POST["Submit"])){/*! checking if submit button is pressed */
  $Name    = $_POST["CommenterName"];
  $Email   = $_POST["CommenterEmail"];
  $Comment = $_POST["CommenterThoughts"];
  date_default_timezone_set("Asia/Beirut");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($Name)||empty($Email)||empty($Comment)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }elseif (strlen($Comment)>500) {
    $_SESSION["ErrorMessage"]= "Comment length should be less than 500 characters";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }else{
    // Query to insert comment in DB When everything is fine
    global $ConnectingDB;
    $sql  = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
    $sql .= "VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:postIdFromURL)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt -> bindValue(':dateTime',$DateTime);
    $stmt -> bindValue(':name',$Name);
    $stmt -> bindValue(':email',$Email);
    $stmt -> bindValue(':comment',$Comment);
    $stmt -> bindValue(':postIdFromURL',$SearchQueryParameter);
    $Execute = $stmt -> execute();
    //var_dump($Execute);
    if($Execute){
      $_SESSION["SuccessMessage"]="تم أرسال التعليق";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }else {
      $_SESSION["ErrorMessage"]="Something went wrong. Try Again !";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }
  }
} //Ending of Submit Button If-Condition
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
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
  <title>Full Post Page</title>

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
          <img src="Uploads/logo.png" width="100px" height="100px" class="nav-link">
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
        <div class="col-sm-12 ">
          <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
          <?php
          global $ConnectingDB;/*!< a variable that refers to the database we are connected to*/
          // SQL query when Searh button is active
          if(isset($_GET["SearchButton"])){/*! checking if the search button is pressed */
            $Search = $_GET["Search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':search','%'.$Search.'%');
            $stmt->execute();
          }
          // The default SQL query
          else{
            $PostIdFromURL = $_GET["id"];
            if (!isset($PostIdFromURL)) {
              $_SESSION["ErrorMessage"]="Bad Request !";
              Redirect_to("Blog.php?page=1");
            }
            $sql  = "SELECT * FROM posts  WHERE id= '$PostIdFromURL'";/*!< a variable to define an sql statement to get the news from the posts table in the database having the same id of the news we are accessing */
            $stmt =$ConnectingDB->query($sql);/*!< a variable to perform the sql statement by the database */
            $Result=$stmt->rowcount();/*!< a variable that counts the number of rows satisfying the condition in the sql statement */
            if ($Result!=1) {/*!checking if the variable $Result does not equal 1 that is the required row is not found in the database posts table or there are more than 1 row satisfying the condition */
              $_SESSION["ErrorMessage"]="Bad Request !";
              Redirect_to("Blog.php?page=1");
            }

          }
          while ($DataRows = $stmt->fetch()) {/*!looping over all the rows in the posts table in the database */
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
            <div class="card-body"style="text-align:right;">
              <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
              <small class="text-muted"> <span class="text-dark"> <a href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> :الفئة<span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin); ?></a></span> :بواسطة <span class="text-dark"><?php echo htmlentities($DateTime); ?></span> :تم النشر في</small>
            <hr>
              <p class="card-text">
                <?php echo nl2br($PostDescription); ?></p>
            </div>
          </div>
          <br>
          <?php   } ?>
          <!-- Comment Part Start -->
          <!-- Fetching existing comment START  -->
          <span class="FieldInfo" style="float:right;">التعليقات</span>
          <br><br>
        <?php
        global $ConnectingDB;
        $sql  = "SELECT * FROM comments
         WHERE post_id='$SearchQueryParameter' AND status='ON'";
        $stmt =$ConnectingDB->query($sql);
        while ($DataRows = $stmt->fetch()) {
          $CommentDate   = $DataRows['datetime'];
          $CommenterName = $DataRows['name'];
          $CommentContent= $DataRows['comment'];
        ?>
  <div>
    <div class="media CommentBlock">
      <img class="d-block img-fluid align-self-start" src="images/comment.png" alt="">
      <div class="media-body ml-2">
        <h6 class="lead"><?php echo $CommenterName; ?></h6>
        <p class="small"><?php echo $CommentDate; ?></p>
        <p><?php echo $CommentContent; ?></p>
      </div>
    </div>
  </div>
  <hr>
  <?php } ?>

        <!--  Fetching existing comment END -->

          <div>
            <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter ?>" method="post">
              <div class="card mb-3">
                <div class="card-header">
                  <h6 class="FieldInfo" style="float:right;">شاركنا رأيك حول هذا الخبر</h6>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                      
                    <input dir="rtl" class="form-control" type="text" name="CommenterName" placeholder="الإسم" value="">
					<div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      
                    <input dir="rtl" class="form-control" type="text" name="CommenterEmail" placeholder="البريد الإلكتروني" value="">
					<div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea dir="rtl" name="CommenterThoughts" class="form-control" rows="6" cols="80"></textarea>
                  </div>
                  <div class="" style="float:right;">
                    <button type="submit" name="Submit" class="btn btn-primary">أرسل</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
            <!-- Comment Part End -->
        </div>
        <!-- Main Area End-->
      </div>

    </div>

    <!-- HEADER END -->
    <!-- FOOTER -->
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center"><span id="year"></span> &copy; جميع الحقوق محفوظة<a href="https://www.facebook.com/%D9%86%D8%A7%D8%AF%D9%8A-%D8%A7%D9%84%D8%B3%D9%83%D8%B3%D9%83%D9%8A%D8%A9-%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%D9%8A-1549857041993240/" style="text-align:center;"><img src="Images/download.png" width="30" height="30"></a></p>
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
