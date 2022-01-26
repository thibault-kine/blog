<?php
    include 'header.php';
    require 'classes/user.php';
    var_dump($_GET['modif']);

    $user = new User();
?>


<form action="" method="post">
    <label for="droit">Quel droits donne t'on à l'utilisateur selectionné</label>

        <div>
            <input type="radio" name="droit" value='42'>
            <label for="droit">Modérateur</label>
        </div>
        <div>
            <input type="radio" name="droit" value="1337">
            <label for="droit">Administrateur</label>
        </div>
        <div>
            <input type="radio" name="droit" value="1">
            <label for="droit">Utilisateur</label>
        </div>
            <input type="submit" name='submit' value="valider">
</form>
<?php
    if(isset($_POST['submit']))
    {
        $droits=$_POST['droit'];
        $user->updateidd($droits);
        echo "Modification validée.";
        var_dump($droits);
    }
?>