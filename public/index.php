<?
session_start();
require_once '../includes/config.php';

if (isset($_GET['del']))
{
    $getid = intval($_GET['del']);
    delete_post($getid);
    header('location:index.php');
}


if (isset($_POST['login'])) {
    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);

        $requser = get_user_by_mail_and_password($mail, $password);

        $nbUsers = $requser->rowcount();

        if ($nbUsers == 1) {
            $requser = $requser->fetch();
            $_SESSION['id'] = $requser['id'];
            $_SESSION['pseudo'] = $requser['pseudo'];
            $_SESSION['mail'] = $requser['mail'];
            $_SESSION['password'] = $requser['password'];
        }
    }
}


$posts = get_all_posts();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BlogHarinck</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.8/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="icon" type="image/png" href="data:image/png;base64,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">
    <style>
        *
        {
            scroll-behavior: smooth;
        }
        .modal-dialog.modal-notify .modal-body {
            padding: 0.5rem;
            color: #616161;
        }
    </style>
</head>
<body>



<!-- MODALE CONNEXION -->


<form action="" method="POST">
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Connexion</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <i>Compte de Noah : noah.chtl@gmail.com & 123</i>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input id="mail" name="mail" type="email" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input id="password" name="password" type="password" id="defaultForm-pass" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Mot de passe</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button id="login" name="login" class="btn elegant-color white-text">Se connecter</button>
      </div>
    </div>
  </div>
</div>

</form>









<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark elegant-color">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#">BlogHarinck</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Accueil
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://github.com/Nooaah">Nooaah</a>
      </li>

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Catégories</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?cat=1">TECH</a>
          <a class="dropdown-item" href="index.php?cat=2">MOBILE</a>
        </div>
      </li>

      <?php
        if (empty($_SESSION['id']))
        {
            ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#modalLoginForm"><i class="far fa-laugh-wink"></i> Connexion</a>
                </li>
            <?php
        }
        else
        {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
            </li>
            <?php
        }
      ?>
    </ul>
    <!-- Links -->

    <form class="form-inline" action="" method="POST">
        <div class="md-form my-0">
        <!--
            <input class="form-control mr-sm-2" type="text" id="rechercher" name="rechercher" placeholder="Rechercher" aria-label="Rechercher">
        -->
        <?php
        if (isset($_SESSION['id']))
        {
            ?>
                <span class="white-text">Connecté en tant que <b><?= ucfirst($_SESSION['pseudo']) ?></b></span>
            <?php
        }
        ?>
        </div>
    </form>

  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->



    <div class="container">
        <h1 class="mt-5">Blog Harinck</h1>
        <div class="row">
            <? foreach($posts as $post): ?>
                <?php
$cat = retrieve_categorie($post['categorie']);
?>
                <div class="col-md-4 mt-5">
                    <h2><?=$post['title']?> / <b style="font-size:16px;"><?=$cat['name']?></b></h2>
                    <hr>
                    <p><?=substr($post['content'], 0, 350)?>...</p>
                    <?php
                    if (empty($_SESSION['id']))
                    {
                        ?>
                            <a href="#" class="btn elegant-color text-white">Lire la suite</a>
                        <?php
                    }
                    else
                    {
                        ?>
                            <a title="Modifier" style="padding:10px 15px;" href="modifier.php?id=<?= $post['id'] ?>" class="btn btn-success text-white"><i class="far fa-edit"></i></a>

                            <a data-toggle="modal" style="padding:10px 15px;" data-value="<?= $post['id'] ?>" class="btnDelete btn btn-danger" data-target="#centralModalDanger"><i class="fas fa-trash-alt"></i></a>
                            
                            <!-- <a title="Supprimer" style="padding:10px 15px;" href="index.php?del=<?= $post['id'] ?>" class="btn btn-danger text-white"><i class="fas fa-trash-alt"></i></a> -->
                        <?php
                    }
                    ?>
                </div>
            <? endforeach; ?>
        </div>
    </div>

    <script>

        for (var i=0; i< document.getElementsByClassName('btnDelete').length; i++)
        {
            document.getElementsByClassName('btnDelete')[i].addEventListener('click', function() {
                document.getElementById('btnHrefSupprimer').href = 'index.php?del=' + this.dataset.value;
            })
        }
    </script>


<!-- Central Modal Medium Danger -->
<div class="modal fade" id="centralModalDanger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Supprimer</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <i class="far fa-times-circle fa-4x mb-3 animated rotateIn mt-4"></i>
          <p class="mt-3">Êtes vous sûr de vouloir supprimer ce post ?</p>
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a id="btnHrefSupprimer" href="" type="button" class="btn btn-danger">Supprimer</a>
        <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Non merci</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Medium Danger-->











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
