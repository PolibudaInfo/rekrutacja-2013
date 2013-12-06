<!DOCTYPE HTML>
<?php session_start();?>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
	<meta http-equiv="content-type" content="text/html; charset=UTF-16">
    <title>Dodawanie ogloszenia</title>
</head>
<body>

<?php
$nameflag = $emailflag = $commentflag = 0;
if(!(isset($_SESSION['nameErr']))) $_SESSION['nameErr']="";
if(!(isset($_SESSION['emailErr']))) $_SESSION['emailErr']="";
if(!(isset($_SESSION['commentErr']))) $_SESSION['commentErr']="";
if(!(isset($_SESSION['name']))) $_SESSION['name']="";
if(!(isset($_SESSION['email']))) $_SESSION['email']="";
if(!(isset($_SESSION['comment']))) $_SESSION['comment']="";

if($_SERVER["REQUEST_METHOD"] === "POST")
{
	$err=test_name($_POST["name"]);
	if(empty($err))
		{ $_SESSION['name'] = test_input($_POST["name"]); $nameflag = 1;}
	else
		{ $_SESSION['nameErr'] = $err; $_SESSION['name']=''; $commentflag = 0;}
	
	$err=test_email($_POST["email"]);
	if(empty($err))
		{ $_SESSION['email'] = test_input($_POST["email"]); $emailflag = 1;}
	else
		{ $_SESSION['emailErr'] = $err; $_SESSION['email']=''; $emailflag = 0;}
		
	$err=test_comment($_POST["comment"]);
	if(empty($err))
		{ $_SESSION['comment'] = test_input($_POST["comment"]); $commentflag = 1;}
	else
		{ $_SESSION['commentErr'] = $err; $_SESSION['comment']=''; $commentflag = 0;}
	$err='';
	
}

$name=$_SESSION['name']; $email=$_SESSION['email']; $comment=$_SESSION['comment'];

function test_email($string){
	$status=0;
	$dot=0;
	$i=-1;
	if (empty($string)){
		return "Email is required";}
	
	$length=strlen($string);
	$word=str_split($string);
	for($x=0; $x<$length; $x++){
		switch($word[$x]){
			case '/': case '\\': case '{': case '}': case '[':
			case ']': case ',':  case '?': case '|':
			return "E-mail address can't contain / \\ { } [ ] , ? | signs";}
		if($word[$x] == '@') 
			if($status==1) return 'E-mail is incorrect';
			else {$status=1; $i=$x;}
		if($word[$x]=='.'){
			if($status==1) $dot=1;
			if(($x-$i)==1){
				return 'E-mail is incorrect';}}
	}
	if(($status==0) or ($dot==0)){
		return 'E-mail is incorrect';}
	else return '';
}

function test_name($string){
	$length=strlen($string);
	if(empty($string)) return "Name is required";
	if($length>30) return "Name is too long";
	return '';
}

function test_comment($string){
	$length=strlen($string);
	if(empty($string)) return "What about comment?";
	if($length>500) return "Comment is too long";
	return '';
}

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Name: <input type="text" name="name" value= <?php echo $name; ?>>
	<span class="error"> <?php echo $_SESSION['nameErr'];?></span>
	<br><br>
	E-mail: <input type="text" name="email" value= <?php echo $email;?> >
	<span class="error"> <?php echo $_SESSION['emailErr'];?></span>
	<br><br>
	Comment: <textarea name="comment"  rows="5" cols="40"><?php echo $comment;?></textarea>
	<span class="error"> <?php echo $_SESSION['commentErr'];?></span>
	<br><br>
	<input type="submit" name="submit" value="Leave comment">
</form>

<?php

$link = mysqli_connect('localhost', 'root', '', 'my_db');
if(!$link) die ('Connection failed: ' . mysqli_connect_error());

if($nameflag and $commentflag and $emailflag){
	mysqli_query($link, "INSERT INTO persons (name, email, time, comment) VALUES ('$name', '$email', NOW(), '$comment')");
	$_SESSION['name']=$_SESSION['email']=$_SESSION['comment']='';}
	
$result=mysqli_query($link, "SELECT * FROM persons ORDER BY id DESC");
if(!$result) die ('Connection failed: ' . mysqli_connect_error());

echo "<h2> Comments: </h2>";

while($row = mysqli_fetch_array($result)){
	echo "<br><br>Name: " . $row["name"];
	echo "<br>E-mail: " . $row["email"];
	echo "<br>Comment: " . $row["comment"];
	// $time=$row['time'];
	// echo date("Y-m-d H:i:s", $time);
	echo "<br>Time: " .  $row['time'];
	// echo "<br>ID: " . $row["id"];
}

if($nameflag or $commentflag or $emailflag){
	if ($nameflag) $_SESSION['nameErr']='';
	if ($commentflag) $_SESSION['commentErr']='';
	if ($emailflag) $_SESSION['emailErr']='';
	header("Location: ". htmlspecialchars($_SERVER["PHP_SELF"]));}
	// header("Location: index.php");}
else {session_destroy(); }

mysqli_free_result($result);
mysqli_close($link);
?>

</body>
</html>