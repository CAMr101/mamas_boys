<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link rel="stylesheet" href="./assets/css/msg.css">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection parameters
            $db_host = 'localhost';
            $db_user = 'root';
            $db_password = 'Gladbaloyi@24';
            $db_name = 'kota3';

            // Create a database connection
            $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

            // Check the connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // SQL query to fetch data from the database
            $sql = "SELECT id, username, email FROM users";

            // Execute the query
            $result = $connection->query($sql);

            // Check if there are rows in the result
            if ($result->num_rows > 0) {
                // Output data in the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }

            // Close the database connection
            $connection->close();
            ?>
        </tbody>
    </table>
</body>

</html>