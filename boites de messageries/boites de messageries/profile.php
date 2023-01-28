<?php
session_start();
if(!($_SESSION['motdepasse'])){ 
header('Location:connexion.php');} 

$pass_author=$_SESSION['motdepasse'];
$db=new PDO('mysql:host=localhost;dbname=message_prive;charset =utf-8;','root','');

if(isset($_GET['sup'])){
  $id=$_GET['sup'];
  $Getsup=$db->prepare('DELETE FROM `post` WHERE id = :id');
   $Getsup->execute(["id" => $id]);

}
          
                  
                   
  ?>
<html>
<head>
<link rel="stylesheet"   type="text/css" href ="p.css.css">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    
    <title>Profile</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
<!--included all the css component-->
<link rel="stylesheet" href ="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!--  jquery library -->
<!-- <script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<!--latest complided javascript-->
<!-- <script src ="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


</head>
<style>
  body
{
    font-family: Arial, Helvetica, sans-serif;
}
.container
{
    position: relative;
    margin: auto;
    width:90%; height: 250px;
  
    background-size: cover;
    border-radius: 5px;
    overflow:hidden;
}
.information-bar
{
   position:absolute; /* dans container*/
    bottom: 0;
    width: 100%;
    height: 65px;
    background-color: #151728;
    left: 0px;

}
.profile
{
    position: absolute;
    display: flex; align-items: center;
    bottom:20px;
    left: 30px;
}
.profile img 
{
    width: 150px; height: 150px;
    border-radius: 50px;
    border: 3px solid #151728;

}
ul
{
    position: relative;
    width: 100px;
    display: flex;
    padding-left: 200px;
    height: 100%; margin:0;
}
li
{
    list-style: none;
    cursor: pointer ;
    color: #5c5e6e;
    font-size: 1.1em ; padding:1em;
    margin-left: 8em;

}
li:hover,active {
  
    color: white;
    border-bottom: 3px solid #59d195;
}
.name {
    color: white;
    margin-left: 1.5em;
    font-size: 1.5em;
    

}
.card{
  position: relative;
background-color :#151728;
padding : 50px 50px;
margin-top: 40px;
Border-radius:20px; 
width:90%; 
height: 100%;

margin-left:65px;
margin-top: 60px;
}
.text{ color:cyan;
background-color:blue;}
.card-title{
  font-size: 3em;
  text-align: center;
  color:#F8F8FF;
}

.title{
  font-size:0.5em;
}
col-md-4
{
  position:absolute;
  width: 500px;
  height: 100%;
  Border-radius:20px;

}

</style>
<body>


<div class="container" style="background-image: url('https://my.alfred.edu/zoom/_images/foster-lake.jpg');">
      <div class="information-bar">
        <ul>
        <li class="active"><li><a href="createPost.php"> Accueil</a></li> 
        <li ><a href="propos.php">Propos</a></li>
        <li ><a href="amis.php"> Amis</a></li>

        </ul>

      </div>
      <div class="profile">
        <?php $id=$_SESSION['id'];
              $recupInfo=$db->prepare('SELECT * FROM `information` WHERE  id= :id');
              $recupInfo->execute([
                  "id"=>$id ]);
              $dataIn=$recupInfo->fetchALL();
              for($o=0;$o<sizeof($dataIn);$o++) { ?>
                <img src ="membres/avatar/<?php echo $dataIn[$o]['img']; ?>" width ="333" height="250" alt="photo de profil">
                <?php } ?>
      <p class="name"> <?php echo $_SESSION['email']; ?></p>

      </div>
</div>

<div  class="card" style="height:10000px;">
        <div class="card-body">
        
          <h5 class="card-title"> Bienvenue <?php echo $_SESSION['email']; ?></h5>
          <center><h6 class="card-subtitle mb-2 text-muted" style="font-size:1.5em;"> <label>votre publication</label> </h6></center>
           <div class=" row">
           <?php
           
            $Getpost=$db->prepare("SELECT `id`, `pass_author`, `name`, `content`, `date_created`, `date_edited`, `friends_only` 
            FROM `post`  WHERE pass_author=:pass_author order by id desc");
            $Getpost->execute([ "pass_author"=> $pass_author]);
            $data=$Getpost->fetchALL();
            for($i=0;$i<sizeof($data);$i++){ ?>
                <div class="card"style="margin-top:30px;background-color:rgb(240, 255, 240);">
                <div >
                  <a style="margin-left:800px;position: relative;display: block;line-height: 40px;min-width: 10px;height: 25px;text-align: center;" href="profile.php?sup=<?php echo $data[$i]['id'];?>" data-toggle="tooltip" data-placement="right" title="supprimer" class="btn btn-info">
                      <i style="padding-right:15px;" class='bx bx-message-square-x'></i></a>
                </div> 
                  <h5 class="card-header"> <div class="text-muted" style="font-size: 0.9em;">Publier par <a href="userProfile.php?userid=<?php  $pass_author?>"  class="green40-text"><?php echo $_SESSION['email']; ?></a> en <span><?php  echo $data[$i]['date_created'];?></span></div></h5>
                    <div class="card-body">
                      <p class="card-text"> <h4 class="border-bottom pb-2" style="font-weight: bold;"><?php echo $data[$i]["name"]?></h4>
                          <p class="pb-2 mb-1"> <?php echo $data[$i]["content"]?> </p></p>
                                </div>
</div>
                <?php   }
             ?>

           </div>  
        </div>
        
</div>
<script>
        $(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});
 </script>

</body>
</html>