<?php
// session_start();
// if(!($_SESSION['motdepasse'])){
// header('Location:connexion.php');}

include_once 'tmenu.php';
$pass_author=$_SESSION['motdepasse'];
$db=new PDO('mysql:host=localhost;dbname=message_prive;charset =utf-8;','root','');
//createPost
if (isset($_POST['POST'])){
    if( isset($_POST["friends_only"]) ){
       
        $title = $_POST["title"];
        $content = $_POST["content"];
        $friends_only =$_POST["friends_only"];
 
        $resultc=$db->prepare("INSERT INTO `post`( `pass_author`, `name`, `content`,  `friends_only`) 
        VALUES (:pass_author,:name,:content,:friends_only)");
        $resultc->execute([ "pass_author"=> $pass_author,
                            "name"=> $title,
                            "content"=> $content,
                            "friends_only"=>$friends_only
                         ]);}
      else{
          ?>
          <div class="alert alert-success" style="margin-left:250px;width:900px"><strong>cliquer sur AMIS</strong> </div>
          <?php
      }

}
//getPost

?>
<style type="text/css">
  
.card
{
max-height: 70%;
background-color :;
padding : 50px 50px;
margin-top: 40px;
border-top-right-radius:20px ;
border-bottom-right-radius: 20px;
height: 800px;
max-width: 70%;
left:250px;
margin-top: 60px;
}
.glyphicon{ color:red;}

.text{ color:cyan;
background-color:blue;}
.card-title{
  font-size: 3em;
  text-align: center;
}
.card-subtitle {
  font-size: 1.5em;

}
.title{
  size:20px;
  color:black;
}
</style>
<body>


<div  class="card" >
        <div class="card-body" >
          <h5 class="card-title"> Bienvenue <?php echo $_SESSION['email']; ?></h5>
          <!-- <h6 class="card-subtitle mb-2 text-muted"> Publication </h6> -->
           <div class=" row">
                    <div class="p-3 d-flex justifty-content-center flex-column align-items-center w-100 lat-dark-medium rounded-border ">
                        <form method="POST" class="w-100" >
                            <div class="border-bottom-light d-flex justify-content-between align-items-center mb-2  w-100">
                                <h2 >Creer une Publication</h2>
                                <div class="custom-control custom-switch  mb-2">
                                    <input type="checkbox" class="custom-control-input" name="friends_only" id="friends_only">
                                    <label class="custom-control-label" for="friends_only"style=" font-size: 1.2em;"><strong>Amis</strong></label>
                                </div>
                            </div>
                            <input type="text" name="title" placeholder="Titre" class="mb-2 form-control" maxlength="150">
                            <textarea type="text" name="content" placeholder="Text" rows="10" class="form-control"></textarea> 
                            <div class="d-flex justify-content-end mt-1">
                                <button type="submit" name="POST"    style=" color:black;background:#38ef7d" class=" btn black-text  btn-lg"> <Label style="color:black;font-size: 1.2em;"><strong>Publier</strong></label></button>
                            </div>
                        </form>
                    </div>
                    
      </div>
  </div>
</div>   
                
</body>
</html>
<!-- green40 -->