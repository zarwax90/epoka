<?php
include '../services/connexionBdd.php';
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
        <form method="POST" action="addC.php">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nom">Nom</label>
                    <input type="nom" placeholder="Nom" class="form-control" id="nom" name="nom">
                </div>
                <div class="form-group col-md-4">
                    <label for="prenom">Prénom</label>
                    <input type="text" placeholder="Prénom" class="form-control" id="prenom" name="prenom">
                </div>
                <div class="form-group col-md-4">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" placeholder="Mot de passe" class="form-control" id="mdp" name="mdp">
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="valide" id="valide" value="0">
                        <label class="form-check-label" for="valide">
                            Non
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="valide" id="valide" value="1">
                        <label class="form-check-label" for="valide">
                            Oui
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paye" id="paye" value="0">
                        <label class="form-check-label" for="paye">
                            Non
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paye" id="paye" value="1">
                        <label class="form-check-label" for="paye">
                            Oui
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Agence</label>
                    <select id="inputState" name="agence" class="form-control">
                        <?php
                        try {
                            $req = $db->prepare("SELECT * FROM agency");
                            $req->execute();
                        } catch (exception $e) {
                            die("Erreur de type " . $e->getMessage());
                        }
                        while ($donnees = $req->fetch()) {
                        ?>
                            <option value="<?php echo $donnees['id'] ?>"> <?php echo $donnees['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Responsable</label>
                    <select id="inputState" name="resp" class="form-control">
                            <?php
                            try {
                                $req = $db->prepare("SELECT * FROM user");
                                $req->execute();
                            } catch (exception $e) {
                                die("Erreur de type " . $e->getMessage());
                            }
                            while ($donnees = $req->fetch()) {
                            ?>
                                <option value="<?php echo $donnees['id'] ?>"> <?php echo $donnees['name'] . " " . $donnees['surname']; ?></option>
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