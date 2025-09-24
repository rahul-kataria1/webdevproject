<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Database Connection</title>
</head>
<body>
    
<?php
$connect = mysqli_connect(
    'localhost',
    'root',
    '',
    'CSV_DB 15');
    if(!$connect){
    die("Connection Failed " . mysqli_connect_error());
}

$query = "SELECT * FROM colors";
$colors = mysqli_query($connect, $query);

foreach($colors as $color){
    echo "<div style='background-color: " . $color['Hex'] . "; text-align: center; padding: 20px; margin: 10px; color: white;'>" . $color['Name'] . " - " . $color['Hex'] . "</div>";
}

?>

</body>
</html>