<!DOCTYPE html>
<html>

<head>
    <title>Burger Shot</title>
    <link rel="icon" href="https://www.pngrepo.com/png/43115/180/burger.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container site">
        <h1 class="text-logo"> Burger'Shot <span class="glyphicon glyphicon-screenshot"></span></h1>


        <!--=============================== PHP POSTER EN DYNAMIQUE =============================-->

        <?php
        require 'admin/database.php';
        echo '<nav>
                <ul class="nav nav-pills">';
        $db = Database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();


        /*======= Boucle pour afficher dynamiquement =======*/
        
        foreach($categories as $category)
        {
            if($category['id'] == '1')
                echo '<li role="presentation" class="active"><a href="#' . $category['id'] . '" data-toggle="tab">' .$category['name']. '</a></li>';
            else 
                echo '<li role="presentation"><a href="#' . $category['id'] . '" data-toggle="tab">' .$category['name']. '</a></li>';
        }   
        echo   '</ul>
            </nav>';

            echo '<div class="tab-content">';
            foreach($categories as $category)
        {
                if($category['id'] == '1')
                echo '<div class="tab-pane active" id="' . $category['id'] . '">';
            else 
                echo '<div class="tab-pane" id="' . $category['id'] . '">';

            echo '<div class="row">';


            /*======= Selecte tout les items qui ont une catégorie spécifique =======*/
            
            $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
            $statement->execute(array($category['id']));

            while($item = $statement->fetch())
            { 
                echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="images/' . $item['image'] . '" alt="...">
                                    <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                                    <div class="caption">
                                        <h4>' . $item['name'] . '</h4>
                                        <p>' . $item['description'] . '</p>
                                        <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                                    </div>
                                </div>
                            </div>';
            }
            echo   '</div>
               </div>';
        }
        
        Database::disconnect();
        echo '</div>';
        ?>
                                  
        </div> 
    </body>
</html>