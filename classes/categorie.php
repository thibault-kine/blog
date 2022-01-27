<?php
class Categorie
{
    private $id;
    public $nom;

    public function __construct()
    {
       
    }

    public function register($nom)
    {
        $this->nom = $nom;
        $host = "localhost";
        $dbname = "blog";

        $selectQ = "SELECT * FROM categories WHERE nom='$this->nom'";
        $insertQ = "INSERT INTO categories(nom) VALUES ('$this->nom')";

        try 
        {
            $connexion = new PDO(
                "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
                "root",
                ""
            );
        }
        catch(Exception $e)
        {
            die("Erreur: ".$e->getMessage());
        }

        $preparation = $connexion->prepare($selectQ);
        $preparation->execute();
        $fetch = $preparation->fetchAll();

        if(!empty($fetch))
        {
            echo "Une catégorie existe déjà sous ce nom.";
        }
        else
        {
            $preparation = $connexion->prepare($insertQ);
            $preparation->execute();
        }
        // récupérer l'id
        $preparation = $connexion->prepare("SELECT id FROM categories WHERE nom='$this->nom'");
        $preparation->execute();
        $fetch = $preparation->fetchAll();

        $this->id = $fetch[0]["id"];
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCatInfo() //sans param, retourne tableau avec info categories
    {
        $host = "localhost";
        $dbname = "blog";

        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        $selec = "SELECT * FROM `categories`";
        $nomart = $connexion -> prepare($selec);
        $nomart->execute();
        $cats = $nomart->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
            <table>
                <thead> 
                    <th>id</th>
                    <th>nom</th>
                </thead>
        <?php foreach($cats as $key=>$cat):?>
        
               <tbody>
                    <tr>
                    <td><?=$cat['id']?></td>
                    <td><?=$cat['nom']?></td>
                    <td><a href="?supprime=<?= $cat['id'] ?>">Supprimer</a></td>
                    <td><a href="formART.php?modifi=<?= $cat['id'] ?>">Modifier</a></td>
                    </tr>
                </tbody>
        <?php endforeach ?>
            </table>
<?php  
    }

    public function delete($id)
    {
        $host = "localhost";
        $dbname = "blog";

        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );

        $deleteQ = "DELETE  FROM categories WHERE id=:id";

        $preparation = $connexion->prepare($deleteQ);
        $preparation->bindValue(':id', $id, PDO::PARAM_INT);
        $preparation->execute();

        unset($this->id);
        unset($this->name);
    }

    public function updatenomcat($nom)
    {
        $host = "localhost";
        $dbname = "blog";
        $connexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname.";charset=utf8",
            "root",
            ""
        );
        $idget2=$_GET['modifi'];
        $updcat = "UPDATE categories SET nom = :nom WHERE id=:idget2";
        $prepa = $connexion->prepare($updcat);
        $prepa->bindValue(':nom', $nom, PDO::PARAM_STR);
        $prepa->bindValue(':idget2', $idget2, PDO::PARAM_INT);
        $prepa->execute();
    }
}

?>