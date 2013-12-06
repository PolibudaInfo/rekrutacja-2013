<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Comments</title>
</head>

<body>
<div class="container">
	<div class="header">
		<p class="header_theme">Comments</p>
	</div>
    <div class="main">
    	<div class="text">
    		<p class="main_theme">What users say about this:</p>
<?php
	$new_user = (isset($_REQUEST['username'])) ? $_REQUEST['username'] : null;
	$new_comment = (isset($_REQUEST['mess'])) ? $_REQUEST['mess'] : null;
	
	function PrintComments($set){
		echo "<ul>";
		
		while (($row = $set->fetch_assoc()) != false){
			echo "<li>";
			echo '<table width="100%" border="0"><tr>';
			echo "<td><b>{$row['username']}</b> said:</td>";
			echo '<td class="table_date">';
			echo "<i>{$row['date']}</i></td></tr><tr>";
			echo '<td colspan="2">';
			echo "{$row['comment']}</td>";			   
			echo "</tr></table></li>";
		}
		echo "</ul>";
	}

	$con = new mysqli ('localhost', 'root', '', 'comment');
	$con->query ("SET NAMES 'utf8'");
	
	if(!$con){
		die('Connection failed');
	}
	
	if (trim($new_user) != "" || trim($new_comment) !="") {
		$added = $con->query("INSERT INTO `user_comments` (`username`,`comment`) VALUES ('$new_user','$new_comment')");
		echo '<p class="warning">Your comment was added!</p>';
	}
	/*else{
		echo '<p class="warning">EMPTY!</p>';
	}*/
	$set = $con->query("SELECT * FROM `user_comments` `username` ORDER BY `id` DESC");	
	PrintComments($set);
	
	$con->close();
?>
			<div class="form">
				<form method="POST" action="index.php"> 
				<p>Username:</p>
				<input type="text" name="username"/>
                <br />
				<p>Comment:</p>
				<textarea name="mess" rows="5" cols="50"></textarea><br /><br />
				<button type="submit">Add</button>
				</form>
        	</div>
        </div>
    </div>
	<div class="footer">
    	<p>&copy Vladyslav Hubar</p>
    </div>
</div>
</body>
</html>

    
    
  

