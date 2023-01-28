<?php
session_start();
if(!($_SESSION['motdepasse'])){
header('Location:connexion.php');}
$s=$_SESSION['id'];


$mysqli=new mysqli('localhost','root','','message_prive')or die(mysqli_error($mysqli));

?>
<html>
<link rel="stylesheet" type="text/css" href ="css.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<link rel="stylesheet" href ="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src ="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href ="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">



    <title>
        chatApp
    </title>
    <body style="background: #11998e;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #38ef7d, #11998e);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #38ef7d, #11998e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
   
    <div class="container" style="margin-top: 80px;margin-left:200px; max-width: 70%;;Border-radius:20px; " >
            
            <!-- Page header start -->
            <div class="page-title">
                <div class="row gutters">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <h5 class="title">Chat App</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"> </div>
                </div>
            </div>
            <!-- Page header end -->
        
            <!-- Content wrapper start -->
            <div class="content-wrapper">
        
                <!-- Row start -->
                <div class="row gutters">
        
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        
                    <div class="card m-0"style="margin-top: 70px;margin-left:260px; max-width: 100%;">
        
                            <!-- Row start -->
                        <div class="row no-gutters">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                               <div class="users-container">
                                    <form  method="POST" action="">
                                      <div class="chat-search-box">
                                        
                                            <div class="input-group">
                                                
                                              <input type="text" class="form-control" placeholder="Search" name="search">
                                                <div class="input-group-btn">
                                                    <button type="submit" name="submit" class="btn btn-info">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php if(isset($_POST['submit'])):?> 
                                        <ul class="users">
                                         <?php
                                                    $search=$_POST['search'];
                                                     $result=$mysqli->query("SELECT * FROM `users` WHERE email like '$search%' ") or
                                                     die($mysqli->error);
                                                   // $row=$result->fetch_assoc();
                                                    while($row=$result->fetch_assoc()):
                                                    ?>
                                           <li class="person" data-chat="person1">
                                                  <div class="user">
                                                     <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                         <span class="status busy"></span>
                                                           <p class="name-time">
                                                           <span class="name"> <a href="?id=<?php echo $row['id'];?>& email=<?=$row['email'];?>"><p><?php echo $row['email'];?></p></a></span>
                                                    </div>
                                            </li>
                                          
                                         
                                        </ul>
                                </div>
                            </div>
                                    <?php endwhile;endif; ?>
                                
                                    
                                          <ul class="users">
                                                       <?php $recuperUser=$mysqli->query("SELECT * FROM `users` ")or
                                                             die($mysqli->error);
                                                             $a=false;
                                                            while ($user=$recuperUser->fetch_assoc()):
                                                            ?>
                                            <li class="person" data-chat="person1">
                                               <div class="user">
                                                   <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                   <span class="status busy"></span>
                                               </div>
                                                 <p class="name-time">
                                                  <span class="name"> <a href="?id=<?php echo $user['id'];?>&&email=<?=$user['email'];?>"><?php echo $user['email'];?></a> 
                                                  </p>
                                                  </span>
                                            </li>
                                               <?php endwhile;?>
                                           </ul>
                                    </div>
                               </div>
                                          
      

                                              <?php 
                                                 if (isset($_GET['id']) AND isset($_GET['email'])){
                                                     $email=$_GET['email'];
                                                     $id= $_GET['id'];
                                                   ?>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
                                                <div class="selected-user">
                                                    <span>To: <span class="name"><?php echo $email;?></span></span>
                                                </div>    
                                                            <?php //$a=true;
                                                  
                                                  $recup=$mysqli->query("SELECT * FROM `users` WHERE id = '$id'") or
                                                  die($mysqli->error);
                                                  if(  $recup->num_rows!=0){
                                                    $a=true;
                                                   if (isset($_POST['envoyer'])){ 
                                                       $b=true;
                                                    //    header("refresh: 3"); 
                                                        $message =htmlspecialchars( $_POST['message']);
                                                        if(!empty($message)&& $b==true){
                                                         $insereMessag= $mysqli->query("INSERT INTO `messages`( `message`, 
                                                         `id_destinataire`, `id_auteur`)  VALUES ('$message','$id','$s')") or
                                                         die($mysqli->error);
                                                            
                                                         $b=false;
                                                        }
                                                         
                                                    }
                                                  }else{echo "Aucun identifiant trouvee";}
                                                 }?>


  <section id="message">
                                                <div class="chat-container" >
                                                    <ul class="chat-box chatContainerScroll">
                                                        <?php if ($a==true){
                                                            $recuperMessage =$mysqli->query("select * from messages where 
                                                            id_destinataire='$s' and id_auteur='$id' OR id_destinataire='$id'
                                                             AND id_auteur='$s'")or
                                                            die($mysqli->error);
                                                            while($msg=$recuperMessage->fetch_assoc()){
                                                                if($msg['id_destinataire']==$s){?>
                                                        
                                                               <li class="chat-left">
                                                                  <div class="chat-avatar">
                                                                    <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                                       <div class="chat-name"><p><?= $email?> </p>
                                                                    </div>
                                                                   </div>
                                                                   <div class="chat-text"><label class="text1"><p style="color:red;">
                                                                   <?= $msg['message'];?></p></label>
                                                                  </div>
                                                                </li>
                                                            <?php } elseif ($msg['id_destinataire']==$id){?>
                                                              <li class="chat-right" > 
                                                                <div class="chat-text" style="color:blue; background=red;">  
                                                                <label class="text"> <p style="color:blue; "><?= $msg['message']; ?></p> </label>  </div>                         
                                                                    <div class="chat-avatar">
                                                                       <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                                       <div class="chat-name"><?php $u=$_SESSION['email']; echo "$u";?>
                                                                       </div>
                                                                    </div>
                                                                  
                                                             </li>
                                                                            
                                                         <?php }} }?>
                                                         <form method ="POST" >
                                                        <input type ="hidden" name="id" value="<?php echo $id;?>">
                                                          <div class="form-group mt-3 mb-0">
                                                           <textarea class="form-control" rows="3" name="message" placeholder="Type your message here..."></textarea>
                                                           <button type="submit" class="btn  btn-info"   name="envoyer" >Envoyer</button>
                                                        </div>
                                                        </form> 
                                                        <?php  ?> 
                                                         
                                                 
                                                         
                                        </ul> 
                                            
                                    </div>   
                                                             
     </section>
                                     

  
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
            
                        </div>
            
                    </div>
                    <!-- Row end -->
            
                </div>
                <!-- Content wrapper end -->
            
            </div>

    </body>
</html>