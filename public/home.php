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
        <div class="uk-container uk-container-xsmall uk-section-xsmall" uk-height-viewport="min: 100; offset-top: true">
            
            <div class="uk-flex uk-flex-between uk-flex-middle">
                <h2>Posts</h2>
                <?php if (is_authorized()) : ?>
                    <a class="uk-button uk-button-primary" href="#modal-post-add" uk-toggle>
                        <div>Add New</div>
                    </a>
                    <div id="modal-post-add" class="uk-modal" uk-modal>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default" type="button" uk-close=""></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title">Add New Post</h2>
                            </div>
                            <div class="uk-modal-body">
                                <?php 
                                
                                    $action = route("controllers/post/add");
                                    include asset("components/form/post.php");
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>

            <!-- uk-accordion-default => have one max accordion open at the same time -->
            <ul class="uk-accordion-default" uk-accordion="
                collapsible: true;
                multiple: true">
                <!-- <li class="uk-open"> -->
                <?php 

                    $sql = "SELECT *
                            FROM posts
                            WHERE 
                                is_pinned = 1
                            LIMIT 10
                            OFFSET 0";

                    $pinned_posts = execute($sql)->fetchAll();

                ?>
                <li <?= $pinned_posts ? "class=\"uk-open\"" : "" ; ?>>
                    <a class="uk-accordion-title uk-text-muted" href>
                        <span uk-icon="warning"></span>
                        Pinned Posts
                        <span uk-accordion-icon></span>
                    </a>
                    <div class="uk-accordion-content">
                        <?php if ($pinned_posts) : ?>
                                <?php foreach ($pinned_posts as $post) : ?>
                                    <div class="uk-card uk-card-default uk-margin">
                                        <div class="uk-card-body">
                                            <div class="uk-flex uk-flex-between">
                                                <h3 class="uk-card-title uk-margin-remove-bottom">
                                                    <?= $post->title ?>
                                                </h3>
                                                <div class="uk-flex uk-flex-middle">
                                                    <?php if (is_authorized()) : ?>
                                                        <a class="uk-button uk-padding-remove uk-margin-left" 
                                                            <?php 

                                                                $pin_action = "add";
                                                                $text = "Pin";

                                                                if ($post->is_pinned) {
                                                                    $pin_action = "remove";
                                                                    $text = "Unpin";
                                                                }

                                                            ?>
                                                            href="<?= route("controllers/post/pinned/$pin_action") ?>?next=<?= current_url() ?>&id=<?= $post->id ?>">
                                                            <?= $text ?>
                                                        </a>
                                                        <a class="uk-button uk-padding-remove uk-margin-left" 
                                                            href="#modal-pinned-post-edit-<?= $post->id?>" uk-toggle>
                                                            Edit
                                                            <!-- <span class="material-symbols-outlined uk-margin-remove">edit</span> -->
                                                        </a>
                                                        <div id="modal-pinned-post-edit-<?= $post->id?>" class="uk-modal" uk-modal>
                                                            <div class="uk-modal-dialog">
                                                                <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                                                <div class="uk-modal-header">
                                                                    <h2 class="uk-modal-title">Add New Post</h2>
                                                                </div>
                                                                <div class="uk-modal-body">
                                                                    <?php 
                                                                    
                                                                        $action = route("controllers/post/edit");
                                                                        include asset("components/form/post.php");
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a class="uk-button uk-padding-remove uk-margin-left uk-text-danger" 
                                                            href="<?= route("controllers/post/delete") ?>?next=<?= current_url() ?>&id=<?= $post->id ?>">
                                                            Delete
                                                            <!-- <span class="material-symbols-outlined uk-margin-remove">delete</span> -->
                                                        </a>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <p class="uk-text-meta uk-margin-remove-top">
                                                <?= date("F d, Y", strtotime($post->date_posted)) ?>
                                            </p>
                                            <p><?= $post->caption ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                        <?php else: ?>
                            <h1 class="uk-text-center">No pinned posts yet</h1>
                        <?php endif ?>
                    </div>
                </li>

                <?php 

                    $sql = "SELECT *
                            FROM posts
                            LIMIT 20
                            OFFSET 0";

                    $posts = execute($sql)->fetchAll();

                ?>
                <li <?= isset($posts) ? "class=\"uk-open\"" : "" ; ?>>
                    <a class="uk-accordion-title uk-text-muted" href>
                        <span uk-icon="table"></span>
                        Posts
                        <span uk-accordion-icon></span>
                    </a>
                    <div class="uk-accordion-content">
                        <?php if ($posts) : ?>
                                <?php foreach ($posts as $post) : ?>
                                    <div class="uk-card uk-card-default uk-margin">
                                        <div class="uk-card-body">
                                            <div class="uk-flex uk-flex-between">
                                                <h3 class="uk-card-title uk-margin-remove-bottom">
                                                    <?= $post->title ?>
                                                </h3>
                                                <div class="uk-flex uk-flex-middle">
                                                    <?php if (is_authorized()) : ?>
                                                        <a class="uk-button uk-padding-remove uk-margin-left" 
                                                            <?php 

                                                                $pin_action = "add";
                                                                $text = "Pin";

                                                                if ($post->is_pinned) {
                                                                    $pin_action = "remove";
                                                                    $text = "Unpin";
                                                                }

                                                            ?>
                                                            href="<?= route("controllers/post/pinned/$pin_action") ?>?next=<?= current_url() ?>&id=<?= $post->id ?>">
                                                            <?= $text ?>
                                                        </a>
                                                        <a class="uk-button uk-padding-remove uk-margin-left" 
                                                            href="#modal-post-edit-<?= $post->id?>" uk-toggle>
                                                            Edit
                                                            <!-- <span class="material-symbols-outlined uk-margin-remove">edit</span> -->
                                                        </a>
                                                        <div id="modal-post-edit-<?= $post->id?>" class="uk-modal" uk-modal>
                                                            <div class="uk-modal-dialog">
                                                                <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                                                <div class="uk-modal-header">
                                                                    <h2 class="uk-modal-title">Add New Post</h2>
                                                                </div>
                                                                <div class="uk-modal-body">
                                                                    <?php 
                                                                    
                                                                        $action = route("controllers/post/edit");
                                                                        include asset("components/form/post.php");
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a class="uk-button uk-padding-remove uk-margin-left uk-text-danger" 
                                                            href="<?= route("controllers/post/delete") ?>?next=<?= current_url() ?>&id=<?= $post->id ?>">
                                                            Delete
                                                            <!-- <span class="material-symbols-outlined uk-margin-remove">delete</span> -->
                                                        </a>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <p class="uk-text-meta uk-margin-remove-top">
                                                <?= date("F d, Y", strtotime($post->date_posted)) ?>
                                            </p>
                                            <p><?= $post->caption ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                        <?php else: ?>
                            <h1 class="uk-text-center">No posts yet</h1>
                        <?php endif ?>
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