<?
session_start();
require_once '../includes/config.php';

if (isset($_GET['id']))
{
    $getid = intval($_GET['id']);
    $post = retrieve_post($getid);
}
else
{
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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $post['title'] ?></title>
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
  <a class="navbar-brand" href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCRvu70-oIYJSrEyR7HO64_TmcTr26UhsHB34a2GWZGERfKT2L" class="mr-2" width="30px;" alt=""> BloggyPenguy</a>

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
                <a class="nav-link" href="ajouter.php"><i class="fas fa-plus-circle mr-2"></i>Ajouter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion<i class="fas fa-sign-out-alt ml-2"></i></a>
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



    <div class="container">
        <h1 class="mt-5"><b><b><?= $post['title'] ?></b></b></h1>
        <div class="row">
            <div class="col-md-1 mt-2">
                <a href="profil.php?id=<?= $post['id_user'] ?>">
                    <img src="https://vignette.wikia.nocookie.net/nintendo/images/7/75/Mario.png/revision/latest?cb=20150913114044&path-prefix=tr" width="50px" style="border-radius:100%;" alt="">
                </a>
            </div>
            <div class="col-md-11" style="color:#BDBDBD;font-size:14px;">
                <b><b><?= 'Ajouté le 09/10/2019 à 16h'  ?></b></b>
                <br>
                Par <span style="color:black;"><a style="color:black;" href="profil.php?id=<?= $post['id_user'] ?>"><b><b><?= get_user_pseudo_by_id(1)[1] ?></b></b></a></span>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-1">
                <a target="_blank" href="http://facebook.com"><img class="mt-4" style="border-radius:100%;" src="https://image.flaticon.com/icons/png/512/124/124010.png" width="35px" alt=""></a>
                <a target="_blank" href="http://twitter.com"><img class="mt-3" style="border-radius:35px;" src="https://dragonsniortais.fr/wp-content/uploads/2019/04/logo-twitter-circle-png-transparent-image-1.png" width="35px" alt=""></a>
                <a target="_blank" href="http://Pinterest.com"><img class="mt-3" style="border-radius:35px;" src="https://www.stickpng.com/assets/images/580b57fcd9996e24bc43c52e.png" width="35px" alt=""></a>
                <a target="_blank" href="mailto:noah.chtl@gmail.com"><img class="mt-3" style="border-radius:10%;margin-left:2px;" src="http://lcdgg.thomascyrix.com/wp-content/uploads/2019/04/Gmail_Icon.png" width="35px" alt=""></a>
        
            </div>
            <div class="col-md-8">
                <img class="mb-4" src="<?= $post['image'] ?>" width="100%">
                
                <p style="font-size:19px;">
                    <?= $post['content'] ?>
                </p>
            
                <?php
                if (!empty($_SESSION['id']) && $_SESSION['id'] == $post['id_user'])
                {
                    ?>
                        <a title="Modifier" style="padding:10px 15px;" href="modifier.php?id=<?= $post['id'] ?>" class="btn btn-success text-white"><i class="far fa-edit mr-2"></i>Modifier</a>
                        
                        <a data-toggle="modal" style="padding:10px 15px;" data-value="<?= $post['id'] ?>" class="btnDelete btn btn-danger" data-target="#centralModalDanger"><i class="fas fa-trash-alt mr-2"></i>Supprimer</a>
                    <?php
                }
                
                ?>
            </div>



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





<!-- Footer -->
<footer class="page-footer font-small elegant-color mt-5 pt-2">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© <?= date('Y') ?> Copyright
    <a href="http://noah-chatelain.fr"> Noah Châtelain</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->







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
