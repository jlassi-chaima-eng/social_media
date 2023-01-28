<?php
$db=new PDO('mysql:host=localhost;dbname=message_prive;charset =utf-8;','root','');

if(isset($_POST['Enregt'])){
  
    $pseudo=$_POST['pseudo'];
    $email=$_POST['email'];
    $mdp2=$_POST['mdp2'];
    $mdp1=$_POST['mdp1'];
    $genre=$_POST['genre'];

    if(!empty($pseudo) and !empty($email) and !empty($mdp2) and !empty($mdp1) and isset($genre)){
   
      if($mdp2==$mdp1){
        //recup user
        
            $recupUU=$db->prepare('SELECT * FROM `users` WHERE  motdepasse= :mdp');
            $recupUU->execute([ "mdp"=>$mdp2]);
            $datau=$recupUU->fetchALL();
            echo $mdp2;
            //$u=0;
            // for($u=0;$u<sizeof($datau);$u++){
            //if ($mdp2 =! $datau[$u]['motdepasse']) {
              echo $mdp2."chhhh";
              //insert inscription
                $Eng=$db->prepare('INSERT INTO `inscription`( `pseudo`, `email`, `mdp`, `genre`) VALUES (?,?,?,?)');
                $Eng->execute(array($pseudo,$email,$mdp2,$genre ));
                //recupInscription
                $recupIns=$db->prepare('SELECT * FROM `inscription` WHERE  email=? and mdp=?');
                $recupIns->execute(array($email,$mdp2));
                $idIns=$recupIns->fetch()['id'];
                // insert user
                $Enguser=$db->prepare('INSERT INTO `users`( `id`, `email`, `motdepasse`) VALUES  (?,?,?)');
                $Enguser->execute(array($idIns,$email,$mdp2));
                // insert information
                $EngInfo=$db->prepare('INSERT INTO `information`( `id`, `pseudo`, `email`, `mdp`, `genre`) VALUES (?,?,?,?,?)');
                $EngInfo->execute(array($idIns,$pseudo,$email,$mdp2,$genre));
                //session
                            if($recupIns->rowCount()>0){
                                  session_start();
                                  $_SESSION['id']=$idIns;   //pour l'id reste au cours de tout page ouvert a partir d'user  
                                  $_SESSION['email']=$email;
                                  $_SESSION['motdepasse']=$mdp2; 
                                   header('Location:createPost.php');
                              }
            //  }
            //       else { ?>
                  <!-- <div class="alert alert-danger"><strong>mdp deja Existe!!!!</strong> </div>  -->
             <?php //}

      }
      else { ?>
      <div class="alert alert-danger"><strong>Verifier mdp incorect!!!!</strong> </div> 
      <?php }//echo "mdp incorect" ;
    }
    else{ ?><div class="alert alert-warning"><strong>tous les champs sont vide!!!!</strong> </div> 
    <?php
    }
}
 
?>
<html> 
<head>
<?php require_once "bootstrap/bootstrap.php"; ?>
<meta charset ="utf-8" />
<!-- <meta name ="viewport" content ="width-device-width , initial-scale=1" >
<title>Inscription</title>
<link rel="stylesheet" type="text/css" href ="ins-css.css"> -->
<!--included all the css component-->
<!-- <link rel="stylesheet" href ="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<!--  jquery library -->
<!-- <script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<!--latest complided javascript-->
<!-- <script src ="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->

<link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/css/mdb5/3.9.0/compiled.min.css?ver=3.9.0-update.4">
<link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB5-Pro-Advanced_3.3.0/plugins/css/all.min.css">
<link rel='stylesheet' id='roboto-subset.css-css'  href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5' type='text/css' media='all' />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style type="text/css">
.gradient-custom-3 {
    /* fallback for old browsers */
    background: #84fab0;
  
    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
  
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
  }
  .gradient-custom-4 {
    /* fallback for old browsers */
    background: #84fab0;
  
  
    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
  
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
  }
  </style>
<section class="vh-100 bg-image" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/search-box/img4.jpg');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card"  style=" border-radius: 15px;">
            <div class="card-body p-5" >
              <h2 class="text-uppercase text-center mb-5 " style="color:white;Border-radius:20px;background-color:#48D1CC;">Inscripez-vous</h2>

              <form role="form" method="POST" action="">

                <div class="form-group">
			             <input type="text" name="pseudo" id="first_name" class="form-control input-sm" placeholder="Votre pseudo">
			    	    </div>
               

               
            <div class="form-group">
                  <input type="email" name="email"  placeholder="votre Email" id="form3Example3cg" class="form-control form-control-lg" />
                
            </div>
            <div class="form-group">
                
                  <input type="password"  name="mdp2" placeholder= "Votre mot de passe" id="form3Example4cg" class="form-control form-control-lg" />
                  
             </div>

            <div class="form-group">
                  <input type="password" name="mdp1" placeholder="Confirmer votre mot de passe"  class="form-control form-control-lg" />
                  
             </div>

                <div class="form-check d-flex justify-content-center mb-5">
                  
                   <div class="form-check form-check-inline" >
                        <input class="form-check-input" type="radio" name="genre" id="inlineRadio1" value="Femme">
                        <label class="form-check-label" for="inlineRadio1" >Femme</label>
                        </div>
                        <div class="form-check form-check-inline" >
                        <input class="form-check-input" type="radio" name="genre" id="inlineRadio2" value="Homme">
                        <label class="form-check-label" for="inlineRadio2" >Homme</label>
                  </div>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn  btn-block btn-lg gradient-custom-4 text-body"style="background-color:#48D1CC;Border-radius:20px;color:white;" name="Enregt">Enregitrer</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Retour à la page LOGIN <a href="connexion.php" class="fw-bold text-body"><u>Login </u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>