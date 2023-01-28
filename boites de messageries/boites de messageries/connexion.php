 
       

<html> 
<head>
<meta charset ="utf-8" />
<meta name ="viewport" content ="width-device-width , initial-scale=1" >
<title>Login</title>
<!--included all the css component-->
<link rel="stylesheet" href ="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!--  jquery library -->
<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--latest complided javascript-->
<script src ="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/css/mdb5/3.9.0/compiled.min.css?ver=3.9.0-update.4">
<link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB5-Pro-Advanced_3.3.0/plugins/css/all.min.css">
<link rel='stylesheet' id='roboto-subset.css-css'  href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5' type='text/css' media='all' />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style type="text/css">


<style type="text/css">
Body {color :white;}
.container-fluid{
background-color : #F5FFFA	;
padding : 50px 280px;
Border-radius:120px;
max-width: 80%;
max-height: 200%;
margin-top: 80px;
}
.glyphicon{ color:cyan;}
.text{ color:white;
  Border-radius:20px; 
  background-color:#48D1CC;}
.btn{ background-color:#48D1CC;}
.gradient-custom-3 {
    /* fallback for old browsers */
    background: #84fab0;
  
    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
  
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
  }

</style>
<section class="vh-100 bg-image" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/search-box/img4.jpg');">
<?php

$mysqli=new mysqli('localhost','root','','message_prive')or die(mysqli_error($mysqli));

if(isset($_POST['connecter'])){
  $email=$_POST['email'];
  $mdp=$_POST['mdp'];
   if(!empty($mdp) and !empty($email)){
        $recuperUser=$mysqli->query("SELECT * FROM `users` WHERE  email='$email' AND motdepasse='$mdp'")or
        die($mysqli->error);
        if ($recuperUser->num_rows!=0){ 
     ?> 
       <div class="alert alert-success"><strong>Success</strong> </div> 
                <?php 
                session_start();
                $_SESSION['id']=$recuperUser->fetch_assoc()['id'];   //pour l'id reste au cours de tout page ouvert a partir d'user  
                $_SESSION['email']=$email;
                $_SESSION['motdepasse']=$mdp; 
                header('Location:createPost.php');}
     
     else{?> 
         <div class="alert alert-danger"><strong>Aucun utilisateur trouvee!!!!</strong> </div> 
        <?php 
        //  echo "Aucun utilisateur trouvee!!!!";
        }
    }
   else{ ?><div class="alert alert-warning"><strong>VIDE!!!!</strong> </div> <?php }} ?>
<div class="mask d-flex align-items-center h-100 gradient-custom-3">
<div class="container-fluid" >
<!-- pour devenir une seule ligne  ,ajouter class="form-inline" in form  -->
<form role="form" method="POST" action="">
<center><h1 class="text"> login </h1></center>
    <div >
         <label for="email"> Email   <span class="glyphicon glyphicon-star"></span></label>
          <input type="text" class="form-control" id="email" placeholder="MyWebsite@gmail.com" maxlength="50" name="email"/>
    </div>
    <div >
        <label for="pwd"> Password  <span class="glyphicon glyphicon-star"></span></label>
        <input type="password" class="form-control" id="pwd" placeholder="*******" maxlength="50" name="mdp"/>
   
    </div>
</br>

   
 <center>  <button type="submit" class="btn  btn-lg" name="connecter">connecter</button></center> 
 <div class=col-lg-4><a href="inscription.php">  <strong> Inscripez-vous!! </strong> </a></div>
  </form>
	


 
</div>
</div>
</section>	    
</body>
</html> 

