<form method="POST" class="uk-form-horizontal" action="<?= $action ?>">
    <?php if (isset($_GET["error"])): ?>
        <div class="uk-alert-danger" uk-alert>
            <a href class="uk-alert-close" uk-close></a>
            <?= $_GET["error"] ?>
        </div>
    <?php endif ?>

    <input type="hidden" name="id" value="<?= $post->id ?? "" ?>">

    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-category">Categories</label>
        <div class="uk-form-controls">
            <select name="category_id" class="uk-select" id="form-stacked-category" required>
                <?php 
    
                    $sql = "SELECT * FROM categories";
                    $categories = execute($sql)->fetchAll();
    
                ?>
                <option value="">Please select...</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->id ?>" 
                        <?php if (isset($post)) : ?>
                            <?= $post->category_id == $category->id ? "selected" : "" ?>
                        <?php endif ?>
                    >
                        <?= $category->name ?> - <?= $category->description ?>
                    </option>
                <?php endforeach?>
            </select>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="title">title</label>
        <div class="uk-form-controls">
            <input class="uk-input k-form-controls-text" type="text" 
                name="title" placeholder="jdelacruz" id="title" 
                value="<?= $post->title ?? "" ?>" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-caption-<?= $post->id ?? "" ?>">caption</label>
        <div class="uk-form-controls">
            <textarea class="uk-input" id="form-stacked-caption-<?= $post->id ?? "" ?>" name="caption"
                id="caption" required><?= $post->caption ?? "" ?></textarea>
        </div>
    </div>

    <input class="uk-button uk-button-secondary uk-width-1" type="submit" name="post" value="Post">
</form>