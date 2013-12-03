<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="pl">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Dodawanie ogłoszenia</title>
</head>

<body>
    <h1>Dodaj ogłoszenie!</h1>

<?php

$con = mysql_connect('localhost', 'root', '');

if(!$con){
    die('Connection failed');
}

mysql_select_db('notices');

$count_q = 'SELECT COUNT(*) AS count FROM board';
$result = mysql_query($count_q);
$row = mysql_fetch_array($result);
$count = $row['count'];

if( isset($_POST['category']) &&
    isset($_POST['submitter']) &&
    isset($_POST['subject']) &&
    isset($_POST['notice']) &&
    isset($_POST['mail'])){
    $query = 'INSERT INTO board (id, date, category, submitter, subject, notice, mail) VALUES (';
    $query .= ++$count.', ';
    $query .= '"'.date("Y.m.d").'", ';
    $query .= '"'.$_POST['category'].'", ';
    $query .= '"'.$_POST['submitter'].'", ';
    $query .= '"'.$_POST['subject'].'", ';
    $query .= '"'.$_POST['notice'].'", ';
    $query .= '"'.$_POST['mail'].'")';

    mysql_query($query);
}

mysql_close($con);

?>

    <form method="POST">
        <label>Kategoria:</label><br/>
        <input type="text" name="category"/><br/>
        <label>Nazwa ogłaszającego:</label><br/>
        <input type="text" name="submitter"/><br/>
        <label>Temat:</label><br/>
        <input type="text" name="subject"/><br/>
        <label>Ogłoszenie:</label><br/>
        <input type="textarea" name="notice"/><br/>
        <label>E-mail:</label><br/>
        <input type="text" name="mail"/><br/>
        <button type="submit">Dodaj</button>
    </form>
<p>
    <a href="board.php">Tablica ogłoszeń</a>
</p>

</body>
</html>
