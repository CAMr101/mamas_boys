<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Message Page</title>
   <link rel="stylesheet" href="msg.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Message</th>
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
            $sql = "SELECT id, firstName, lastName, email, phoneNumber, message FROM messages";

            // Execute the query
            $result = $connection->query($sql);

            // Check if there are rows in the result
            if ($result->num_rows > 0) {
                // Output data in the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstName"] . "</td>";
                    echo "<td>" . $row["lastName"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phoneNumber"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";
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
