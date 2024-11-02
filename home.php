<html>

<head>
    <title>Haven Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>

<body>
    <section class="section has-text-centered">
        <h1 class="title">Welcome to Haven Veterinary Clinic <br> & Kennel Management System!</h1>
        <img src="images/happy_cat.png" alt="Dog" width="250" height="250">
    </section>

    <section class="section">
        <div class="columns is-8 ">
            <div class="column has-text-centered">
                <button class="button is-primary is-fullwidth" onclick="window.location.href='search_animals.php'">Search Records</button>
            </div>

            <div class="column has-text-centered">
                <button class="button is-primary is-fullwidth" onclick="window.location.href='new_animal.php'">New Record</button>
            </div>

            <div class="column has-text-centered" onclick="window.location.href='update_animal.php' ">
                <button class="button is-primary is-fullwidth">Update Record</button>
            </div>
        </div>
    </section>
</body>

</html>