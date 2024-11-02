<html>
    <head>
        <title>Haven Management</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    </head>

    <body>
        <?php
            DEFINE('DB_USER', 'root');
            DEFINE('DB_PASSWORD', '');
            DEFINE('DB_HOST', 'localhost');
            DEFINE('DB_NAME', 'haven');

            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if(!$conn) {
                die('Could not connect:'. mysqli_connect_error());
            }

            // Print Animals Table
            $haven = "SELECT * FROM animal";
            $result = mysqli_query($conn, $haven);
            
            echo "
                <section class='section'>
                <table class='table is-fullwidth is-bordered is-striped'>
                <tr>
                <th class='has-text-centered'>Animal ID</th>
                <th class='has-text-centered'>Animal Name</th>
                <th class='has-text-centered'>Animal Type</th>
                <th class='has-text-centered'>Date of Birth</th>
                <th class='has-text-centered'>Breed</th>
                <th class='has-text-centered'>Allergies</th>
                <th class='has-text-centered'>Medical History</th>
                <th class='has-text-centered'>Owner ID</th>
                </tr>
                </section>
            ";
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td class='has-text-centered'>" . $row['animal_id'] . "</td>";
                echo "<td class='has-text-centered'>" . $row['animal_name'] . "</td>";
                echo "<td class='has-text-centered'>" . $row['animal_type'] . "</td>";
                echo "<td class='has-text-centered'>" . $row['date_of_birth'] . "</td>";
                echo "<td class='has-text-centered'>" . $row['breed'] . "</td>";
                echo "<td class='has-text-centered'>" . $row['allergies'] . "</td>";
                echo "<td Class='px-5'>" . $row['medical_history'] . "</td>";
                echo "<td class='has-text-centered'>" . $row['owner_id'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_free_result($result);
            mysqli_close($conn);
        ?>

        <section class="section columns is-8">
           <div class="column">
                <a class="button is-primary" href="new_animal.php">Add Record</a>
            </div>
           <div class="column">
                <a class="button is-primary" href="new_animal.php">Update Record</a>
            </div>
        </section>
    </body>
</html>
