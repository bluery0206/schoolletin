<?php 

session_start();
include_once "../bootstrap.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php 

        $page_title = "Home";
        require_once asset("components/head.php");

    ?>
</head>

<body>
    <?php require_once asset("components/nav.php") ?>
<!-- 
    <nav aria-label="Pagination">
        <ul class="uk-pagination" uk-margin>
            <li><a href="#"><span uk-pagination-previous></span></a></li>
            <li><a href="#">1</a></li>
            <li class="uk-disabled"><span>…</span></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li class="uk-active"><span aria-current="page">7</span></li>
            <li><a href="#">8</a></li>
            <li><a href="#">9</a></li>
            <li><a href="#">10</a></li>
            <li class="uk-disabled"><span>…</span></li>
            <li><a href="#">20</a></li>
            <li><a href="#"><span uk-pagination-next></span></a></li>
        </ul>
    </nav> -->

    <div>
        <div class="uk-container uk-container-small uk-section-xsmall" uk-height-viewport="min: 100; offset-top: true">
            <!-- uk-accordion-default => have one max accordion open at the same time -->
            <ul class="uk-accordion-default" uk-accordion="
                collapsible: true;
                multiple: true">
                <li class="uk-open">
                <!-- <li> -->
                    <a class="uk-accordion-title uk-text-muted" href>
                        <span uk-icon="warning"></span>
                        Pinned Posts
                        <span uk-accordion-icon></span>
                    </a>
                    <div class="uk-accordion-content">
                        <?php for ($i = 0; $i < 4; $i++) :?>
                            <article class="uk-article">
                                <!-- The title -->
                                <h1 class="uk-article-title">
                                    <a class="uk-link-heading" href="">
                                        Jhonlie's Solid Wire Opening!
                                    </a>
                                </h1>
                                <!-- The authors -->
                                <p class="uk-article-meta">
                                    Written by <a href="#">Super User</a> on 12 April 2012. Posted in <a href="#">Blog</a>
                                </p>
                                <!-- A bit more emphasize -->
                                <p class="uk-text-lead">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                    <div>
                                        <a class="uk-button uk-button-text" href="#">Read more</a>
                                    </div>
                                    <div>
                                        <a class="uk-button uk-button-text" href="#">5 Comments</a>
                                    </div>
                                </div>
                            </article>
                        <?php endfor ?>
                    </div>
                </li>
                <li>
                    <a class="uk-accordion-title uk-text-muted" href>
                        <span uk-icon="table"></span>
                        Posts
                        <span uk-accordion-icon></span>
                    </a>
                    <div class="uk-accordion-content">
                        <?php for ($i = 0; $i < 4; $i++) :?>
                            <article class="uk-article">
                                <!-- The title -->
                                <h1 class="uk-article-title">
                                    <a class="uk-link-heading" href="">
                                        Jhonlie's Solid Wire Opening!
                                    </a>
                                </h1>
                                <!-- The authors -->
                                <p class="uk-article-meta">
                                    Written by <a href="#">Super User</a> on 12 April 2012. Posted in <a href="#">Blog</a>
                                </p>
                                <!-- A bit more emphasize -->
                                <p class="uk-text-lead">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                    <div>
                                        <a class="uk-button uk-button-text" href="#">Read more</a>
                                    </div>
                                    <div>
                                        <a class="uk-button uk-button-text" href="#">5 Comments</a>
                                    </div>
                                </div>
                            </article>
                        <?php endfor ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <?php 
    
        include_once asset("components/footer.php");
    
    ?>

    <div class="uk-position-fixed uk-position-z-index-highest
        uk-position-bottom-right">
        <div class="uk-padding">
            <a href="" uk-totop></a>
        </div>
    </div>

    <?php if (isset($_GET['error'])) : ?>
        <script data-error="<?= $_GET['error'] ?> ">
            UIkit.notification({
                message: document.currentScript.dataset.error,
                status: 'danger',
                pos: 'bottom-center',
                timeout: 5000
            });
        </script>
    <?php endif ?>
        
</body>

</html>