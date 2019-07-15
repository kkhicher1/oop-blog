<?php
if (!defined('MENU-FORM')) {
    exit("Your are Not Authrise to check this Part");
}

?>


<div class="col-6 offset-3">
    <form method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" class="form-control" type="text" name="name" value="<?= $result['name'] ?>">
        </div>
        <div class="form-group">
            <label for="redirect_slug">Redirect Slug</label>
            <input id="redirect_slug" class="form-control" type="text" name="redirect_slug" value="<?= $result['redirect_slug'] ?>">
        </div>
        <button class="btn btn-success btn-block" type="submit">Update Menu</button>
    </form>
</div>