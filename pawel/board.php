<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="pl">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Tablica ogłoszeń</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Data dodania</th>
            <th>Kategoria</th>
            <th>Ogłaszający</th>
            <th>Temat</th>
            <th>Ogłoszenie</th>
            <th>Kontakt</th>
        </tr>

<?php

$con = mysql_connect('localhost', 'root', '');

if(!$con){
    die('Connection failed');
}

mysql_select_db('notices');

$query = 'SELECT date, category, submitter, subject, notice, mail FROM board';

$result = mysql_query($query);

$cols = array('date', 'category', 'submitter', 'subject', 'notice', 'mail');

while($row = mysql_fetch_array($result)){
    echo "<tr>";

    foreach($cols as $value){
        echo "<td>{$row["$value"]}</td>";
    }

    echo "</tr>";
}

mysql_close($con);

?>

    </table>
</body>
</html>
