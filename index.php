<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
   
</head>

<body>
<?php


    if(isset($_POST['nom']) && isset($_POST['prenom'])){
        // créée un tableau pour englober toutes les données saisies par l'utilisateur dans cette objet tableau .  
        $message = array();
        $message['nom'] = $_POST['nom'] ;
        $message['prenom'] = $_POST['prenom'];
        $message['date'] = date('d/m/Y à H:i:s');
        $message['id'] = date('dmYHis');
        // ouvrire json pour récuperer son contenu 
        $monJson= file_GET_contents('message.json');
        // décoder le contenu de mon json avec cette fonction :
        $monJsonDecode= json_decode($monJson , true);

        // ajouter notre tableau dans le fichier json 

        $monJsonDecode[] = $message ;

        // transformer le text en format json 

        $jsonencode = json_encode( $monJsonDecode);

        // mettre le contenu du tableau dans le fichier message.json 

        file_put_contents('message.json', $jsonencode);

        
    }
    $messageAlert ='';
    // message d'enregistrement
    if(isset($_POST['valider'])){
        if(isset($_POST['nom']) && isset($_POST['prenom']) ){
                
            $messageAlert = '<p> Merci pour l\'ajout <br> vous allez trouver vos données dans le fichier message.json </p>' ;

        }
    }
    
?>

<h1>Enregistrement des données en json php </h1>
<form action="#" method="POST" class="formulaire">
    <input type="text" placeholder="votre nom" name="nom" > 
    <input type="text" name="prenom" placeholder="votre prénom">
    <input class="valider" type="submit" value="valider" name="valider">
</form>
<div class="list-btn">

  <button class="button_user"> <a href="message.php"> Voir la liste des membres</a></button>

</div>
<?php echo $messageAlert ?>

<p>Réalisé par <a href="">Amirouche HELLAL</a></p>
    
</body>
</html>