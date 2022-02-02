<?php
include("header.php");

require("classes/article.php");
require("classes/categorie.php");
require("classes/user.php");

unset($_SESSION["current-article"]);
?>

<h1>Liste des articles</h1>

<form method="get">
    <label for="catégorie">Trier par catégorie :</label>
    <select name="categorie">
        <!-- Valeur par défault -->
        <option value="default">Tout</option>
        <?php
        $connexion = new PDO(
			"mysql:host=localhost;dbname=thibault-kine_blog;charset=utf8",
			"thibault-kine",
			"nessias84"
		);
        $selectQuery = "SELECT * FROM categories";

        $stmt = $connexion->prepare($selectQuery);
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Fait le tour des catégories existantes et les ajoute dans le select
        foreach($fetch as $categorie)
        {
            echo "<option value='".$categorie["id"]."'>".$categorie["nom"]."</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit">
</form>

<?php
if(!isset($_GET["start"]))
{
    $_GET["start"] = 1;
}
$page = $_GET["start"];
$limite = 5;
$offset = ($page - 1) * $limite;
$connexion = new PDO(
    "mysql:host=localhost;dbname=thibault-kine_blog;charset=utf8",
    "thibault-kine",
    "nessias84"
);

if($_GET["categorie"] == "default" || !isset($_GET["categorie"]))
{
    $tri = "ORDER BY id DESC";
}
else
{
    $tri = "WHERE id_categorie=".$_GET["categorie"];
}

$query = "SELECT * FROM articles $tri LIMIT 5 OFFSET $offset";
// var_dump($query);

// id par ordre décroissant, du plus récent au plus ancient
$stmt = $connexion->prepare($query);
// si la catégorie est autre que "default"
if($_GET["categorie"] != "default") $stmt->bindValue("id", $_GET["categorie"], PDO::PARAM_INT);
$stmt->execute();
$fetch1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($fetch1 as $a)
{
    // sépare le titre de l'article depuis la bdd
    $split = explode(" - ", $a["article"]);
    // créé un nouvel article à chaque entrée dans la table "articles" de la bdd
    $article = new Article($split[0], $split[1], $a["id_utilisateur"], $a["id_categorie"]);

    // récupère le login de l'auteur et le nom de la catégorie
    $stmt = $connexion->prepare("SELECT * FROM articles WHERE id=:id");
    $stmt->bindValue("id", $a["id"]);
    $stmt->execute();
    $fetch2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // login
    $stmt = $connexion->prepare("SELECT * FROM utilisateurs WHERE id=:id");
    $stmt->bindValue("id", $fetch2[0]["id_utilisateur"]);
    $stmt->execute();
    $fetchLogin = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // catégorie
    $stmt = $connexion->prepare("SELECT * FROM categories WHERE id=:id");
    $stmt->bindValue("id", $fetch2[0]["id_categorie"]);
    $stmt->execute();
    $fetchCat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // effectue l'affichage inline pour chaque article
    $article->displayInline($a["id"], $fetchLogin[0]["login"], $fetchCat[0]["nom"]);
}

if(!isset($_GET["start"]))
{
    $_GET["start"] = 1;
}
?>

<div id="pagination">
    <?php
    if($page == 1)
    {
        ?>
        <a href="?start=<?php echo $page + 1 ?>">Page suivante</a>
        <?php
    }
    else
    {
        ?>
        <a href="?start=<?php echo $page - 1 ?>">Page précédente</a>
        <a href="?start=<?php echo $page + 1 ?>">Page suivante</a>
        <?php
    }
    ?>
</div>

<?php
include("footer.php");
?>