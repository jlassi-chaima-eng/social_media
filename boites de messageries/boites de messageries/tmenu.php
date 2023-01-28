<?php
session_start();
if(!($_SESSION['motdepasse'])){ 
header('Location:connexion.php');} 
?>
<html> 
<head>
<!-- <link  rel="stylesheet"  href ="tcss.css" type="text/css"> -->
<link rel="stylesheet"  href ="css.css" type="text/css">

<!-- <meta charset ="utf-8" />
<meta name ="viewport" content ="width-device-width , initial-scale=1" > -->


<title>Menu</title>
<?php require_once "bootstrap/bootstrap.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800;900&display=swap');
*{   margin:0;
    padding: 0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
    }
body{ background:#2c3e50;
    min-height:100vh;
    justify-content:center ;
    align-items: center;
    min-height: 100vh;
}
.navigation
{
    background: #11998e;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #38ef7d, #11998e);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #38ef7d, #11998e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    position: fixed;
    top:50px;
    left:20px;
    bottom: 20px;
    width: 70px;
    border-radius: 10px;
    box-sizing: initial;
    border-left:5px solid #11998e;
    /* background: #59d195;*/
    transition: width 0.5s;
    overflow-x: hidden;
}
.navigation.active
{
    width: 200px;
}
.navigation ul{
    position: absolute;
    top:0;
    left: 0;
    width:100%;
    padding-left: 5px;
    padding-top: 40px;
}
.navigation ul li
{
position:relative;
list-style: none;
width: 100%;
border-top-left-radius: 40px;
border-bottom-left-radius: 40px;
}
.navigation ul li.active {
    background: #fff;   
}
.navigation ul li a
{ 
    position: relative;
    display:block;
    width: 100%;
    display:flex;
    text-decoration: none;
    color:#fff;
}
.navigation ul li.active a {
   color: #333;   
}
/* contour d-icon */
.navigation ul li a .icon 
{ 
    position: relative;
    display: block;
    line-height: 70px;
    min-width: 60px;
    height: 60px;
    text-align: center;
}
.navigation ul li a .icon  ion-icon
{ 
    font-size: 2em;
    line-height: 40px;
    margin-top: 15px;
    
}
 .title {
    position:relative;
    display:block;
    padding-left: 10px;
    height: 60px;
    line-height: 50px;
    white-space: normal;
    font-size: 1.5em;
}
.toggle{
    position: fixed;
    top: 20px;
    right: 50px;
    width: 50px;
    height: 50px;
    background:#11998e;
    border-radius: 10px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
  }
.toggle.active
{
    background: #38ef7d;
}
.toggle ion-icon
{
    position: absolute;
    color :#fff;
    font-size: 34px;
    display: none;
}
.toggle ion-icon.open,
.toggle.active ion-icon.close
 {
     display: block;
 }
.toggle ion-icon.close,
.toggle.active ion-icon.open
 {
     display: none;
 }

</style>
<body >
                             
<nav class="navbar navbar-light ">

  <label style="color:white;font-size:2em;left:0px;"  >MYBOOK</label>
  <!-- <span class="navbar-brand mb-0 h1"style="color:white;font-size:2em;left:0px;padding-left:0px;">MYBOOK</span> -->
  <form method="POST" action="tmenu.php" > 

  <div class="input-group ps-5">

          <div id="navbar-search-autocomplete"  class="form-outline"style="left:0px;">
            <input type="search" id="form1" placeholder="Rechercher" name="sear" style="width:400px;"class="form-control" />
            <!-- <label class="form-label" for="form1" >Search</label> -->
          </div>
          <button type="submit" name="sub" style="top:0;background:#38ef7d;" class="btn ">
            <i class="fas fa-search"></i>
          </button>
        </div>
        </form>
</nav>                                                                                       
<?php 
$mysqli=new mysqli('localhost','root','','message_prive')or die(mysqli_error($mysqli));
    if(isset($_POST['sub'])):?> 
                                        <ul class="users" style="margin-top:80px;margin-left:230px;width:700px;">
                                         <?php 
                                                    $sear=$_POST['sear'];
                                                     $result=$mysqli->query("SELECT * FROM `users` WHERE email like '$sear%' ") or
                                                     die($mysqli->error);
                                                     
                                                   // $row=$result->fetch_assoc();
                                                    while($row=$result->fetch_assoc()):
                                                      
                                                    ?>
                                           <li class="person" data-chat="person1" style="background-color:white;">
                                                  <div class="user">
                                                     <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                         <span class="status busy"></span>
                                                           <p class="name-time">
                                                           <span class="name"> <a href="session.php?id=<?php echo $row['id'];?>& email=<?=$row['email'];?>"><p><?php echo $row['email'];?></p></a></span>
                                                    </div>
                                            </li>
                                          
                                            <?php endwhile;endif; ?>
                                        </ul>
                                </div>
                            </div>
                                   
 
<div class="navigation"style="top:60px;">
  <ul > 
     <li class="list active">
       <a href="createPost.php">
         <span class="icon" style=""><ion-icon name="home-outline"></ion-icon></span>
         <span class="title" style=" ">Accueil</span>
       </a>
     </li>
     <li class="list">
       <a href="profile.php">
         <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
         <span class="title">Profile</span>
       </a>
     </li>
     

     <li class="list">
       <a href="session.php">
         <span class="icon"><ion-icon name="chatbubbles-outline"></ion-icon></span>
         <span class="title">Messages</span>
       </a>
     </li>
     <li class="list">
       <a href="amis.php">
         <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>
         <span class="title">Mes amis</span>
       </a>
     </li>
     <li class="list">
       <a href="deconnexion.php">
         <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
         <span class="title">Deconnecter</span>
       </a>
     </li>
</ul>    
</div>
<div class="toggle"style="top: 0px;"> 
  <ion-icon name="menu-outline" class="open"></ion-icon>
  <ion-icon name="close-outline" class="close"></ion-icon>
</div>
<?php 
 require_once "js/js.php";
?>
<!-- <script>
  const icon=document.querySelector('.icon');
  const search=document.querySelector('.search');
  icon.onclick=function(){
    search.classList.toggle('active');
  }


  let menuToggle=document.querySelector('.toggle');
  let navigation=document.querySelector('.navigation');

  menuToggle.onclick=function(){
  menuToggle.classList.toggle('active');
  navigation.classList.toggle('active');
  }
  let list =document.querySelectorAll('.list');
  for( let i=0;i<list.length;i++){
    list[i].onclick=function(){
      let j=0;
      while(j<list.length){
        list[j++].className='list';
      }
      list[i].className='list active';
    }
  }
</script> -->
</body>
</html> 