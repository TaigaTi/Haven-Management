<html>

<head>
    <title>Haven Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>

<body>
    <?php
    DEFINE('DB_USER', 'root');
    DEFINE('DB_PASSWORD', '');
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_NAME', 'haven');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die('Could not connect:' . mysqli_connect_error());
    }

    // Print Search Results
    $animal_id = $_POST['animal_id'] ?? '';
    $animal_name = $_POST['animal_name'] ?? '';
    $animal_type = $_POST['animal_type'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $breed = $_POST['breed'] ?? '';
    $allergies = $_POST['allergies'] ?? '';
    $medical_history = $_POST['medical_history'] ?? '';
    $owner_id = $_POST['owner_id'] ?? '';

    $sql = "SELECT * FROM animal WHERE animal_id = '$animal_id' AND animal_name LIKE '%$animal_name%' AND animal_type LIKE '%$animal_type%' AND date_of_birth LIKE '%$date_of_birth%' AND breed LIKE '%$breed%' AND owner_id LIKE'%$owner_id%'";
    $result = mysqli_query($conn, $sql);


    // Print Animals Table
    $all = "SELECT * FROM animal";
    if (
        $animal_id == '' && $date_of_birth == '' && $owner_id == ''
        && $animal_name == '' && $animal_type == '' && $breed == ''
        && $allergies == '' && $medical_history == ''
    ) {
        $result = mysqli_query($conn, $all);
    }

    echo "
    <section class='section'>
    <section class='section'>
        <h1 class='title'>Search Results</h1>
        <table class='table is-fullwidth is-bordered is-striped'>
        <tr>
    ";

    if (mysqli_num_rows($result) > 0) {
        echo " 
            <th class='has-text-centered'>Animal ID</th>
            <th class='has-text-centered'>Animal Name</th>
            <th class='has-text-centered'>Animal Type</th>
            <th class='has-text-centered'>Date of Birth</th>
            <th class='has-text-centered'>Breed</th>
            <th class='has-text-centered'>Allergies</th>
            <th class='has-text-centered'>Medical History</th>
            <th class='has-text-centered'>Owner ID</th>
        ";
    } else {
        echo "
        <div class='has-text-centered p-4'>
            <img src='sad_dog.png' alt='No Results' width='150' height='150'> 
        </div>";
        echo "<h1 class='title is-size-4 has-text-centered'>No Results</h1>";
    }

    echo "</tr></section>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td class='has-text-centered'>" . $row['animal_id'] . "</td>";
        echo "<td class='has-text-centered'>" . $row['animal_name'] . "</td>";
        echo "<td class='has-text-centered'>" . $row['animal_type'] . "</td>";
        echo "<td class='has-text-centered'>" . $row['date_of_birth'] . "</td>";
        echo "<td class='has-text-centered'>" . $row['breed'] . "</td>";
        echo "<td class='has-text-centered'>" . $row['allergies'] . "</td>";
        echo "<td class='has-text-centered'>" . $row['medical_history'] . "</td>";
        echo "<td class='has-text-centered'>" . $row['owner_id'] . "</td>";
        echo "</tr></section>";
    }
    echo "</table>";

    // Print Buttons
    echo "
        <section class='section columns is-8'>
            <div class='column has-text-centered'>
                <a class='button is-primary is-fullwidth' href='new_animal.php'>Add Record</a>
            </div>

            <div class='column has-text-centered'>
                <a class='button is-primary is-fullwidth' href='update_animal.php'>Update Record</a>
            </div>
        </section>
    ";

    // Print Search Form
    echo "
        <h1 class='title'>Search</h1>
        <form method='post' action=''>
            <div class='columns'>
                <div class='field column'>
                    <label class='label' for='animal_id'>Animal ID:</label>
                    <input class='input' type='text' name='animal_id'>
                </div>

                <div class='field column'>
                    <label class='label' for='animal_name'>Animal Name:</label>
                    <div class='control'>
                        <input class='input' type='text' name='animal_name'>
                    </div>
                </div>
            </div>

            <div class='columns'>
              <div class='field column'>
                <label class='label' for='animal_type'>Animal Type:</label>
                <div class='control'>
                    <input class='input' type='text' name='animal_type'>
                </div>
              </div>

              <div class='field column'>
                    <label class='label' for='breed'>Breed:</label>
                    <div class='control'>
                        <input class='input' type='text' name='breed'>
                    </div>
                </div>
            </div>
            
            <div class='columns'>
                <div class='field column'>
                    <label class='label' for='date_of_birth'>Date of Birth:</label>
                    <div class='control'>
                        <input class='input' type='date' name='date_of_birth'>
                    </div>
                </div>
            </div>

            <div class='field'>
                <label class='label' for='owner_id'>Owner ID:</label>
                <div class='control'>
                    <input class='input' type='text' name='owner_id'>
                </div>
            </div>
            
            <section class='py-5'>
                <button type='submit' class='button is-primary'>Search</button>
            </section>
        </form>
    ";

    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>

</html>