<?php include ("tmenu.php");?>
<?php
// session_start();
// if(!($_SESSION['motdepasse'])){
// header('Location:connexion.php');}
$email=$_SESSION['email'];
$checkuser[]=$email;
$db=new PDO('mysql:host=localhost;dbname=message_prive;charset =utf-8;','root','');

if (isset($_GET['ajouter'])){//envoyer une invitation
  $id=$_GET['ajouter'];
  $i=0;
  $resultc=$db->prepare("INSERT INTO amis ( `user1`, `user2`, `type`) VALUES (:email ,:id ,:i)");
  $resultc->execute([ "email"=> $email,
                      "id"=> $id,
                      "i"=> $i ]);
}
if (isset($_GET['confirmer'])){//confirmer une invitation
    $id=$_GET['confirmer'];
    $i=0;
    $resultc=$db->prepare('UPDATE `amis` SET `type`= :i WHERE id= :id');
    $resultc->execute([ "i"=>$i,
    "id"=>$id]);
}
if (isset($_GET['supprimer'])){//supprimer un ami
    $id=$_GET['supprimer'];
    $result=$db->prepare('DELETE FROM `amis` WHERE id= :id');
    $result->execute([ "id"=>$id]);
   }
$email=$_SESSION['email'];
$query=$db->prepare('SELECT * FROM `amis` WHERE user1= :user_1 OR user2= :user_2');
$query->execute([
    "user_1"=>$email,
    "user_2"=>$email

]);
$data=$query->fetchALL();


?>


<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800;900&display=swap');
*{
    margin:0;
    padding: 0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}
Body {color :black;
  min-height:100vh;
  background:#2c3e50;
    justify-content:center ;
    align-items: center;
    min-height: 100vh;}
.card
{

padding : 50px 50px;
margin-top: 40px;
border-top-right-radius:20px ;
border-bottom-right-radius: 20px;

max-height: 100%;
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
.nav 
{
  position:relative;
  top: 60px;
  left:250px;
  height:60px;
}
.nav-item
{background:white;}
</style>
<body>

                    <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a role="tab" href="#amis" data-toggle="tab"><center><label class="title">Amis</label></center></a>
                    </li>
                    <li class="nav-item">
                        <a  role="tab" href="#invitations" data-toggle="tab" ><center><label class="title">Invitations</label></center></a>
                    </li>
                    <li class="nav-item">
                        <a  role="tab" href="#utilisateurs" data-toggle="tab"><center><label class="title">utilisateurs</label></center></a>
                    </li>
                    
                    </ul>
                    
<div class="tab-content">
  <div role="tabpanel1" class="tab-pane  active" id="amis">
      <div  class="card">
        <div class="card-body">
          <h5 class="card-title"> Bienvenue <?php echo "$email"; ?></h5>
          <h6 class="card-subtitle mb-2 text-muted"> listes d'amis </h6>
           <div class=" row">
              <table class="table">
                  <thead>
                    <tr>
                      <th ><label class="title"> nom d'amis</label></th>
                      <th   colspan="2"><label class="title">Action</label></th>

                    </tr>
                    
                </thead>
                    <?php 
                
                for($i=0;$i<sizeof($data);$i++){
                    
                    if($data[$i]['user1']==$email and $data[$i]['type']==0){//verifier user connecter   $row['user1']=$email
                    ?>
                    <tr>
                        <td> <label><?php echo $data[$i]['user2'] ."  en attente"; ?></label> </td>
                          <td>
                              
                              <a href="amis.php?supprimer=<?php echo $data[$i]['id'];?>"
                              class="btn btn-danger btn-lg"> <Label style="color:black;">Supprimer</label></a>
                               
                          </td>
                          <?php $checkuser[]=$data[$i]['user2']; ?>
                    </tr> 
                    
                    <?php
                        }                     
                  else{
                          if(($data[$i]['type']==0) ){
                          ?><tr>
                        <td><label> <?php echo $data[$i]['user1'];?></label></td>
                       
                        <td>      
                              <a href="amis.php?supprimer=<?php echo $data[$i]['id'];?>"
                              class="btn btn-danger btn-lg"> <Label style="color:black;">supprimer</label></a>                             
                          </td>
                          <?php $checkuser[]=$data[$i]['user1']; ?>
                          </tr>
                          
                          <?php
                          }
                        
                      }
                      echo "<br/>";
                  }
              
                  ?>

              </table>
           </div>
      </div>
  </div>
  </div>
  <div role="tabpanel1" class="tab-pane  " id="invitations">
  
      <div  class="card">
        <div class="card-body">
          <h5 class="card-title"> <center><h1> Demande d'amis  (ivitations)</center></h1></h5>
          <h6 class="card-subtitle mb-2 text-muted"> listes d'invitations </h6>
           <div class=" row">
              <table class="table">
                  <thead>
                    <tr>
                      <th ><label class="title"> nom </label></th>
                      <th   colspan="2"><label class="title">Action</label></th>

                    </tr>
                    
                   </thead>
                            <?php 
                          
                          for($i=0;$i<sizeof($data);$i++){
                              if($data[$i]['type']==1 and $data[$i]['user2']== $email){?>
                            <tr>
                                    <td> <label><?php  echo $data[$i]['user1'];?>
                                       
                                    </td>
                                      <td>
                                      <a href="amis.php?confirmer=<?php echo $data[$i]['id'];?>"
                                          class="btn btn-success btn-lg"> <Label style="color:black;">Confirmer</label></a>
                                      <a href="amis.php?supprimer=<?php echo $data[$i]['id'];?>"
                                          class="btn btn-danger btn-lg"> <Label style="color:black;">Refusé</label></a>
                                      </td>
                                      <?php $checkuser[]=$data[$i]['user1']; ?>
                                </tr> 
                              

                                  <?php
                                                    }
                                                }
                                                  ?>
             </table>
           </div>
      </div>
  </div>
  </div>
  <div role="tabpanel1" class="tab-pane  " id="utilisateurs">
  
    <div  class="card">
        <div class="card-body">
            <h5 class="card-title"> <center><h1> <h1> Autres utilisateurs  </h1></center></h1></h5>
            <h6 class="card-subtitle mb-2 text-muted"> listes d'utilisateurs </h6>
                <div class=" row">
                    <table class="table">
                        <thead>
                          <tr>
                            <th ><label class="title"> nom </label></th>
                            <th   colspan="2"><label class="title">Action</label></th>
                          </tr>
                      </thead>
                      <?php
                           
                          $result=$db->query("select * from users");
                          $data=$result->fetchAll();
                          for($i=0;$i<sizeof($data);$i++){
                              if(!(in_array($data[$i]['email'],$checkuser))){
                      ?>
                                <tr>
                                    <td>
                                       <label><?php  echo $data[$i]['email']; ?></label>
                                    </td>
                                    
                                      <td>
                                         <a href="amis.php?ajouter=<?php echo $data[$i]['email'];?>"
                                            class="btn btn-success btn-lg"> <Label style="color:black;">Ajouter</label></a> 
                                      </td>
                                      
                                      
                                      </tr>
                                      <?php
                                         }    
                                         } ?>
                                  

                     </table>
                  </div>
         </div>
      </div>
  </div>
</div>
   


</body>
</html>