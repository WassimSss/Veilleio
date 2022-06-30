<div>
    <form action="" method="POST" class="container">
        <div class="row align-items-start d-flex justify-content-center align-items-center">
            <div class="col">
                <label for="new_username" class="col-form-label">Nouveau pseudo</label>
                <input type="text" class="form-control" name="new_username" id="new_username" value=<?= $_SESSION['username'] ?>>
            </div>
            <div class="col align-self-end">
                <input type="submit" name="edit_username" class="btn btn-primary" value="Modifier votre pseudo">
            </div>
        </div>
    </form>

    <form action="" method="POST" class="container mt-4">
        <div class="row align-items-start d-flex justify-content-center align-items-center">
            <div class="col">
                <label for="old_email" class="col-form-label">Ancienne email</label>
                <input type="email" name="old_email" class="form-control" id="old_email">

                <label for="new_email" class="col-form-label">Nouvelle email</label>
                <input type="email" name="new_email" class="form-control" id="new_email">
            </div>
            <div class="col align-self-end">
                <input type="submit" name="edit_email" class="btn btn-primary" value="Modifier votre email">
            </div>
        </div>
    </form>

    <form action="" method="POST" class="container mt-4">
        <div class="row align-items-start d-flex justify-content-center align-items-center">
            <div class="col">
                <label for="old_password" class="col-form-label">Ancien mot de passe</label>
                <input type="password" name="old_password" class="form-control" id="old_password">

                <label for="new_password" class="col-form-label">Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control" id="new_password">
            </div>
            <div class="col align-self-end">
                <input type="submit" name="edit_password" class="btn btn-primary" value="Modifier votre mot de passe">
            </div>
        </div>
    </form>


</div>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-dismissible alert-danger mt-4 p-3 d-flex justify-content-center align-items-center">
        <p class="m-0"><?= $_GET['error'] ?></p>
    </div>
<?php } ?>