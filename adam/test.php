<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ogłoszenia</title>
</head>
<body>



<div>
<form action="test.php" method = "post">
<p>Nick: <br /><input type="text" name="nick"/></p>
<p>Tytuł: <br /><input type="text" name="title"/></p>
<p>Treść ogłoszenia: <br /><textarea name="content"></textarea></p>
<input type="submit" class="submit" value=" Dodaj ogłoszenie " />
</form>
</div>
<hr/>

<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "baza";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");

mysqli_query($con, 'SET NAMES utf8');

if(isset($_POST['content']) && $_POST['content'] != NULL)
{
$nick=$_POST['nick'];
if($nick == "") $nick="Anonim";
$nick = mysqli_real_escape_string($con, $nick);

$title=$_POST['title'];
if($title == "") $title="BRAK TYTUŁU";
$title = mysqli_real_escape_string($con, $title);

$content=$_POST['content'];
$content = mysqli_real_escape_string($con, $content);

$date = date("Y-m-d");

$sql=mysqli_query($con, "insert into Ogloszenia values(NULL, '$nick', '$title', '$content', '$date')");
}

$sql=mysqli_query($con, "select * from Ogloszenia");
while($row=mysqli_fetch_array($sql))
{
$nick=$row['nick'];
$title=$row['title'];
$content=$row['content'];
$date=$row['date'];
?>
<div>
<h2><?php echo $title; ?></h2>
<p><?php echo $content; ?></p>
<p><?php echo $nick; ?></p>
<p><?php echo $date; ?></p><hr/>
</div>
<?php
}

?>


</body>
</html>