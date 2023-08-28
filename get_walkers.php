<?php
require("db_config.php");

$walkerList = array();


$adminUsersQuery = "SELECT id, username, description, rating, rates FROM users WHERE adminlevel = 1";
$adminUsersResult = mysqli_query($con, $adminUsersQuery);

while ($row = mysqli_fetch_assoc($adminUsersResult)) {
    $rating = $row['rating'];
    $rates = $row['rates'];

    if ($rates != 0) {
        $averageRating = $rating / $rates;
    } else {
        $averageRating = 0;
    }

    $walkerList[] = array(
        'username' => $row['username'],
        'description' => $row['description'],
        'averageRating' => $averageRating
    );
}

header('Content-Type: application/json');
echo json_encode($walkerList);
?>
