<?php
include '../php/db.php' ;
$data = recup_data();
$vendeur = true;
$admin = false;
while($auser = mysqli_fetch_assoc($data))
{
    $id_user = $auser['ID_user'];
    if($auser['status'] == 'acheteur')
    {
        $vendeur = false;
    }
    elseif($auser['status'] == 'admin'){
        $admin = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style-general.css">
    <link rel="stylesheet" href="../css/style-carrou.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/carrousselAccueil.js"></script>
    <title>Accueil</title>
</head>
<body>
    
    <h1>Bienvenue sur la page d'accueil</h1>
    <a href=../php/connexion.php>Retourner a la page de connexion</a>

    <nav class="navbar">
        <ul>
            <li><a href="../php/accueil.php">Accueil</a></li>
            <?php
                if($admin){
                    echo "<li><a href='../php/liste_vendeur.php'>Vendeurs</a></li>";
                }
                else{
                    echo "<li><a href='../php/parcourir.php'>Tout Parcourir</a></li>";
                }
            ?>
            <li><a href="../php/notifications.php">Notifications</a></li>
            <?php
                if($vendeur OR $admin)
                {
                    echo "<li><a href='../php/vosArticles.php'>Vos Articles</a></li>";
                }
                elseif(!$vendeur AND !$admin)
                {
                    echo "<li><a href='../php/panier.php'>Panier</a></li>";
                }
            ?>
            <li><a href="../php/compte.php">Votre Compte</a></li>
        </ul>
    </nav>

    <div id="carrousel">
        <img src="../photos/ak.jpeg" />
        <img src="../photos/v.jpeg" />
        <img src="../photos/livre.jpeg" />
    </div>

    <div id="controles">
        <button id="precedent">Precédent</button>
        <button id="defilement">Désactiver le défilement</button>
        <button id="suivant">Suivant</button>
    </div>

    <section id="presentation">
      <h2>Présentation</h2>
      <p id="presentation-text">Bienvenue sur FNAH, votre nouvelle plateforme de vente en ligne ! Chez FNAH, nous offrons une expérience unique qui permet à des vendeurs passionnés de mettre en vente leurs produits et à des acheteurs avides de découvrir de nouvelles opportunités d'achat. <br></br>

		Notre plateforme est conçue pour offrir une variété de types de vente afin de répondre à tous vos besoins. Que vous soyez un vendeur cherchant à commercialiser vos produits, ou un acheteur à la recherche d'offres exclusives, FNAH est l'endroit idéal pour vous. <br></br>

		En tant que vendeur sur FNAH, vous bénéficiez d'un espace dédié où vous pouvez créer et gérer vos annonces en toute simplicité. Mettez en valeur vos produits grâce à des descriptions détaillées, des images attractives et des vidéos explicatives. Vous pouvez choisir entre trois types de vente : <br></br>

		Vente normale : Vous fixez un prix fixe pour vos produits et les acheteurs peuvent les acheter directement. C'est idéal pour ceux qui préfèrent une transaction simple et rapide. <br></br>

		Vente aux enchères : Vous avez la possibilité de mettre vos produits aux enchères, permettant ainsi aux acheteurs de faire des offres et de participer à une compétition amicale pour obtenir votre produit. Les enchères apportent une touche d'excitation et peuvent vous permettre d'obtenir des prix plus élevés pour vos produits. <br></br>

		Transaction client-vendeur : Cette option permet aux acheteurs et aux vendeurs d'interagir directement pour négocier les prix, les quantités, ou d'autres conditions de vente spécifiques. Cette fonctionnalité est idéale pour les produits personnalisables ou pour ceux qui préfèrent une approche plus directe. <br></br>

		Lorsque vous êtes acheteur sur FNAH, vous pouvez explorer une multitude de produits de différentes catégories. Que vous recherchiez des livres, des gadgets électroniques, des films, de la musique, des jeux vidéo ou bien plus encore, FNAH est votre destination incontournable pour trouver ce que vous désirez. En créant un compte sur notre site, vous pourrez sauvegarder vos produits préférés, suivre les vendeurs que vous aimez et profiter de recommandations personnalisées selon vos intérêts.<br></br>

		Chez FNAH, nous accordons une grande importance à la sécurité des transactions. Nous mettons en place des mesures de sécurité avancées pour protéger vos informations personnelles et financières. De plus, notre équipe de service client est toujours prête à vous aider en cas de besoin, que ce soit pour répondre à vos questions ou pour résoudre d'éventuels problèmes.<br></br>

		Rejoignez-nous dès maintenant sur FNAH et découvrez une expérience de vente en ligne unique, où les vendeurs rencontrent les acheteurs dans un environnement convivial et sécurisé. Que vous cherchiez à vendre vos produits ou à dénicher des trésors cachés, FNAH est là pour vous accompagner tout au long de votre parcours d'achat et de vente en ligne.<br></br></p>
    </section>

    <footer style="background-color: #585858;padding: 10px;bottom: 0;width: 100%;height: 100px;display: flex;align-items: center;"> 
        <p>Contactez-nous : agorafrancia@gmail.com
        <br>Téléphone : 06.12.13.14.15</p>
        <div style="margin-left: auto;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3726222018067!2d2.2885375999999997!3d48.8511045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b486bb253%3A0x61e9cc6979f93fae!2s10%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1685376633191!5m2!1sfr!2sfr" style="width: 300px; height: 110px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </footer>

</body>
</html>