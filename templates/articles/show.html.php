<article class="card bg-light mb-3 mt-4 w-75" style="min-width: 300px;">
    <div class="card-header">
        <h4 class="card-title"><?= $article['title'] ?></h4>
        <p class="p-0">Ecrit le <?= $article['created_at'] ?> par <?= $username ?></p>
    </div>
    <div class="cart-body">

        <?php if (isset($article['introduction'])) { ?>
            <p class="card-text m-3"><?= $article['introduction'] ?></p>
        <?php } ?>

        <p class="card-text m-3"><?= $article['content'] ?></p>
        <div class="m-3 d-flex justify-content-center align-items-center">
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

<?php if (count($commentaires) === 0) : ?>
    <div class="d-flex justify-content-center align-items-center w-75" style="min-width: 300px;">
        <h2 class="text-center">Il n'y a pas encore de commentaires pour cet article ...</h2>
    </div>
<?php else : ?>

    <h2 class="m-4"><?= count($commentaires) ?> commentaires : </h2>
    <?php foreach ($commentaires as $commentaire) : ?>

        <div class="card bg-light mb-3 w-75" style="min-width: 300px">
            <div class="card-header">
                <h3>Commentaire de <?= $commentaire['author'] ?></h3>
                <p class="m-0">Le <?= $commentaire['created_at'] ?></p>
            </div>
            <div class="card-body">
                <p class="card-text m-3"><?= $commentaire['content'] ?></p>
            </div>
            <div class="m-3 d-flex justify-content-center align-items-center">
                <?php
                if (isset($_SESSION['role_admin']) || isset($_SESSION['id'])) {
                    if ($_SESSION['role_admin'] == true || $_SESSION['id'] == $commentaire['id_user']) { ?>
                        <a class="btn btn-danger" href="index.php?controller=comment&task=delete&id=<?= $commentaire['id'] ?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                <?php }
                }
                ?>
            </div>
            </div>


        <?php endforeach ?>
    <?php endif ?>

    <?php if (isset($_SESSION['id'])) { ?>
        <form class="form-group" action="index.php?controller=comment&task=insert&id=" method="POST">
            <h3>Vous voulez réagir ?</h3>
            <div>
                <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="Votre commentaire ..."></textarea>
                <input type="hidden" name="article_id" value="<?= $article_id ?>">
            </div>
            <div class="m-3 d-flex justify-content-center align-items-center">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    <?php } else { ?>
        <h3>Veuillez vous connecter pour ecrire un commentaire</h3>
        <div class="d-flex justify-content-around align-items-center">
            <a href="../index.php?controller=account&task=signup" class="btn btn-primary m-2">S'inscrire</a>
            <a href="../index.php?controller=account&task=login" class="m-2">Se connecter</a>
        </div>
    <?php } ?>