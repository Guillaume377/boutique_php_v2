<?php
//inclure le fichier des fonctions pour pouvoir les appeler ici
include 'functions.php';

session_start();

//inclure le head avec les balises de base + la balise head (pour ne pas répéter le code qu'il contient)
include 'head.php';

?>

<body>
    <?php
    include 'header.php';
    ?>

    <main>
        <h1>Boutique</h1>
        <div class="container-fluid">
            <div class="row">
    
                    <?php
                    // je déclare la variable qui contient mon tableau d'articles
                    // sa valeur,c'est le tableau d'articles renvoyé par la fonction getArticles
                    $articles = getArticles();

                    // je teste cette variable pour vérifier que l'ai bien mes 3 articles
                    //var_dump($articles);

                    //ou à la place des 2($articles = getArticles() + var_dump($articles)), je mets la fonction plus courte = var_dump(getArticles)

                    //je lance ma boucle pour afficher une card bootstrap par article
                    foreach ($articles as $article) {
                        echo "<div class=\"card col-md-4\">
                                <img src=\"./images/" . $article['picture'] . "\" class=\"card-img-top\" alt=\"...\">
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">" . $article['name'] . "</h5>
                                    <p class=\"card-text\">" . $article['description'] . "</p>
                                    <a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
                                </div>  
                            </div>";
                    }
                    // Pour faire fonctionner le Foreach, je mets des "" (echo "... et ...</div>";) ainsi qu'un \ avant chaque " .

                    ?>
               
            </div>
        </div>
    </main>

    <?php
    include 'footer.php';
    ?>