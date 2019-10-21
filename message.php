<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
    <div class="list-btn">

         <button class="button_sortir"> <a href="index.php"> sortir</a></button>

    </div>
    <?php
    // on va afficher la liste des message json dans cette page 
    //1- en récupere le fichier json 
    $messages = file_get_contents('message.json');
    $messages = json_decode($messages ,true);
    //si le fichier json n'est pas vide 
  if(!empty($messages)){
    // maintenant nous avons les messages en format décoder il reste de les parcourirs avec une boucle for 
    for($i=0;$i< count($messages);$i++) {
    ?>
        <div class="message">
        <a href="?action=supprimer&id=<?= $messages[$i]['id'] ?>"><img class="sup_icone" src="img/delet.png" alt="supprimer"> </a> <br><br>
        <p> Le nom est : &nbsp; <span> <?= $messages[$i]['nom'] ?> </span></p>
        <p> Le prénom est : &nbsp; <span> <?= $messages[$i]['prenom'] ?></span> </p>
        <p>La date d'inscription est : &nbsp;  <span> <?= $messages[$i]['date'] ?></span> </p>      
        </div>
    <?php 
    } 
    }else{
        ?>
        <div class="message">
    
            <p> Vous n'avez aucun utilisateur inscrit pour le moment</p>

        </div>
        <?php
    } //fin de else

    //supprimer un utilisateur

    if(isset($_GET['action']) && $_GET['action']=='supprimer'){

        // on recupere json comme d'hab
        $messages= file_get_contents('message.json');

        // on le décode 

        $messages= json_decode($messages,true);

        // on crée un nouveau tableau et faire une condition 

        $nouveauTableau = array();

        // je parcourris l'ancien tableau $messages de json avec la boucle for 

        for($i=0;$i<count($messages);$i++){

            // maintenant je fais une contition : si l'id  de get est different de l'id de messages autrement dit si l'id que je veux supprimer est different de l'id de messages crée moi un nouveau tableau sans cet id
            if($messages[$i]['id'] != $_GET['id']){
             $nouveauTableau[]= $messages[$i];

            }

         

        }
       
        // faire encoder notre nouveau tableau 
        $nouveauTableau = json_encode($nouveauTableau);

        // l'envoyer et l'enregistrer dans notre fichier message.json 
        file_put_contents('message.json', $nouveauTableau);

        //ce code sert à renvoyer sur la meme page
         
    
        header('Location:message.php');  // le l de location doit etre en majuscule
        exit;
    
    }
        ?>

    <!-- script pour faire apparaitre et disparaitre l'icone delet -->
    <script>
        $(document).ready(function(){

            $('.message').mouseenter(function(){
            
                    $('.sup_icone').css('display','block');

            });
            $('.message').mouseleave(function(){
            
                $('.sup_icone').css('display','none');

            });
        });
        
    </script>
</body>
</html>