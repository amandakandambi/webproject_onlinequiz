<!DOCTYPE>
<html>
	<?php require 'dbconfig.php';
		session_start(); ?>
	<head>

	<title>Online Quiz</title>
	<link rel="stylesheet" type="text/css" href="quiz.css">
		
	</head>

<body>
	<center>
		<div class="title">Online Quiz</div>
<?php 
	if (isset($_POST['click']) || isset($_GET['start'])) {
		@$_SESSION['clicks'] += 1 ;
		$c = $_SESSION['clicks'];
		if(isset($_POST['userans'])) { $userselected = $_POST['userans'];

$fetchqry2 = "UPDATE `quiz` SET `userans`='$userselected' WHERE `id`=$c-1"; 
$result2 = mysqli_query($con,$fetchqry2);
}
  

} else {
$_SESSION['clicks'] = 0;
}


?>
<br><br>
<div class="bump"><br>
<form><?php if($_SESSION['clicks']==0){ ?> <button class="button" name="start" float="left"><span>Let's start Quiz</span></button> <?php } ?></form></div>
<form action="" method="post">   
<table><?php if(isset($c)) {   $fetchqry = "SELECT * FROM `quiz` where id='$c'"; 
$result=mysqli_query($con,$fetchqry);
$num=mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC); }

  ?>

  <tr><td><h3><br><?php echo @$row['que'];?></h3></td></tr> <?php if($_SESSION['clicks'] > 0 && $_SESSION['clicks'] < 6){ ?>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 1'];?>">&nbsp;<?php echo $row['option 1']; ?><br>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 2'];?>">&nbsp;<?php echo $row['option 2'];?></td></tr>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 3'];?>">&nbsp;<?php echo $row['option 3']; ?></td></tr>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 4'];?>">&nbsp;<?php echo $row['option 4']; ?><br><br><br></td></tr>
  <tr><td><button class="buttonNext" name="click" >Next</button></td></tr> <?php }  
?> 
  <form>
<?php 
	if($_SESSION['clicks']>5){ 
	$qry3 = "SELECT `ans`, `userans` FROM `quiz`;";
	$result3 = mysqli_query($con,$qry3);
	$storeArray = Array();
	while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
     	if($row3['ans']==$row3['userans']){
	@$_SESSION['score'] += 1 ;
	}
	}

?> 


<h2>Result</h2>
<span>No. of Correct Answer:&nbsp;<?php echo $no = @$_SESSION['score']; 
session_unset(); ?></span><br>
<span>Your Score is:&nbsp<?php echo $no*2; ?></span><br><br><br><br>
<a href="home.html" >Go back to Home Page </a>
<?php } ?>


<!-- 
<script type="text/javascript">
    function radioValidation(){

	var uans = document.getElementsByName('userans');
	var tok;
	for(var i = 0; i < uans.length; i++){
		if(uans[i].checked){
			tok = uans[i].value;
			alert(tok);
	}
	}
    }
</script> 
-->

</center>
</body>
</html>