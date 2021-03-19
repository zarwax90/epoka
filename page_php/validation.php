<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include("../navbar.php");
    $req = $bdd->prepare("SELECT user.id, user.nom, user.prenom, ville.cp, ville.vil_nom, mission.id, mission.debut, mission.fin, mission.validée, mission.payée 
    FROM mission, user, ville 
    WHERE mission.idDest = ville.id
    AND mission.idUser = user.id");
    $req->execute();

    // foreach ($req->fetchAll() as $ligne) {
    //     $output[] = array(
    //         'id' => $ligne['id'],
    //         'nom' => $ligne['nom'],
    //         'prenom' => $ligne['prenom'],
    //         'cp' => $ligne['cp'],
    //         'vil_nom' => $ligne['vil_nom'],
    //         'debut' => $ligne['debut'],
    //         'fin' => $ligne['fin'],
    //         'valide' => $ligne['nom'],
    //         'paye' => $ligne['nom']
    //     );
    // };
    // print_r($output);



    ?>
    <div class="container">
        <h1>Validation des missions</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom du salarié</th>
                    <th scope="col">Prénom du salarié</th>
                    <th scope="col">Début de la mission</th>
                    <th scope="col">Fin de la mission</th>
                    <th scope="col">Lieu de la mission</th>
                    <th scope="col">Validation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($donnees = $req->fetch()) {
                    setlocale(LC_TIME, "fr_FR", "French");
                    $debut = strftime("%A %d %B %G", strtotime($donnees['debut']));
                    $fin = strftime("%A %d %B %G", strtotime($donnees['fin']));
                ?>
                    <tr>
                        <td><?php echo $donnees['nom'] ?></td>
                        <td><?php echo $donnees['prenom'] ?></td>
                        <td><?php echo $debut ?></td>
                        <td><?php echo $fin; ?></td>
                        <td><?php echo $donnees['vil_nom'] . " (" . $donnees['cp'] . ")" ?></td>
                        <td>
                            <?php if ($donnees['validée'] == 0) {  ?>
                                <button type="button" class="btn btn-success btn-sm">Valider</button>
                            <?php } else if ($donnees['validée'] == 1) {
                                if ($donnees['payée'] == 0) {
                                    echo 'Validée';
                                } else if ($donnees['payée'] == 1) {
                                    echo 'Validée, Remboursée';
                                } ?>

                            <?php }  ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>