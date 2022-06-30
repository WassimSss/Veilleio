<form method="post">


    <div class="form-group">
        <label for="email" class="col-form-label" id="label_email">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>

    <div class="form-group">
        <label for="password" class="col-form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="d-flex justify-content-center">
        <input type="submit" name="submit_signin" class="btn btn-primary mt-3" value="Connexion">
    </div>

</form>

<?php if (isset($_GET['error'])) { ?>
    <p><?= $_GET['error'] ?></p>
<?php } ?>