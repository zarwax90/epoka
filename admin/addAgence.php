<?php
include '../php/connexionBdd.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/dragon.png" />
    <title>Présentation</title>
</head>

<body>

    <div class="container">
        <form method="POST" action="addA.php">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nom">Nom</label>
                    <input type="nom" placeholder="Nom" class="form-control" id="nom" name="nom">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Ville</label>
                    <select id="inputState" name="ville" class="form-control">
                        <?php
                        try {
                            $req = $bdd->prepare("SELECT * FROM ville");
                            $req->execute();
                        } catch (exception $e) {
                            die("Erreur de type " . $e->getMessage());
                        }
                        while ($donnees = $req->fetch()) {
                        ?>
                            <option value="<?php echo $donnees['id'] ?>"> <?php echo "(" . $donnees['cp'] . ") " .  utf8_encode ($donnees['nom']) ; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>