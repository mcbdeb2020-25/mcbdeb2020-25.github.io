<?php
session_start();
error_reporting(0);
include('budbconnection.php');
include("auth.php");

// Redirect to logout if the user is not logged in
if (strlen($_SESSION['username']) == 0) {
    header('location:logout.php');
    exit(); // Ensure the script stops after redirection
}

// Code for deletion
if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $profilepic = $_GET['ppic'];
    $ppicpath = "profilepics" . "/" . $profilepic;
    $sql = mysqli_query($con, "DELETE FROM tblusers WHERE ID=$rid");
    
    if ($sql) {
        unlink($ppicpath);
        echo "<script>alert('Data deleted');</script>";
    } else {
        echo "<script>alert('Failed to delete data');</script>";
    }
    echo "<script>window.location.href = 'view_member.php'</script>";
}

// Set the number of rows per page
$rows_per_page = 10;

// Determine the current page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the limit clause for SQL query
$offset = ($current_page - 1) * $rows_per_page;

// Modify your SQL query to include LIMIT and OFFSET
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = '';
if (!empty($searchTerm)) {
    $searchQuery = "WHERE CONCAT_WS('', FirstName, designation, Email, MobileNumber, Address) LIKE '%$searchTerm%'";
}
$sql = mysqli_query($con, "SELECT * FROM tblusers $searchQuery LIMIT $offset, $rows_per_page");

// Fetch the total number of rows (without LIMIT)
$total_rows_sql = mysqli_query($con, "SELECT COUNT(*) FROM tblusers $searchQuery");
$total_rows = mysqli_fetch_array($total_rows_sql)[0];

// Calculate total pages
$total_pages = ceil($total_rows / $rows_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>BracU Admin Contact List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>BracU Admin Contact List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all">
    <style>
        body {
            background-image: url("3072.jpg");
        }
    </style>
    <script>
        // JavaScript code for drag-and-drop functionality
        // Function to handle drag start event
        function dragStart(event) {
            event.dataTransfer.setData("text/plain", event.target.id);
        }

        // Function to handle drag over event
        function dragOver(event) {
            event.preventDefault();
        }

        // Function to handle drop event
        function drop(event) {
            event.preventDefault();
            var data = event.dataTransfer.getData("text");
            var draggedElement = document.getElementById(data);
            var droppedElement = event.target.closest('tr');

            // Swap the positions of the dragged and dropped elements
            if (draggedElement && droppedElement) {
                var parent = droppedElement.parentNode;
                var indexDragged = Array.prototype.indexOf.call(parent.children, draggedElement);
                var indexDropped = Array.prototype.indexOf.call(parent.children, droppedElement);

                // Update the order in the UI
                if (indexDragged < indexDropped) {
                    parent.insertBefore(draggedElement, droppedElement.nextSibling);
                } else {
                    parent.insertBefore(draggedElement, droppedElement);
                }

                // Send AJAX request to update the order in the database
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_order.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("dragged_id=" + draggedElement.id + "&dropped_id=" + droppedElement.id);
            }
        }
    </script>


    <style>
        body {
            background-image: url("3072.jpg");
        }
    </style>
    <script>
        // Function to handle drag start event
        function dragStart(event) {
            event.dataTransfer.setData("text/plain", event.target.id);
        }

        // Function to handle drag over event
        function dragOver(event) {
            event.preventDefault();
        }

        // Function to handle drop event
        function drop(event) {
            event.preventDefault();
            var data = event.dataTransfer.getData("text");
            var draggedElement = document.getElementById(data);
            var droppedElement = event.target.closest('tr');

            // Swap the positions of the dragged and dropped elements
            if (draggedElement && droppedElement) {
                var parent = droppedElement.parentNode;
                var indexDragged = Array.prototype.indexOf.call(parent.children, draggedElement);
                var indexDropped = Array.prototype.indexOf.call(parent.children, droppedElement);

                // Update the order in the UI
                if (indexDragged < indexDropped) {
                    parent.insertBefore(draggedElement, droppedElement.nextSibling);
                } else {
                    parent.insertBefore(draggedElement, droppedElement);
                }

                // Send AJAX request to update the order in the database
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_order.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("dragged_id=" + draggedElement.id + "&dropped_id=" + droppedElement.id);
            }
        }
    </script>
</head>

<body>
    <br>
    <center><img src="logo.svg" width="auto" height="80">
        <br>
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>BracU Admin Contact List</h2>
                                <br>
                                <!-- Search Form -->
                                <div class="search-box">
                                    <form method="GET" action="view_member.php">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search by Name/Dept." name="search">
                                            <div class="input-group-addon"><i class="material-icons">search</i></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <table class="table table-striped table-hover">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Profile Pic</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                <!-- Table rows -->
                                <tr id="<?php echo $row['ID']; ?>" draggable="true" ondragstart="dragStart(event)" ondrop="drop(event)" ondragover="dragOver(event)">
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['FirstName']; ?></td>
                                    <td><?php echo $row['designation']; ?></td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['MobileNumber']; ?></td>
                                    <td><?php echo $row['Address']; ?></td>
                                    <td><img src="profilepics/<?php echo $row['ProfilePic']; ?>" width="100" height="100"></td>
                                    <td>
                                        <!-- Add your actions here -->
                                        <a href="read.php?viewid=<?php echo htmlentities($row['ID']); ?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                        <a href="edit.php?editid=<?php echo htmlentities($row['ID']); ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                        <a href="view_member.php?delid=<?php echo htmlentities($row['ID']); ?>&ppic=<?php echo htmlentities($row['ProfilePic']); ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <?php
                                $cnt = $cnt + 1;
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- Display pagination links only if there are records -->
                    <?php if ($total_pages > 1) { ?>
                        <div class="pagination">
                            <?php if ($current_page > 1) { ?>
                                <a href='view_member.php?page=1'>First</a>
                                <a href='view_member.php?page=<?php echo ($current_page - 1); ?>'>&laquo; Previous</a>
                            <?php } ?>

                            <?php
                            // Adjust the pagination links to show the correct range based on the current page and total pages
                            $start_page = max(1, $current_page - 2);
                            $end_page = min($current_page + 2, $total_pages);

                            for ($i = $start_page; $i <= $end_page; $i++) {
                                if ($i == $current_page) {
                                    echo "<a class='active' href='view_member.php?page=$i'>$i</a>";
                                } else {
                                    echo "<a href='view_member.php?page=$i'>$i</a>";
                                }
                            }
                            ?>

                            <?php if ($current_page < $total_pages) { ?>
                                <a href='view_member.php?page=<?php echo ($current_page + 1); ?>'>Next &raquo;</a>
                                <a href='view_member.php?page=<?php echo $total_pages; ?>'>Last</a>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <!-- Back link -->
                    <h4 align="center" class="pages"><a href="view_member.php" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px">Back</a></h4>
                </div>
            </div>
        </div>
</body>

</html>
