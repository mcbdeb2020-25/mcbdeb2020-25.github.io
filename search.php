<!DOCTYPE html>
<html>
<head>
    <title>Name and Contact Number Search Results</title>
</head>
<body>
    <h1>Search Results</h1>
    <?php
    // Check if the search query is set
    if (isset($_POST['search'])) {
        // Get the search query from the form data
        $searchQuery = $_POST['search'];

        // Connect to your database (replace the placeholders with your actual database credentials)
        $host = 'localhost';
        $dbname = 'domain';
        $username = 'bracuitsm';
        $password = 'BracUItsm20231971#@';

        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the search query using a prepared statement
            $stmt = $db->prepare("SELECT * FROM requisition WHERE name LIKE :search");
            $stmt->bindValue(':search', '%' . $searchQuery . '%');
            $stmt->execute();

            // Fetch the search results
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display the search results
            if (!empty($results)) {
                echo '<table>';
                echo '<tr><th>Name</th><th>Contact Number</th></tr>';

                foreach ($results as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['contact_number'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo 'No results found.';
            }
        } catch (PDOException $e) {
            echo 'Database connection error: ' . $e->getMessage();
        }
    }
    ?>
</body>
</html>
