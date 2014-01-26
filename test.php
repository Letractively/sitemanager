<?php

function changeNextGenOption() {
    $old = array("http://localhost/mybpa", "http://localhost/master_easy");
    $new = "http://localhost/mybpa";

    $conn = mysql_connect('192.168.2.67', 'root', '');
    if (!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    die();
    $mysqli = new mysqli('localhost', 'root', '', 'db_mybpa');
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        die();
    }
    echo 'Success... ' . $mysqli->host_info . "\n";
    die();
    $result = $mysqli->query("SELECT ID, post_content FROM wp_posts WHERE post_type='lightbox_library'");
    while ($row = mysqli_fetch_array($result)) {
        $newString = str_replace('\/', '/', base64_decode($row['post_content']));
        $newString = str_replace($old, $new, $newString);
        $cleaned = base64_encode(json_encode($newString));

        echo base64_decode($row['post_content'] . "</br></br>" . $newString . "</br>");

        $updQuery = "UPDATE wp_posts SET post_content=" . $cleaned . " WHERE some_column=" . $row['ID'];
        mysql_query($updQuery);
    }
}

changeNextGenOption();
?>
