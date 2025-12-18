<?php
session_start();
error_reporting(0);
include('budbconnection.php');
include("auths.php");

// Redirect to logout if the user is not logged in
if (strlen($_SESSION['username']) == 0) {
    header('location:logout.php');
    exit(); // Ensure the script stops after redirection
}

// Set the number of rows per page
$rows_per_page = 10;

// Determine the current page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the limit clause for SQL query
$offset = ($current_page - 1) * $rows_per_page;

// Initialize variables for search query
$searchTerm = '';
$whereClause = '';

// Check if search term is provided
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Avoid SQL injection
    $searchTerm = mysqli_real_escape_string($con, $searchTerm);
    // Create WHERE clause for search
    $whereClause = " WHERE FirstName LIKE '%$searchTerm%' OR designation LIKE '%$searchTerm%'";
}

// Modify your SQL query to include ORDER BY and LIMIT/OFFSET
$sql_query = "SELECT * FROM tblusers $whereClause ORDER BY position ASC LIMIT $offset, $rows_per_page";
$sql = mysqli_query($con, $sql_query);

// Fetch the total number of rows (without LIMIT)
$total_rows_sql = mysqli_query($con, "SELECT COUNT(*) FROM tblusers $whereClause");
$total_rows = mysqli_fetch_array($total_rows_sql)[0];

// Calculate total pages
$total_pages = ceil($total_rows / $rows_per_page);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="logo.svg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BracU staff Directory</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        body {
            background-image: url("3072.jpg");
        }
        .search-box {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .ui-sortable-helper {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <br>
    <center><img src="logo.svg" width="auto" height="80"></center>
    <br>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <center>
                                <h2>BracU staff Directory</h2>
                                <br>
                                <!-- Search Form -->
                                <div class="search-box">
                                    <form method="GET" action="staff_directory.php">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search by Name/Dept." name="search">
                                            <div class="input-group-addon"></div>
                                        </div>
                                    </form>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <table id="sortable" class="table table-striped table-hover">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Profile Pic</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cnt = $offset + 1; // Start from the offset value
                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                            <!-- Table rows -->
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['FirstName']; ?></td>
                                <td><?php echo $row['designation']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['MobileNumber']; ?></td>
                                <td><?php echo $row['Address']; ?></td>
                                <td><img src="profilepics/<?php echo $row['ProfilePic']; ?>" width="100" height="100"></td>
                            </tr>
                            <?php
                            $cnt++;
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Display pagination links only if there are records -->
                <?php if ($total_pages > 1) { ?>
                    <div class="pagination">
                        <?php if ($current_page > 1) { ?>
                            <a href='staff_directory.php?page=1'>First</a>
                            <a href='staff_directory.php?page=<?php echo ($current_page - 1); ?>'>&laquo; Previous</a>
                        <?php } ?>
                        <?php for ($i = max(1, $current_page - 5); $i <= min($current_page + 5, $total_pages); $i++) { ?>
                            <?php if ($i == $current_page) { ?>
                                <a class="active" href='staff_directory.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                            <?php } else { ?>
                                <a href='staff_directory.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($current_page < $total_pages) { ?>
                            <a href='staff_directory.php?page=<?php echo ($current_page + 1); ?>'>Next &raquo;</a>
                            <a href='staff_directory.php?page=<?php echo $total_pages; ?>'>Last</a>
                        <?php } ?>
                    </div>
                <?php } ?>
                <!-- Back link -->
                <h4 align="center" class="pages"><a href="staff_directory.php" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px">Back</a></h4>
            </div>
        </div>
    </div>
</body>
</html>
