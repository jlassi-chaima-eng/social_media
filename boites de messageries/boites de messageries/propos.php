<?php
session_start();
$mdp=$_SESSION['motdepasse'];
$id=$_SESSION['id'];

$update=false;
if(!($mdp)){
header('Location:connexion.php');}
$id=$_SESSION['id'];
$db=new PDO('mysql:host=localhost;dbname=message_prive;charset =utf-8;','root','');
$recup=$db->prepare('SELECT * FROM `inscription`  WHERE id= :id');
$recup->execute([
    "id"=>$id ]);
$data=$recup->fetchALL();
//update
if ( isset($_GET['modifier'])  ) {
  $update=true;
  if(isset($_POST['savee'])){  
      if(isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
        $taillemax=2097152; // 2mo
        $extensionsValides=array('jpg','jpeg','gif','png');
        if($_FILES['img']['size'] <= $taillemax){
          $extensionUpload=strtolower(substr(strrchr( $_FILES['img']['name'] , '.'),1)); 
          if(in_array($extensionUpload,$extensionsValides)) {
            $chemin="membres/avatar/".$_SESSION['id'].".".$extensionUpload;
            $resultat=move_uploaded_file($_FILES['img']['tmp_name'],$chemin);
                     if($resultat) {
                          $id=$_SESSION['id'];                                                    
                          $pseudo=$_POST['pseudo'];
                          $email=$_POST['email'];
                          $mdp11=$_POST['mdp'];
                          $genre=$_POST['genre'];
                          $universite=$_POST['universite'];
                          $etude=$_POST['etude'];
                          $phone=$_POST['phone'];
                          $habite=$_POST['lieu'];
                          $img=$id.".".$extensionUpload;
                          $result=$db->prepare('UPDATE `information` SET 
                          `pseudo`=?,`email`=?,`mdp`=?,`genre`=? ,`universite`=?,`etude`=?, `phone`=?,`habite`=?,`img`=? WHERE id=?');
                          $result->execute( array( $pseudo,$email,$mdp11,$genre,$universite,
                          $etude,$phone,$habite,$img,$id));
                          $updateusers=$db->prepare('UPDATE `users` SET `email`=?,`motdepasse`=? WHERE id=?');
                          $updateusers->execute( array( $email,$mdp11,$id ));
                          $updatpost=$db->prepare('UPDATE `post` SET `pass_author`=? WHERE  id_info=?');
                          $updatpost->execute( array( $mdp11,$id ));
                          $updatpost=$db->prepare('UPDATE `inscription` SET `mdp`=? WHERE id= ?');
                          $updatpost->execute( array( $mdp11,$id ));
                          $update=false;
                          header('location:profile.php');
                                      }
                                    else {
                                        echo "Erreur durant L''importation de votre photo de profil";
                                      } 
                            }
                              else {
                                echo "votre photo de profil doit etre de format jpng ,jpeg,jpg,gif";
                              }
                          }
                          else {
                            echo "votre photo de profile ne doit pas depasser 2 Mo";
                          }
                    } } }
?>
<html>
<head>
<?php require_once "bootstrap/bootstrap.php"; ?>
<title>Propos</title>
</head>
<style>   
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800;900&display=swap');
*{
    margin:0;
    padding: 0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}
body
{  
  background:#2c3e50 ;
  font-family: Arial, Helvetica, sans-serif;
}
.card{
position: relative;
background-color :#F5FFFA;
padding : 50px 50px;
top: 0px;
Border-radius:20px; 
width:90%; 
max-height: 100%;
height:800px;
margin-left:65px;
margin-top: 20px;
}
.text{ 
  color:cyan;
  background-color:blue;}
.card-title{
  font-size: 3em;
  text-align: center;
}

.title{
  font-size:0.5em;
}
.card-text{
    font-size:1em; 
}
</style>
<div class="card mb-3" >
  <div class="row g-0">
    <div class="col-md-4">
    <?php 
          // $mdp=$_SESSION['motdepasse'];
              $recupIn=$db->prepare('SELECT * FROM `information` WHERE  id= :id');
              $recupIn->execute([
                  "id"=>$id ]);
              $dataInf=$recupIn->fetchALL();
              for($K=0;$K<sizeof($dataInf);$K++) { ?>
                <img src ="membres/avatar/<?php echo $dataInf[$K]['img']; ?>" class="img-fluid rounded-start" alt="..." style="position:absolute; width: 350px;height:500px;Border-radius:20px;
      left:0px;top:0px;bottom:0px">
                <?php } ?>
      <!-- <img src="ch.jpg" class="img-fluid rounded-start" alt="..." style="position:absolute; width: 350px;height:500px;Border-radius:20px;
      left:0px;top:0px;bottom:0px"> -->
      
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h5 class="card-title">Mes informations générales</h5>
          <?php     
          if($update==false) {
             for($i=0;$i<sizeof($data);$i++) { ?> 
                  <p class="card-text"> <?php echo $data[$i]['pseudo']; ?></p>
                  <hr>
                  <p class="card-text"> <?php echo $data[$i]['email']; ?></p>
                  <hr>
                  <?php }
                  $recupInfo=$db->prepare('SELECT * FROM `information` WHERE id= :id');
                  $recupInfo->execute([
                      "id"=>$id ]);
                  $dataInfo=$recupInfo->fetchALL();
                  for($Y=0;$Y<sizeof($dataInfo);$Y++) { ?> 
                      <p class="card-text"> Phone: <?php echo $dataInfo[$Y]['phone']; ?></p>
                      <hr>
                      <p class="card-text"> <?php echo $dataInfo[$Y]['mdp']; ?></p>
                      <hr>
                      <p class="card-text"> Etudes: <?php echo $dataInfo[$Y]['etude']; ?> </p>
                      <hr>
                      <p class="card-text"> Universites :<?php echo $dataInfo[$Y]['universite']; ?> </p>
                      <hr>
                      <p class="card-text"> Habite a <?php echo $dataInfo[$Y]['habite']; ?></p>
                      <hr>
                      <p class="card-text"> <?php echo $dataInfo[$Y]['genre']; ?></p>

                      <center> <a href="propos.php?modifier=<?php echo $mdp; ?>"
                        class="btn  btn-lg" style=" background: #38ef7d;"> <Label>Modifier</label></a></center>
                  
             <?php }}
         else { ?> 
                <form  method="POST" action="" enctype="multipart/form-data" >
                  <div class="form-group">
                      <input type="text" name="pseudo" id="first_name" class="form-control input-sm" placeholder="Votre pseudo">
                    </div>
                    <div class="form-group">
                      <input type="email" name="email"  placeholder="votre Email" id="form3Example3cg" class="form-control form-control-lg" />
                    </div>
                    <div class="form-group">
                      <input type="text" name="phone"  placeholder="votre phone" id="form3Example3cg" class="form-control form-control-lg" />
                    </div>
                    <div class="form-group">
                      <input type="password"  name="mdp" placeholder= "Votre mot de passe" id="form3Example4cg" class="form-control form-control-lg" /> 
                    </div>
                    <div class="form-group">
                        <input type="text" name="etude"  class="form-control input-sm" placeholder="Votre Etude">
                    </div>
                    <div class="form-group">
                        <input type="text" name="universite"  class="form-control input-sm" placeholder="Votre universite">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lieu"  class="form-control input-sm" placeholder="Votre lieu">
                    </div>
                    <div class="form-check d-flex justify-content-center mb-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="genre" id="inlineCheckbox1" value="femme">
                        <label class="form-check-label" for="inlineCheckbox1">Femme</label>
                    </div>
                  <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="genre" id="inlineCheckbox2" value="homme">
                        <label class="form-check-label" for="inlineCheckbox2">Homme</label>
                  </div>
                  </div>
                  <label> changer votre photo de profil :</label> <input type="file" name="img" />   
                  <div class="form-group">                                 
                        <center>  <button type="submit" class="btn btn-success btn-lg" name="savee">Enregitrer</button></center>  
                  </div> 
                      <?php
                     } ?>
                        
      </div>
    </div>
  </div>
</div>

</body>
</html>