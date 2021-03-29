<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/dragon.png" />
    <title>Paiement</title>
</head>

<body>
    <?php
    include("../navbar.php");
    if (isset($_SESSION['id'])) {
        if ($_SESSION['peutPayer'] == 1) {

            $req = $bdd->prepare("SELECT user.nom, user.prenom, ville.cp, ville.vil_nom, mission.id, mission.debut, mission.fin, mission.validée, mission.payée 
                                    FROM mission, user, ville 
                                    WHERE mission.idDest = ville.id
                                    AND mission.idUser = user.id
                                    AND mission.validée = 1");

            $req->execute(); ?>
            <div class="container my-3">
                <h1>Paiement des missions</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nom du salarié</th>
                            <th scope="col">Prénom du salarié</th>
                            <th scope="col">Début de la mission</th>
                            <th scope="col">Fin de la mission</th>
                            <th scope="col">Lieu de la mission</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        setlocale(LC_TIME, "fr_FR", "French");
                        while ($donnees = $req->fetch()) {
                            // $req = $bdd->prepare("SELECT d.Km
                            // FROM distance d 
                            // JOIN ville v1 ON v1.id = d.idVille1 
                            // JOIN ville v2 ON v2.id = d.idVille2
                            // WHERE v1.id = 5404
                            // AND v2.id = 5262
                            // OR v1.id = 5262
                            // AND v2.id = 5404");

                            // $req->execute();

                            $debut = strftime("%A %d %B %G", strtotime($donnees['debut']));
                            $fin = strftime("%A %d %B %G", strtotime($donnees['fin']));
                        ?>
                            <tr>
                                <td><?php echo $donnees['nom'] ?></td>
                                <td><?php echo $donnees['prenom'] ?></td>
                                <td><?php echo $debut ?></td>
                                <td><?php echo $fin; ?></td>
                                <td><?php echo $donnees['vil_nom'] . " (" . $donnees['cp'] . ")" ?></td>
                                <td><?php echo "prix non défini" ?></td>
                                <td>
                                    <?php if ($donnees['validée'] == 0) {
                                    } else if ($donnees['validée'] == 1) {
                                        if ($donnees['payée'] == 0) {
                                    ?>
                                            <form action="../php/paie.php" method="POST">
                                                <button type="submit" class="btn btn-success btn-sm" name="valide" value="<?php echo $donnees['id'] ?>">Rembourser</button>
                                            </form>
                                    <?php
                                        } else if ($donnees['payée'] == 1) {
                                            echo 'Remboursée';
                                        }
                                    }  ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    <?php
        }
    }
    ?>

</body>

</html>