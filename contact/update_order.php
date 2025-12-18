<?php
session_start();
include('budbconnection.php');

if(isset($_POST['dragged_id']) && isset($_POST['dropped_id'])) {
    $dragged_id = intval($_POST['dragged_id']);
    $dropped_id = intval($_POST['dropped_id']);

    // Update the order in the database
    $sql = "UPDATE tblusers SET order_column = $dropped_id WHERE ID = $dragged_id";
    $result = mysqli_query($con, $sql);

    if($result) {
        echo "Order updated successfully";
    } else {
        echo "Error updating order: " . mysqli_error($con);
    }
}
?>
