<html>

<head>
    <title>Haven Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="px-6 navbar-item" href="index.php" class="is-size-5">
                <img class="logo image" src="images/logo_icon_purple.png" alt="Haven Logo" height="auto" href="index.php">
                Haven Management</a>
            </a>
        </div>

        <div class="navbar-menu">
            <div class="navbar-end">
                <a href="index.php" class="px-5 navbar-item is-primary-text">Home</a>
                <a href="search_records.php" class="px-5 navbar-item">Search Animals</a>
                <a href="pet_registration.php" class="px-5 navbar-item">Pet Registration</a>
                <a href="update_records.php" class="px-5 navbar-item">Update Records</a>
            </div>
        </div>
    </nav>

    <section class="section has-text-centered">
        <img src="images/happy_cat_purple.png" alt="Dog" width="250" height="250">
        <h1 class="mt-5 is-size-3">Welcome to Haven Veterinary</h1>
        <h1 class="is-size-4" style="margin-top: 5px">Clinic & Kennel Pet Management!</h1>
    </section>

    <section class="section">
        <div class="columns is-6">
            <div class="column has-text-centered">
                <button class="button is-primary is-fullwidth"
                    onclick="window.location.href='search_records.php'">Search Records</button>
            </div>

            <div class="column has-text-centered">
                <button class="button is-primary is-fullwidth" onclick="window.location.href='pet_registration.php'">
                    Pet Registration
                </button>
            </div>

            <div class="column has-text-centered" onclick="window.location.href='update_records.php' ">
                <button class="button is-primary is-fullwidth">
                    Update Records
                </button>
            </div>
        </div>
    </section>
</body>

</html>