
    <div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container;">

        <nav class="uk-navbar-container">
            <div class="uk-container uk-container-small">
                <div uk-navbar>
                    <div class="uk-navbar-left">
                        <!-- Logo -->
                        <a class="uk-navbar-item uk-logo" href="<?= route("home") ?>">
                            Iskulletin
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
                                <li>
                                    <a href="<?= route("home") ?>">
                                        <span uk-icon="home"></span>
                                        Home
                                    </a>
                                </li>
                                <?php if (!is_authorized()) :?>
                                    <li>
                                        <a href="#modal-container-login" uk-toggle>
                                            <span uk-icon="sign-in"></span>
                                            Login
                                        </a>
                                        <div id="modal-container-login" class="" uk-modal>
                                            <div class="uk-modal-dialog">
                                                <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                                <div class="uk-modal-header">
                                                    <h2 class="uk-modal-title">
                                                        Login
                                                    </h2>
                                                </div>
                                                <div class="uk-modal-body">
                                                    <?php require_once asset("components/form/login.php") ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endif ?>
                            <?php endif ?>
                        </ul>
                    </div>

                    <!-- Apila if mulogin ug balik, i logout tung nakalogin na -->
                    <?php if (is_authorized()) :?>
                        <div class="uk-navbar-right">
                            <ul class="uk-navbar-nav">
                                <li <?= is_view_active(["post/index", "close_dates_index", "services_index"]) ? "class='uk-active'" : "" ?>>
                                    <a href="#">
                                        <span uk-icon="nut"></span>
                                        Manage
                                    </a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li <?= is_view_active("post/index") ? "class='uk-active'" : "" ?>><a href="<?= route("post/index") ?>">Posts</a></li>
                                            <li <?= is_view_active("post/pinned/index") ? "class='uk-active'" : "" ?>><a href="<?= route("post/pinned/index") ?>">Pinned Posts</a></li>
                                            <li <?= is_view_active("category/index") ? "class='uk-active'" : "" ?>><a href="<?= route("category/index") ?>">Categories</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="logout.php">
                                        <span uk-icon="sign-in"></span>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </nav>

    </div>