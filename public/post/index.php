<?php
session_start();

require_once "../../bootstrap.php";

?>

<!DOCTYPE html>
<html lang="en">

<?php 

    $page_title = "Manage Posts";
    require_once asset("components/head.php");

?>

<body>  
    <?php
    
        require_once asset("components/nav.php");

    ?>

<div class="uk-container uk-container-small uk-margin">
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
                            include_once asset("components/form/post.php");
                        ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>

    <?php 


        $sql = "SELECT P.*, PP.*
                FROM posts P
                LEFT JOIN
                    pinned_posts PP
                ON
                    PP.post_id = P.id
                LIMIT 10
                OFFSET 0";

        $posts = execute($sql)->fetchAll();

    ?>
    <?php if ($posts) : ?>
        <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid></div>
            <?php foreach ($posts as $post) : ?>
                <div>
                    <div class="uk-card uk-card-hover uk-width-1-2@m">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <div class="uk-width-expand">
                                    <h3 class="uk-card-title uk-margin-remove-bottom">
                                        <?= $post->title ?>
                                    </h3>
                                    <p class="uk-text-meta uk-margin-remove-top">
                                        <?= date("F d, Y", strtotime($post->date_posted)) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p><?= $post->caption ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <h1 class="uk-text-center">No posts yet</h1>
    <?php endif ?>
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
