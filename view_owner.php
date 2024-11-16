<html>

<head>
    <title>Haven Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="px-6 navbar-item" href="../index.php" class="is-size-5">
                <img class="logo image" src="../images/logo_icon_purple.png" alt="Haven Logo" height="auto"
                    href="../index.php">
                Haven Management</a>
            </a>
        </div>

        <div class="navbar-menu">
            <div class="navbar-end">
                <a href="../index.php" class="px-5 navbar-item">Home</a>
                <a href="../search_records.php" class="px-5 navbar-item is-primary-text">Search Animals</a>
                <a href="../pet_registration.php" class="px-5 navbar-item">Pet Registration</a>
                <a href="../update_records.php" class="px-5 navbar-item">Update Records</a>
            </div>
        </div>
    </nav>


    <section class="section">
        <div class="columns mb-3">
            <div class="column">
                <h1 class="title">View Owner</h1>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="card px-3">
                    <div class="card-content">
                        <?php
                        DEFINE('DB_USER', 'root');
                        DEFINE('DB_PASSWORD', '');
                        DEFINE('DB_HOST', 'localhost');
                        DEFINE('DB_NAME', '400013038');

                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                        if (!$conn) {
                            die('Could not connect: ' . mysqli_connect_error());
                        }

                        $url = $_SERVER['REQUEST_URI'];
                        $url_parts = explode('/', $url);
                        $owner_id = end($url_parts);

                        $sql = "SELECT * FROM owner WHERE owner_id = '$owner_id';";

                        $conn = mysqli_connect("localhost", "root", "", "400013038");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $owner_id = $row['owner_id'];
                                $owner_name = $row['owner_fname'] . ' ' . $row['owner_lname'];
                                $owner_phone_number = $row['phone_number'];
                                $owner_email = $row['email_addr'];

                                echo "<div class='mb-6'>";
                                echo "<h3 class='is-size-5 mb-2'>Owner Details</h3>";
                                echo"<table class='table is-bordered is-striped'>
                                    <tbody>
                                        <tr>
                                            <th>Owner ID</th>
                                            <td>" . $owner_id . "</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>" . $owner_name . "</td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td>" . $owner_phone_number . "</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>" . $owner_email . "</td>
                                        </tr>
                                    </tbody>
                                </table>";
                                echo "</div>";
                            }

                        }

                        $sql = "SELECT * FROM animal WHERE owner_id = '$owner_id';";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<div class='mb-2'>";
                            echo "<h3 class='is-size-5 mb-3'>" . $owner_name . "'s Pets</h3>";
                            echo "<table class='table is-fullwidth is-bordered is-striped'>
                                    <thead>
                                        <tr>
                                            <th>Animal ID</th>
                                            <th>Animal Name</th>
                                            <th>Animal Type</th>
                                            <th>Date of Birth</th>
                                            <th>Breed</th>
                                            <th>Allergies</th>
                                            <th>Medical History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            ";
                            echo "</div>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                $animal_id = $row['animal_id'];
                                $animal_name = $row['animal_name'];
                                $animal_type = $row['animal_type'];
                                $date_of_birth = $row['date_of_birth'];
                                $breed = $row['breed'];
                                $allergies = $row['allergies'];
                                $medical_history = $row['medical_history'];

                                echo "<tr>
                                        <td>" . $animal_id . "</td>
                                        <td>" . $animal_name . "</td>
                                        <td>" . $animal_type . "</td>
                                        <td>" . $date_of_birth . "</td>
                                        <td>" . $breed . "</td>
                                        <td>" . $allergies . "</td>
                                        <td>" . $medical_history . "</td>
                                    </tr>";
                            }

                            echo "</tbody>
                                </table>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>