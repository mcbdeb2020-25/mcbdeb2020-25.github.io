<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop Table Rows</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
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
    <table id="sortable">
        <thead>
            <tr>
                <th>Order</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $host = 'localhost';
            $dbname = 'bu_emp';
            $username = 'bracuitsm';
            $password = 'BracUItsm20231971#@';

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Fetch rows from the database
                $stmt = $pdo->query("SELECT id, FirstName, position FROM tblusers ORDER BY position ASC");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr data-id='{$row['id']}'><td>{$row['position']}</td><td>{$row['FirstName']}</td></tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#sortable tbody").sortable({
                helper: function(e, tr) {
                    var $originals = tr.children();
                    var $helper = tr.clone();
                    $helper.children().each(function(index) {
                        $(this).width($originals.eq(index).width());
                    });
                    return $helper;
                },
                stop: function(event, ui) {
                    saveOrder();
                }
            }).disableSelection();

            function saveOrder() {
                var order = [];
                $('#sortable tbody tr').each(function(index, element) {
                    order.push({
                        id: $(element).data('id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    url: 'save_order.php',
                    method: 'POST',
                    data: { order: order },
                    success: function(response) {
                        alert('Order saved successfully!');
                        console.log('Order saved', response);
                    },
                    error: function(xhr, status, error) {
                        alert('Error saving order: ' + error);
                        console.log('Error saving order', status, error);
                    }
                });
            }
        });
    </script>
</body>
</html>
