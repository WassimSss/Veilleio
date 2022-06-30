<?php if (!isset($_SESSION)) {
    session_start();
} ?>

<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['id']) { ?>
        <a href="index.php?controller=article&task=create" class="btn btn-primary mb-4">Ecrire un article</a>
<?php }
}
?>

<h1>Nos veilles</h1>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-dismissible alert-danger mt-4 p-3 d-flex justify-content-center align-items-center">
        <p class="m-0"><?= $_GET['error'] ?></p>
    </div>
<?php } ?>

<?php foreach ($articles as $article) : ?>
    <?php
    $userModel = new \Models\User();
    $user = $userModel->find($article['id_user'])['username'];
    ?>
    <article class="card bg-light mb-3 mt-4 w-75" style="min-width: 300px;">
        <div class="card-header">
            <h4 class="card-title"><?= $article['title'] ?></h4>
            <p class="p-0">Ecrit le <?= $article['created_at'] ?> par <?= $user ?></p>
        </div>
        <div class="cart-body">

            <p class="card-text m-3"><?= $article['introduction'] ?></p>
            <div class="m-3">
                <a class="btn btn-warning" href="index.php?controller=article&task=show&id=<?= $article['id'] ?>">Lire la suite</a>
                <?php
                if (isset($_SESSION['role_admin']) || isset($_SESSION['id'])) {
                    if ($_SESSION['role_admin'] == true || $_SESSION['id'] == $article['id_user']) { ?>
                        <a class="btn btn-danger" href="index.php?controller=article&task=delete&id=<?= $article['id'] ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
                <?php }
                }
                ?>
            </div>
        </div>

    </article>
<?php endforeach ?>