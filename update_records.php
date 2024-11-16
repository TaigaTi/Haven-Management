<html>

<head>
    <title>Pet Registration</title>
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
                <a href="search_records.php" class="px-5 navbar-item">Search Animals</a>
                <a href="pet_registration.php" class="px-5 navbar-item">Pet Registration</a>
                <a href="update_records.php" class="px-5 navbar-item is-primary-text">Update Records</a>
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updated_animal_id = $_POST['animal_id'] ?? '';
        $updated_animal_name = $_POST['animal_name'];
        $updated_animal_type = $_POST['animal_type'];
        $updated_date_of_birth = $_POST['date_of_birth'];
        $updated_breed = $_POST['breed'];
        $updated_allergies = $_POST['allergies'];
        $updated_medical_history = $_POST['medical_history'];
        $updated_owner_id = $_POST['owner_id'];

        $params = [
            'animal_id' => $animal_id,
            'animal_name' => $animal_name,
            'animal_type' => $animal_type,
            'date_of_birth' => $date_of_birth,
            'breed' => $breed,
            'allergies' => $allergies,
            'medical_history' => $medical_history,
            'owner_id' => $owner_id,
            'animal_id_start' => $animal_id_start,
            'animal_id_end' => $animal_id_end,
            'owner_id_start' => $owner_id_start,
            'owner_id_end' => $owner_id_end,
        ];


        function whereCondition($params)
        {
            $sql = "WHERE animal_name LIKE '%$params[animal_name]%' AND 
            animal_type LIKE '%$params[animal_type]%' AND 
            date_of_birth LIKE '%$params[date_of_birth]%' AND 
            (breed LIKE '%$params[breed]%' OR (breed IS NULL AND '$params[breed]' = '')) AND 
            (allergies LIKE '%$params[allergies]%' OR (allergies IS NULL AND '$params[allergies]' = '')) AND
            (medical_history LIKE '%$params[medical_history]%' OR (medical_history IS NULL AND '$params[medical_history]' = ''))";

            if ($params['animal_id_start'] !== null && $params['animal_id_end'] !== null) {
                $sql .= " AND animal_id BETWEEN '$params[animal_id_start]' AND '$params[animal_id_end]'";
            }

            if ($params['owner_id_start'] !== null && $params['owner_id_end'] !== null) {
                $sql .= " AND owner_id BETWEEN '$params[owner_id_start]' AND '$params[owner_id_end]'";
            }

            return $sql;
        }

        $updates = [];

        if (!empty($updated_animal_id)) {
            $updates[] = "animal_id = '$updated_animal_id'";
        }
        if (!empty($updated_animal_name)) {
            $updates[] = "animal_name = '$updated_animal_name'";
        }
        if (!empty($updated_animal_type)) {
            $updates[] = "animal_type = '$updated_animal_type'";
        }
        if (!empty($updated_date_of_birth)) {
            $updates[] = "date_of_birth = '$updated_date_of_birth'";
        }
        if (!empty($updated_breed)) {
            $updates[] = "breed = '$updated_breed'";
        }
        if (!empty($updated_allergies)) {
            $updates[] = "allergies = '$updated_allergies'";
        }
        if (!empty($updated_medical_history)) {
            $updates[] = "medical_history = '$updated_medical_history'";
        }
        if (!empty($updated_owner_id)) {
            $updates[] = "owner_id = '$updated_owner_id'";
        }

        if (count($updates) > 0) {
            $sql_update = "UPDATE animal SET " . implode(", ", $updates) . " " . whereCondition([
                'animal_id' => $animal_id,
                'animal_name' => $animal_name,
                'animal_type' => $animal_type,
                'date_of_birth' => $date_of_birth,
                'breed' => $breed,
                'allergies' => $allergies,
                'medical_history' => $medical_history,
                'owner_id' => $owner_id,
                'animal_id_start' => $animal_id_start,
                'animal_id_end' => $animal_id_end,
                'owner_id_start' => $owner_id_start,
                'owner_id_end' => $owner_id_end,
            ]);
            mysqli_query($conn, $sql_update);
            header("Refresh:0");
        }
    }
    ?>

    <section class="section column">
        <section class="section">
            <div class="columns mb-3">
                <div class="column">
                    <h1 class="title">Update Records</h1>
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

        </section>
    </section>


    <section class="section" style="margin-top: -50px">
        <div class="px-6 pb-3">
            <div class="tabs is-toggle is-fullwidth">
                <ul>
                    <li class="filter-tab is-active" data-tab="filter">
                        <a>Filter Criteria</a>
                    </li>
                    <li class="update-tab" data-tab="update">
                        <a>Update Information</a>
                    </li>
                </ul>
            </div>
        </div>

        <section id="filter-section" class="section column box is-rounded is-shadowless">
            <h1 class="title">Filter Criteria</h1>
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

        <section id="update-section" class="section box is-rounded is-shadowless">
            <h1 class="title">Update Information</h1>
            <form method="post" action="">
                <div class="columns">
                    <?php
                        // If there are multiple records selected, show disabled input fields
                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="field column">
                                    <label class="label" for="animal_id">Animal ID:</label>
                                    <input class="input" type="text" name="animal_id" value="' . $animal_id . '" disabled>
                                </div>';
                        } else {
                            echo '<div class="field column">
                                    <label class="label" for="animal_id">Animal ID:</label>
                                    <input class="input" type="text" name="animal_id" placeholder="5">
                                </div>';
                        }
                        mysqli_free_result($result);
                    ?>
                    <div class="field column">
                        <label class="label" for="animal_name">Animal Name:</label>
                        <input class="input" type="text" name="animal_name" placeholder="Buddy">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_type">Animal Type:</label>
                        <input class="input" type="text" name="animal_type" placeholder="Cat or Dog">
                    </div>
                    <div class="field column">
                        <label class="label" for="breed">Breed:</label>
                        <input class="input" type="text" name="breed" placeholder="German Shepherd">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="date_of_birth">Date of Birth:</label>
                        <input class="input" type="date" name="date_of_birth">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="allergies">Allergies:</label>
                        <input class="input" type="text" name="allergies">
                    </div>
                    <div class="field column">
                        <label class="label" for="medical_history">Medical History:</label>
                        <input class="input" type="text" name="medical_history">
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="owner_id">Owner ID:</label>
                    <input class="input" type="text" name="owner_id" placeholder="2">
                </div>

                <div class="field mt-5">
                    <button type="submit" class="button is-danger is-dark">Update Records</button>
                </div>
            </form>
        </section>
    </section>



    <?php mysqli_close($conn); ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tabs li');
            const filterSection = document.getElementById('filter-section');
            const updateSection = document.getElementById('update-section');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('is-active'));
                    filterSection.style.display = 'none';
                    updateSection.style.display = 'none';

                    tab.classList.add('is-active');

                    if (tab.getAttribute('data-tab') === 'filter') {
                        filterSection.style.display = 'block';
                        updateSection.style.display = 'none';
                    } else if (tab.getAttribute('data-tab') === 'update') {
                        updateSection.style.display = 'block';
                        filterSection.style.display = 'none';
                    }
                });
            });

            filterSection.style.display = 'block';
            updateSection.style.display = 'none';
        });
    </script>
</body>

</html>