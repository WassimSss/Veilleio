<?php if (!isset($_SESSION)) {
  session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/style.css">
  <title>Mon superbe blog - <?= $pageTitle ?></title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Veille.io</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              
              <a class="nav-link
              <?php if(isset($_GET['task'])){if($_GET['task'] == ''){echo 'active'; }} ?>
              " href="../index.php">Veilles
                <span class="visually-hidden">(current)</span>
              </a>
            </li>
            <?php
            if (isset($_SESSION['id'])) {
            ?>

              <li class="nav-item">
                <a class="nav-link
                <?php if(isset($_GET['task'])){if($_GET['task'] == 'profil'){ echo 'active'; }} ?>
                " href="../index.php?controller=account&task=profil">Profil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../index.php?controller=account&task=logout">Déconexion</a>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link
                <?php if(isset($_GET['task'])){if($_GET['task'] == 'signup'){echo 'active'; }} ?>
                " href="../index.php?controller=account&task=signup">S'inscrire</a>
              </li>
              <li class="nav-item">
                <a class="nav-link
                <?php if(isset($_GET['task'])){if($_GET['task'] == 'login'){echo 'active'; }} ?>
                " href="../index.php?controller=account&task=login">Se connecter</a>
              </li>

            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>


  <main class="mt-5 d-flex p-2 justify-content-center align-items-center flex-column" >
    <?= $pageContent ?>
  </main>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>