<?php

// ******************************** renvoyer un tableau d'articles ************************************** */

function getArticles()
{
    return [
        //***************************** article 1***************************** */
        [
            'name' => 'Coffret Atelier Albrecht Dürer',
            'id' => '1',
            'price' => 89.99,
            'description' => 'Un coffret de 36 crayons très facile à emporter',
            'detailedDescription' => 'Coffret Atelier Albrecht Dürer, 36 crayons Albrecht Dürer et 1 pinceau aquarelle haut de gamme 
                            dans un superbe coffret en imitation cuir à fermeture magnétique.
                            Très facile à emporter lors de vos voyages et magnifique écrin pour votre atelier.',
            'picture' => 'coffret_dürer.jpg'
        ],

        //*****************************article 2****************************** */

        [
            'name' => 'Coffret de crayons en bois Lightfast',
            'id' => '2',
            'price' => 349.99,
            'description' => 'La gamme Lightfast dans un superbe coffret en bois.',
            'detailedDescription' => 'Tous les plaisirs et les exceptionnelles qualités de la gamme Lightfast. 
                            Un superbe coffret en bois contenant 100 crayons de bois aux couleurs uniques.',
            'picture' => 'coffret_lightfast.jpg'
        ],

        //*****************************article 3****************************** */
        [
            'name' => 'Coffret en bois de 120 crayons supracolor soft',
            'id' => '3',
            'price' => 495.99,
            'description' => 'L´ensemble de la gamme de couleurs Supracolor dans dans un coffret en bois de couleur acajou.',
            'detailedDescription' => 'Coffret en bois de 120 crayons supracolor soft : Dimensions du coffret: 24,5 x 39,5 x 6 cm. Une parfaite idée de cadeau.
                         Les crayons aquarellables Supracolor Soft ont une mine tendre de 3,8 mm de diamétre, mine très résistante mais aussi économique grâce à son opacité remarquable. 
                         Destinées aux œuvres de grande ampleur, les mines sont extrêmement solides.
                         La gamme de crayons aquarellables Supracolor Soft propose une grande variété d’applications grâce à la luminosité des teintes et à leur excellent pouvoir couvrant.
                         Le dessin au crayon peut ainsi être délavé, estompé au doigt, texturé au frottement de la mine sur un papier abrasif ou pleinement aquarellé.',
            'picture' => 'coffret_supracolor.jpg'
        ],

    ];
}

// ****************************************** récupérer le produit  qui correspond à l'id fourni en paramètre ***********************

function getArticleFromId($id) {   //$id : j'aurais pu choisir le nom que je souhaite

    //récupérer la liste des articles
    $articles = getArticles();

    // aller chercher dedans l'article qui comporte l'id en paramètre
    foreach ($articles as $article) {
        if($article['id'] == $id) {

            // le renvoyer avec un return
            return $article;
        }
    }
}
