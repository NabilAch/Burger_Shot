/**--------------------------------------------
 *?              PHP
 *---------------------------------------------**/

<?php

require 'database.php';

// Récuperez l'ID

if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}

// Lorsqu'on appuie sur "oui" selectionner l'id et le supprimer

if(!empty($_POST))  

{
    $id = checkInput($_POST['id']);

// Connexion a la BDD pour faire la supression (Supprime moi de la table l'id correspondant) 

    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM items WHERE id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: index.php");
}                      

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


/**--------------------------------------------
 *?              HTML
 *---------------------------------------------**/

?>

<!DOCTYPE html>
<html>

<head>
    <title>Burger Shot</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://www.pngrepo.com/png/43115/180/burger.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1 class="text-logo"> Burger'Shot <span class="glyphicon glyphicon-screenshot"></span></h1>
    <div class="container admin">
        <div class="row">
            <h1><strong>Supprimer un item</strong></h1>
            <br>
            <form class="form" action="delete.php" role="form" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <p class="alert alert-warning">Êtes vous sûr de vouloir supprimer ?</p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">Oui</button>
                    <a class="btn btn-default" href="index.php">Non</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>