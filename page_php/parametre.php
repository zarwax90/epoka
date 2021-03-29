<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/dragon.png" />
    <title>Paramètre</title>
</head>

<body>
    <?php include("../navbar.php");

    $req = $bdd->prepare("SELECT * FROM ville WHERE cp LIKE '38%'");
    $req->execute();
    $donnees = $req->fetchAll();

    $req2 = $bdd->prepare("SELECT d.Km, v1.vil_nom AS ville1, v2.vil_nom AS ville2 
                            FROM distance d 
                            JOIN ville v1 ON v1.id = d.idVille1 
                            JOIN ville v2 ON v2.id = d.idVille2");
    $req2->execute();
    $donnees2 = $req2->fetchAll();

    $req3 = $bdd->prepare("SELECT * FROM parametre");
    $req3->execute();
    $donnees3 = $req3->fetch();
    ?>
    <div class="container my-3">
        <h1>Paramétrage de l'application</h1>
        <div class="border border-primary border-2 rounded">
            <div class="row">
                <div class="col-md-9 left">
                    <form method="POST" action="../php/prix.php" class="was-validated my-3 mx-3">
                        <h2>Montant du remboursement au km</h2>
                        <div class="row mb-3">
                            <label for="inputKm" class="col-sm-3 col-form-label">Remboursement au Km :</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="inputKm" name="inputKm" min="0.01" step="0.01" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputInd" class="col-sm-3 col-form-label">Indemnité hébergement :</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="inputInd" name="inputInd" min="0.01" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 right">
                    <div class="card my-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Paramètre actuel</h5>
                            <p class="card-text">
                                <div>Prix km : <strong><?php echo $donnees3['prixKm'] ?></strong></div>
                                <div>Indemnité : <strong><?php echo $donnees3['prixJournee'] ?></strong></div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border border-primary border-2 rounded my-3">
            <form method="POST" action="../php/distance.php" class="was-validated my-3 mx-3">
                <h2>Distance entre les villes</h2>
                <div class="input-group mb-3">
                    <span class="input-group-text">De :</span>
                    <input class="form-control" list="datalistOptions" id="ville1" name="ville1" placeholder="Choisir une ville..." required>
                    <datalist id="datalistOptions">
                        <?php foreach ($donnees as $donnee) {
                            echo ('<option value="' . $donnee['vil_nom'] . '"> (' . $donnee['cp'] . ')');
                        } ?>
                    </datalist>
                    <span class="input-group-text">À :</span>
                    <input class="form-control" list="datalistOptions" id="ville2" name="ville2" placeholder="Choisir une ville..." required>
                    <datalist id="datalistOptions">
                        <?php foreach ($donnees as $donnee) {
                            echo ('<option value="' . $donnee['vil_nom'] . '"> (' . $donnee['cp'] . ')');
                        } ?>
                    </datalist>
                    <span class="input-group-text">Distance en km :</span>
                    <input type="number" class="form-control" placeholder="" min="0" id="km" name="km" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>

        <div class="border border-primary border-2 rounded my-3">
            <div class="my-3 mx-3">
                <h2>Distance entre les villes déjà saisies</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">De</th>
                            <th scope="col">À</th>
                            <th scope="col">Km</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donnees2 as $donnee2) { ?>
                            <tr>
                                <td><?php echo  $donnee2['ville1'] ?></td>
                                <td><?php echo  $donnee2['ville2'] ?></td>
                                <td><?php echo  $donnee2['Km'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>