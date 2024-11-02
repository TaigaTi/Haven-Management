<html>

<head>
    <title>New Animal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Update Animal Record</h1>
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
                    <div class="control">
                        <input class="input" type="text" name="owner_id" required>
                    </div>
                </div>

                <section class="py-5">
                    <button type="submit" class="button is-primary">Add Animal</button>
                </section>
            </form>
        </div>
    </section>
</body>

</html>