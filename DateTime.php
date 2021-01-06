<?php
date_default_timezone_set("Asia/Beirut");
$CurrentTime=time();/*!< a variable to save the time we are in */
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);/*!< a variable that uses strftime php built in function to format the time */
echo $DateTime;
?>