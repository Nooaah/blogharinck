<?
session_start();
require_once '../includes/config.php';


if (empty($_SESSION['id']))
{
    header('location:index.php');
}


if (isset($_POST['submitPost']))
{
    if (!empty($_POST['titre']) && !empty($_POST['image']) && !empty($_POST['contenu']) && !empty($_POST['categorie']))
    {
        $titre = htmlspecialchars($_POST['titre']);
        $image = htmlspecialchars($_POST['image']);
        $contenu = nl2br($_POST['contenu']);
        $categorie = $_POST['categorie'];
        create_post($_SESSION['id'], $titre, $contenu, $image, $categorie);
        header('location:index.php');
    }
    else
    {
        $error = 'Veuillez compléter tous les champs';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BloggyHarinck</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCRvu70-oIYJSrEyR7HO64_TmcTr26UhsHB34a2GWZGERfKT2L">
    <style>
        *
        {
            scroll-behavior: smooth;
        }
        .modal-dialog.modal-notify .modal-body {
            padding: 0.5rem;
            color: #616161;
        }
        #linkProfil
        {
            color:white;
        }
        #linkProfil:hover
        {
            color:lightgrey;
        }
        
    </style>
</head>
<body>




<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark elegant-color">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCRvu70-oIYJSrEyR7HO64_TmcTr26UhsHB34a2GWZGERfKT2L" class="mr-2" width="30px;" alt=""> BloggyHarinck</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="http://github.com/Nooaah"><i class="fab fa-github mr-2"></i>Nooaah</a>
      </li>

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Catégories</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="index.php">Toutes les catégories</a>
            <?php
            $categories = get_all_categories();
            foreach($categories as $categorie):
            ?>
            <a class="dropdown-item" href="index.php?cat=<?= $categorie['id'] ?>"><?= $categorie['name'] ?></a>
            <?php endforeach; ?>
        </div>
      </li>

        <li class="nav-item">
            <a class="nav-link" href="ajouter.php"><i class="fas fa-plus-circle mr-2"></i>Ajouter</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="deconnexion.php">Déconnexion</a>
        </li>

    </ul>
    <!-- Links -->

    <form class="form-inline" action="" method="POST">
        <div class="md-form my-0">
        <!--
            <input class="form-control mr-sm-2" type="text" id="rechercher" name="rechercher" placeholder="Rechercher" aria-label="Rechercher">
        -->
        <?php
if (isset($_SESSION['id'])) {
    ?>
                <span class="white-text">Connecté en tant que <b><a id="linkProfil" href="profil.php?id=<?= $_SESSION['id'] ?>"><?=ucfirst($_SESSION['pseudo'])?></a></b></span>
            <?php
}
?>
        </div>
    </form>

  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->












<form action="" method="POST">

<div class="container">

    <h1 class="mt-5">Bonjour <?= $_SESSION['pseudo'] ?>, rédigez votre article</h1>

    <div class="col-md-12">


            <?php
            if (isset($error))
            {
                ?>
                <div class="alert alert-danger mt-5" role="alert">
                    <?= $error ?>
                </div>
                <?php
            }
            ?>


        <div class="row">
            <div class="col-md-9">
                <!-- Material input -->
                <div class="md-form">
                <input type="text" id="titre" name="titre" maxlength="100" class="form-control" style="font-size:20px;">
                <label style="font-size:20px;" for="titre">Titre de votre article</label>
                </div>
            </div>
            <div class="col-md-3 pt-4">
                <select id="categorie" name="categorie" class="browser-default custom-select">
                    <?php
                        foreach (get_all_categories() as $categorie):
                    ?>
                        <option value="<?= get_categorie_id_by_name($categorie['name']) ?>"><?= $categorie['name'] ?></option>
                    <?php
                        endforeach;
                    ?>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-md-9">
                <!-- Material input -->
                <div class="md-form">
                <input style="font-size:18px;" type="text" id="image" name="image" class="form-control">
                <label style="font-size:18px;" for="image">URL de votre image</label>
                </div>
            </div>
            <div class="col-md-3">
                <img id="apercu" src="" width="100%" alt="">
            </div>
        </div>


        <!--Material textarea-->
        <div class="md-form">
        <textarea style="font-size:18px;" id="contenu" name="contenu" class="md-textarea form-control" rows="10"></textarea>
        <label style="font-size:18px;" for="contenu">Contenu de votre article</label>
        </div>

        <input type="submit" id="submitPost" name="submitPost" class="btn btn-success" value="Créer l'article">

    </div>
</div>

</form>

<script>
document.getElementById('titre').addEventListener('keyup', function() {
document.getElementById('submitPost').value = 'Créer l\'article ' + this.value;
});
document.getElementById('image').addEventListener('keyup', function() {
document.getElementById('apercu').src = this.value;
});
</script>












    <!-- /FIN DU PROJET-->

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/js/mdb.js"></script>
    <!-- VueJS
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>-->
    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <!-- SCRIPTS
    <script src="js/app.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/script.js"></script>
-->

</body>
</html>
