<form method="POST" class="uk-form-horizontal" action="<?= $action ?>">
    <input type="hidden" name="category_id" value="<?= $category->id ?? "" ?>">
    <?php if (isset($_GET["error"])): ?>
        <div class="uk-alert-danger" uk-alert>
            <a href class="uk-alert-close" uk-close></a>
            <?= $_GET["error"] ?>
        </div>
    <?php endif ?>

    <div class="uk-margin">
        <label class="uk-form-label" for="category_name">category_name</label>
        <div class="uk-form-controls">
            <input class="uk-input k-form-controls-text" type="text" 
                name="category_name" placeholder="jdelacruz" id="category_name" 
                value="<?= $category->name ?? "" ?>" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-caption-<?= $category->id ?? "" ?>">caption</label>
        <div class="uk-form-controls">
            <textarea class="uk-input" id="form-stacked-caption-<?= $category->id ?? "" ?>" name="category_description"
                id="caption" required><?= $category->description ?? "" ?></textarea>
        </div>
    </div>

    <input class="uk-button uk-button-secondary uk-width-1" type="submit" name="post" value="Post">
</form>