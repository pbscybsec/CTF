<?php
require '../../admin_session.php';
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_challenge'])) {
    // Check if cat_id is set
    if (!isset($_POST['cat_id'])) {
        die('Category ID not set');
    }

    // Escape user inputs for security
    $ch_name = mysqli_real_escape_string($conn, $_POST['title']);
    $ch_desc = mysqli_real_escape_string($conn, $_POST['description']);
    $ch_cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $ch_score = mysqli_real_escape_string($conn, $_POST['score']);
    $ch_flag = mysqli_real_escape_string($conn, $_POST['flag']);

    // SQL query
    $sql = "INSERT INTO challenges (title, description, score, cat_id, flag) VALUES ('$ch_name', '$ch_desc', $ch_score, $ch_cat_id, '$ch_flag')";

    // Attempt to execute the query
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect on success
    header('Location: /anton/admin.php?p=challenges');
}
?>
