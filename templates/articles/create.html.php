<form action="" method="post">

    <div class="form-group">
        <label for="title" class="col-form-label">Titre</label>
        <input type="text" class="form-control" name="title" id="title">
    </div>

    <div class="form-group">
        <label for="introduction" class="col-form-label">Introduction</label>
        <textarea name="introduction" class="form-control" id="introduction" placeholder="Présenter rapidement votre article" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="content" class="col-form-label">Contenu</label>
        <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
    </div>

    <div class="d-flex justify-content-center">
        <input type="submit" name="create_article" class="btn btn-primary mt-4" value="Créer">
    </div>
</form>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-dismissible alert-danger mt-4 p-3 d-flex justify-content-center align-items-center">
        <p class="m-0"><?= $_GET['error'] ?></p>
    </div>
<?php } ?>