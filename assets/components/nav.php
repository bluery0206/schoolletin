
    <div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container;">

        <nav class="uk-navbar-container">
            <div class="uk-container">
                <div uk-navbar>
                    <div class="uk-navbar-left">
                        <!-- Logo -->
                        <a class="uk-navbar-item uk-logo" href="<?= route("home") ?>">
                            Schooletin
                        </a>
                    </div>

                    <!-- Left Navigation -->
                    <div class="uk-navbar-<?= is_authorized() ? 'center' : 'right' ?>">

                        <!-- Navigation -->
                        <ul class="uk-navbar-nav">
                            <?php if (is_view_active("index")) :?>

                                <li><a href="#calendar" uk-scroll>Calendar</a></li>
                                <li><a href="#status" uk-scroll>Appointment Status</a></li>
                                <li><a href="#location" uk-scroll>Location</a></li>

                            <?php else : ?>
                                <li><a href="index.php">Home</a></li>
                            <?php endif ?>
                        </ul>
                    </div>

                    <!-- Apila if mulogin ug balik, i logout tung nakalogin na -->
                    <?php if (is_authorized()) :?>
                        <div class="uk-navbar-right">
                            <ul class="uk-navbar-nav">
                                <li <?= is_view_active(["appointment_index", "close_dates_index", "services_index"]) ? "class='uk-active'" : "" ?>>
                                    <a href="#">Manage</a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li <?= is_view_active("appointment_index") ? "class='uk-active'" : "" ?>><a href="appointment_index.php">Appointments</a></li>
                                            <li <?= is_view_active("close_dates_index") ? "class='uk-active'" : "" ?>><a href="close_dates_index.php">Close Dates</a></li>
                                            <li <?= is_view_active("services_index") ? "class='uk-active'" : "" ?>><a href="services_index.php">Services</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="logout.php">Logout <?= $_SESSION['user']->username ?></a></li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </nav>

    </div>