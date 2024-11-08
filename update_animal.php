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
                <a href="search_animals.php" class="px-5 navbar-item">Search Animals</a>
                <a href="new_animal.php" class="px-5 navbar-item">Pet Registration</a>
                <a href="update_animal.php" class="px-5 navbar-item is-primary-text">Update Records</a>
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

    $sql = "SELECT * FROM animal WHERE 
                animal_id LIKE '$animal_id%' AND 
                animal_name LIKE '%$animal_name%' AND 
                animal_type LIKE '%$animal_type%' AND 
                date_of_birth LIKE '%$date_of_birth%' AND 
                (breed LIKE '%$breed%' OR breed IS NULL AND '$breed' = '') AND 
                (allergies LIKE '%$allergies%' OR allergies IS NULL AND '$allergies' = '') AND
                (medical_history LIKE '%$medical_history%' OR medical_history IS NULL AND '$medical_history' = '') AND
                (owner_id LIKE '%$owner_id%' OR owner_id IS NULL AND '$owner_id' = '')";

    $result = mysqli_query($conn, $sql);

    if (
        empty($animal_id) && empty($animal_name) && empty($animal_type) && empty($date_of_birth) &&
        empty($breed) && empty($allergies) && empty($medical_history) && empty($owner_id)
    ) {
        $sql = "SELECT * FROM animal";
        $result = mysqli_query($conn, $sql);
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

            <?php mysqli_free_result($result); ?>
        </section>
    </section>


    <section class="section" style="margin-top: -50px">
        <div class="px-6 pb-3">
            <div class="tabs is-toggle is-fullwidth">
                <ul>
                    <li class="is-active" data-tab="filter">
                        <a>Filter Criteria</a>
                    </li>
                    <li data-tab="update">
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
                        <input class="input" type="text" name="animal_id">
                    </div>
                    <div class="field column">
                        <label class="label" for="animal_name">Animal Name:</label>
                        <input class="input" type="text" name="animal_name">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_type">Animal Type:</label>
                        <input class="input" type="text" name="animal_type">
                    </div>
                    <div class="field column">
                        <label class="label" for="breed">Breed:</label>
                        <input class="input" type="text" name="breed">
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
                    <input class="input" type="text" name="owner_id">
                </div>

                <div class="field mt-5">
                    <button type="submit" class="button is-primary">Find Records</button>
                </div>
            </form>
        </section>

        <section id="update-section" class="section box is-rounded is-shadowless">
            <h1 class="title">Update Information</h1>
            <form method="get" action="">
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_id">Animal ID:</label>
                        <input class="input" type="text" name="animal_id">
                    </div>
                    <div class="field column">
                        <label class="label" for="animal_name">Animal Name:</label>
                        <input class="input" type="text" name="animal_name">
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_type">Animal Type:</label>
                        <input class="input" type="text" name="animal_type">
                    </div>
                    <div class="field column">
                        <label class="label" for="breed">Breed:</label>
                        <input class="input" type="text" name="breed">
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
                    <input class="input" type="text" name="owner_id">
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
