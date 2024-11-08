<!DOCTYPE html>
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
                <a href="new_animal.php" class="px-5 navbar-item is-primary-text">Pet Registration</a>
                <a href="update_animal.php" class="px-5 navbar-item">Update Records</a>
            </div>
        </div>
    </nav>

    <section class="section">
        <div class="container">
            <h1 class="title">Pet Registration</h1>
            <form method="post" action="">
                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_id">Animal ID:</label>
                        <input class="input" type="text" name="animal_id" required>
                    </div>

                    <div class="field column">
                        <label class="label" for="animal_name">Animal Name:</label>
                        <div class="control">
                            <input class="input" type="text" name="animal_name" required>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="field column">
                        <label class="label" for="animal_type">Animal Type:</label>
                        <div class="control">
                            <input class="input" type="text" name="animal_type" required>
                        </div>
                    </div>

                    <div class="field column">
                        <label class="label" for="breed">Breed:</label>
                        <div class="control">
                            <input class="input" type="text" name="breed" required>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="field column">
                        <label class="label" for="date_of_birth">Date of Birth:</label>
                        <div class="control">
                            <input class="input" type="date" name="date_of_birth" required>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="allergies">Allergies:</label>
                    <div class="control">
                        <input class="input" type="text" name="allergies">
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="medical_history">Medical History:</label>
                    <div class="control">
                        <input class="input" type="text" name="medical_history">
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="owner_id">Owner ID:</label>
                    <div class="select is-fullwidth">
                        <select name="owner_id">
                            <option value="">Select Owner</option>
                            <?php
                            DEFINE('DB_USER', 'root');
                            DEFINE('DB_PASSWORD', '');
                            DEFINE('DB_HOST', 'localhost');
                            DEFINE('DB_NAME', '400013038');

                            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT owner_id FROM owner";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['owner_id'] . "'>" . $row['owner_id'] . "</option>";
                                }
                            }
                            ?>
                            <option value="new">New Owner</option>
                        </select>
                    </div>
                </div>

                <section id="new_owner" class="py-5" style="display: none;">
                    <div class="title mt-5">New Owner</div>
                    <div class="columns">
                        <div class="field column">
                            <div class="label" for="new_owner_id">Owner ID:</div>
                            <div class="control">
                                <input class="input" type="text" name="new_owner_id">
                            </div>
                        </div>

                        <div class="field column">
                            <div class="label" for="owner_fname">First Name:</div>
                            <div class="control">
                                <input class="input" type="text" name="owner_fname">
                            </div>
                        </div>

                        <div class="field column">
                            <div class="label" for="owner_lname">Last Name:</div>
                            <div class="control">
                                <input class="input" type="text" name="owner_lname">
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="label" for="phone">Phone Number:</div>
                        <div class="control">
                            <input class="input" type="text" name="phone">
                        </div>
                    </div>

                    <div class="field">
                        <div class="label" for="email">Email Address:</div>
                        <div class="control">
                            <input class="input" type="email" name="email">
                        </div>
                    </div>
                </section>

                <section class="py-5">
                    <button type="submit" class="button is-primary">Add Animal</button>
                </section>
            </form>
        </div>

        <script>
            const select = document.querySelector('select[name="owner_id"]');
            const newOwnerForm = document.querySelector('#new_owner');
            const submit =document.querySelector('button[type="submit"]');

            select.addEventListener('change', (event) => {
                if (event.target.value === 'new') {
                    newOwnerForm.style.display = 'block';
                    submit.innerHTML = 'Add Owner & Animal';
                } else {
                    newOwnerForm.style.display = 'none';
                }
            });
        </script>
    </section>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $owner_id = $_POST['owner_id'];

        if ($owner_id == 'new') {
            $new_owner_id = $_POST['new_owner_id'];
            $owner_fname = $_POST['owner_fname'];
            $owner_lname = $_POST['owner_lname'];
            $phone_number = $_POST['phone'];
            $email_addr = $_POST['email'];

            $sql_owner = "INSERT INTO owner (owner_id, owner_fname, owner_lname, phone_number, email_addr) 
                      VALUES ('$new_owner_id', '$owner_fname', '$owner_lname', '$phone_number', '$email_addr')";

            if ($conn->query($sql_owner) === TRUE) {
                echo "<script>alert('New owner added successfully.');</script>";
                $owner_id = $new_owner_id;
            } else {
                echo "<script>alert('Error adding new owner: " . $conn->error . "');</script>";
                exit;
            }
        } elseif (empty($owner_id)) {
            echo "<script>alert('Please select an owner.');</script>";
            exit;
        }

        $animal_id = $_POST['animal_id'];
        $animal_name = $_POST['animal_name'];
        $animal_type = $_POST['animal_type'];
        $breed = $_POST['breed'];
        $date_of_birth = $_POST['date_of_birth'];
        $allergies = $_POST['allergies'];
        $medical_history = $_POST['medical_history'];

        $sql_animal = "INSERT INTO animal (animal_id, animal_name, animal_type, breed, date_of_birth, allergies, medical_history, owner_id) 
                   VALUES ('$animal_id', '$animal_name', '$animal_type', '$breed', '$date_of_birth', '$allergies', '$medical_history', '$owner_id')";

        if ($conn->query($sql_animal) === TRUE) {
            echo "<script>alert('Pet Registration added successfully.');</script>";
        } else {
            echo "<script>alert('Error adding animal: " . $conn->error . "');</script>";
        }
    }

    $conn->close();

    ?>
</body>

</html>
