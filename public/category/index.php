<?php 

session_start();
include_once "../../bootstrap.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php 

        $page_title = "Manage Categories";
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
            <?php 

                $sql = "SELECT * FROM categories";

                $categories = execute($sql)->fetchAll();

            ?>
            <div>
                <div class="uk-flex uk-flex-between uk-flex-middle">
                    <h2>Categories</h2>
                    <?php if (is_authorized()) : ?>
                        <a class="uk-button uk-button-primary" href="#modal-category-add" uk-toggle>
                            <div>Add New</div>
                        </a>
                        <div id="modal-category-add" class="uk-modal" uk-modal>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                <div class="uk-modal-header">
                                    <h2 class="uk-modal-title">Add New Category</h2>
                                </div>
                                <div class="uk-modal-body">
                                    <?php 
                                    
                                        $action = route("controllers/category/add");
                                        include asset("components/form/category.php");
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <?php if ($categories) : ?>
                    <div class="uk-overflow-auto">
                        <table class="uk-table uk-table-divider uk-table-striped uk-table-hover uk-table-small">
                            <thead>
                                <tr>
                                    <th class="uk-table-shrink">Name</th>
                                    <th>Description</th>
                                    <th class="uk-table-shrink">Updated</th>
                                    <th class="uk-table-shrink">Created</th>
                                    <th class="uk-table-shrink uk-text-right uk-text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category) : ?>
                                    <tr>
                                        <td class="uk-text-nowrap"><?= $category->name ?></td>
                                        <td class="uk-flex" ?><?= $category->description ?></td>
                                        <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($category->date_updated)) ?></td>
                                        <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($category->date_created)) ?></td>
                                        <td class="uk-button-group uk-flex uk-flex-right">
                                            <a class="uk-button uk-margin-remove uk-padding-remove uk-button-small uk-flex uk-flex-middle" href="#modal-container-<?= $category->id ?>" uk-toggle>
                                                <span class="uk-text-small"uk-icon="file-edit"></span>
                                            </a>
                                            <div id="modal-container-<?= $category->id ?>" class="uk-modal" uk-modal>
                                                <div class="uk-modal-dialog">
                                                    <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                                    <div class="uk-modal-header">
                                                        <h2 class="uk-modal-title">Edit catergory</h2>
                                                    </div>
                                                    <div class="uk-modal-body">
                                                        <?php 
                                                            $action = route("controllers/category/edit");
                                                            $next = "category/index";
                                                            include asset("components/form/category.php"); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="uk-button uk-margin-left uk-padding-remove uk-text-danger uk-button-small uk-flex uk-flex-middle" 
                                                href="<?= route("controllers/category/delete") ?>?id=<?= $category->id ?>">
                                                <span uk-icon="trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <h1 class="uk-text-center">No Categories yet</h1>
                <?php endif ?>
            </div>
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