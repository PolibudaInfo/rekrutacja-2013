<!DOCTYPE HTML>

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

if( isset($_POST['category']) &&
    isset($_POST['submitter']) &&
    isset($_POST['mail']) &&
    isset($_POST['subject']) &&
    isset($_POST['notice'])){
    $query = 'INSERT INTO board (category, submitter, mail, subject, notice) VALUES (';
    $query .= '"'.$_POST['category'].'", ';
    $query .= '"'.$_POST['submitter'].'", ';
    $query .= '"'.$_POST['mail'].'", ';
    $query .= '"'.$_POST['subject'].'", ';
    $query .= '"'.$_POST['notice'].'")';

    mysql_query($query);
}

mysql_close($con);

?>

    <form method="POST">
        <label>Kategoria:</label><br/>
        <input type="text" name="category"/><br/>
        <label>Nazwa ogłaszającego:</label><br/>
        <input type="text" name="submitter"/><br/>
        <label>E-mail:</label><br/>
        <input type="text" name="mail"/><br/>
        <label>Temat:</label><br/>
        <input type="text" name="subject"/><br/>
        <label>Ogłoszenie:</label><br/>
        <textarea name="notice" rows="8" cols="32"></textarea><br/>
        <button type="submit">Dodaj</button>
    </form>
<p>
    <a href="board.php">Tablica ogłoszeń</a>
</p>

</body>
</html>
