<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haven Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="px-6 navbar-item" href="index.php" class="is-size-5">
                <img class="logo image" src="images/logo_icon_purple.png" alt="Haven Logo" height="auto"
                    href="index.php">
                Haven Management</a>
            </a>
        </div>

        <div class="navbar-menu">
            <div class="navbar-end">
                <a href="index.php" class="px-5 navbar-item">Home</a>
                <a href="search_records.php" class="px-5 navbar-item is-primary-text">Search Animals</a>
                <a href="pet_registration.php" class="px-5 navbar-item">Pet Registration</a>
                <a href="update_records.php" class="px-5 navbar-item">Update Records</a>
            </div>
        </div>
    </nav>

    <?php
    DEFINE('DB_USER', 'root');
    DEFINE('DB_PASSWORD', '');
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_NAME', '400013038');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    $animal_id = $_GET['animal_id'] ?? '';
    $animal_name = $_GET['animal_name'] ?? '';
    $animal_type = $_GET['animal_type'] ?? '';
    $date_of_birth = $_GET['date_of_birth'] ?? '';
    $breed = $_GET['breed'] ?? '';
    $allergies = $_GET['allergies'] ?? '';
    $medical_history = $_GET['medical_history'] ?? '';
    $owner_id = $_GET['owner_id'] ?? '';

    function getInputRange($input)
    {
        if ($input && strpos($input, '-') !== false) {
            $input_range = explode('-', $input);
            $input_start = intval($input_range[0]);
            $input_end = intval($input_range[1]);
        } elseif ($input) {
            $input_start = intval($input);
            $input_end = intval($input);
        } else {
            $input_start = null;
            $input_end = null;
        }

        return [
            'start' => $input_start,
            'end' => $input_end,
        ];
    }

    $animal_id_range = getInputRange($animal_id);
    $animal_id_start = $animal_id_range['start'];
    $animal_id_end = $animal_id_range['end'];

    $owner_id_range = getInputRange($owner_id);
    $owner_id_start = $owner_id_range['start'];
    $owner_id_end = $owner_id_range['end'];

    $sql = "SELECT * FROM animal WHERE 
                   animal_name LIKE '%$animal_name%' AND 
                   animal_type LIKE '%$animal_type%' AND 
                   date_of_birth LIKE '%$date_of_birth%' AND 
                   (breed LIKE '%$breed%' OR (breed IS NULL AND '$breed' = '')) AND 
                   (allergies LIKE '%$allergies%' OR (allergies IS NULL AND '$allergies' = '')) AND
                   (medical_history LIKE '%$medical_history%' OR (medical_history IS NULL AND '$medical_history' = ''))";

    if ($animal_id_start !== null && $animal_id_end !== null) {
        $sql .= " AND animal_id BETWEEN '$animal_id_start' AND '$animal_id_end'";
    } 

    if ($owner_id_start !== null && $owner_id_end !== null) {
        $sql .= " AND owner_id BETWEEN '$owner_id_start' AND '$owner_id_end'";
    } 

    $result = mysqli_query($conn, $sql);

    if (
        empty($animal_id) && empty($animal_name) && empty($animal_type) && empty($date_of_birth) &&
        empty($breed) && empty($allergies) && empty($medical_history) && empty($owner_id)
    ) {
        $sql = "SELECT * FROM animal";
        $result = mysqli_query($conn, $sql);
    }
    ?>

    <section class="section">
        <section class="section">
            <div class="columns mb-3">
                <div class="column">
                    <h1 class="title">Search Results</h1>
                </div>

                <div class="column-is-one-third">
                    <div class="columns">
                        <div class="column">
                            <a class="button is-primary" href="pet_registration.php">Add Animal Record</a>
                        </div>

                        <div class="column">
                            <a class="button is-primary" href="update_records.php">Update Records</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (mysqli_num_rows($result) > 0): ?>
                <table class="table is-fullwidth is-bordered is-striped">
                    <thead>
                        <tr>
                            <th class="has-text-centered">Animal ID</th>
                            <th class="has-text-centered">Animal Name</th>
                            <th class="has-text-centered">Animal Type</th>
                            <th class="has-text-centered">Date of Birth</th>
                            <th class="has-text-centered">Breed</th>
                            <th class="has-text-centered">Allergies</th>
                            <th class="has-text-centered">Medical History</th>
                            <th class="has-text-centered">Owner ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php while ($row = mysqli_fetch_assoc($result)):
                                echo "<td class='has-text-centered'>" . ($row['animal_id'] ?? '') . "</td>";
                                echo "<td class='has-text-centered'>" . ($row['animal_name'] ?? '') . "</td>";
                                echo "<td class='has-text-centered'>" . ($row['animal_type'] ?? '') . "</td>";
                                echo "<td class='has-text-centered'>" . ($row['date_of_birth'] ?? '') . "</td>";
                                echo "<td class='has-text-centered'>" . ($row['breed'] ?? '') . "</td>";
                                echo "<td class='has-text-centered'>" . ($row['allergies'] ?? '') . "</td>";
                                echo "<td class='has-text-centered'>" . ($row['medical_history'] ?? '') . "</td>";
                                echo "<td class='has-text-centered'>" . ($row['owner_id'] ?? '') . "</td>";
                                ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="has-text-centered p-4">
                    <img src="images/sad_dog_purple.png" alt="No Results" width="150" height="150">
                    <h2 class="title is-size-4 has-text-centered">No Results</h2>
                </div>
            <?php endif; ?>

            <?php mysqli_free_result($result); ?>
            </sectio>
        </section>

        <section class="section">
            <h1 class="title">Search</h1>
            <form method="get" action="">
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_id">Animal ID:</label>
                        <input class="input" type="text" name="animal_id" placeholder="E.g. Range: 2 - 3 or Single: 5"
                            value="<?php echo $animal_id; ?>">
                    </div>
                    <div class="field column">
                        <label class="label" for="animal_name">Animal Name:</label>
                        <input class="input" type="text" name="animal_name" placeholder="Buddy"
                            value="<?php echo $animal_name; ?>">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_type">Animal Type:</label>
                        <input class="input" type="text" name="animal_type" placeholder="Cat or Dog"
                            value="<?php echo $animal_type; ?>">
                    </div>
                    <div class="field column">
                        <label class="label" for="breed">Breed:</label>
                        <input class="input" type="text" name="breed" placeholder="German Shepherd"
                            value="<?php echo $breed; ?>">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="date_of_birth">Date of Birth:</label>
                        <input class="input" type="date" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="allergies">Allergies:</label>
                        <input class="input" type="text" name="allergies" value="<?php echo $allergies; ?>">
                    </div>
                    <div class="field column">
                        <label class="label" for="medical_history">Medical History:</label>
                        <input class="input" type="text" name="medical_history" value="<?php echo $medical_history; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="owner_id">Owner ID:</label>
                    <input class="input" type="text" name="owner_id" placeholder="E.g. Range: 2 - 3 or Single: 5"
                        value="<?php echo $owner_id; ?>">
                </div>

                <div class="field mt-5">
                    <button type="submit" class="button is-primary">Find Records</button>
                </div>
            </form>
        </section>

        <?php mysqli_close($conn); ?>
</body>

</html>