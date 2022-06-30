<form method="post">
    <div class="form-group">
        <label for="username" id="label_username" class="col-form-label">Pseudo</label>
        <input type="text" name="username" class="form-control" id="username">
    </div>

    <div class="form-group">
        <label for="email" class="col-form-label" id="label_email">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>

    <div class="form-group">
        <label for="password" class="col-form-label" id="label_password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="confirm_password" class="col-form-label" id="label_confirm_password">Confirmation mot de passe</label>
        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
    </div>

    <div class="d-flex justify-content-center">
        <input type="submit" name="submit_signup" class="btn btn-primary mt-3" value="Inscription">
    </div>

    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-dismissible alert-danger mt-4 p-3 d-flex justify-content-center align-items-center">
            <p class="m-0"><?= $_GET['error'] ?></p>
        </div>
    <?php } ?>
</form>