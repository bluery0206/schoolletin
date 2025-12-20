<footer class="uk-padding uk-background-muted uk-section-muted">
    <?php if (!is_authorized()) : ?>
        <div class="uk-container uk-flex uk-flex-center uk-flex-wrap">
            <div class="uk-margin">
                <?php 

                    include asset("components/form/login.php");
                
                ?>
            </div>
        </div>
    <?php endif ?>
    <div class="uk-margin">
        <div class="uk-container uk-text-center">
            <p>&copy; <?= date('Y') ?> Schooletin. All rights reserved.</p>
        </div>
    </div>
</footer>