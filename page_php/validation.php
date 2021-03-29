<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/dragon.png" />
    <title>Validation</title>
</head>

<body>
    <?php require("../navbar.php");
    $req = $bdd->prepare("SELECT user.name, user.surname, cities.cp, cities.city_name, missions.id, missions.start, missions.end, missions.validated, missions.payed 
                            FROM missions, user, cities 
                            WHERE missions.idDest = cities.id
                            AND missions.idUser = user.id
                            AND user.idResponsible =" . $_SESSION['id']);
    $req->execute();
    ?>

    <div class="container my-3">
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

                setlocale(LC_TIME, "fr_FR", "French");
                while ($data = $req->fetch()) {
                    $start = strftime("%A %d %B %G", strtotime($data['start']));
                    $end = strftime("%A %d %B %G", strtotime($data['end']));
                ?>
                    <tr>
                        <td><?= htmlspecialchars($data['surname']) ?></td>
                        <td><?= htmlspecialchars($data['name']) ?></td>
                        <td><?= htmlspecialchars($start) ?></td>
                        <td><?= htmlspecialchars($end) ?></td>
                        <td><?= htmlspecialchars($data['city_name'] . " (" . $data['cp'] . ")" )?></td>
                        <td>
                            <?php if ($data['validated'] == 0) {  ?>
                                <form action="../php/valide.php" method="POST">
                                    <button type="submit" class="btn btn-success btn-sm" name="valide" value="<?php echo $data['id'] ?>">Valider</button>
                                </form>
                            <?php } else if ($data['validated'] == 1) {
                                if ($data['payed'] == 0) {
                                    echo 'Validée';
                                } else if ($data['payed'] == 1) {
                                    echo 'Validée, Remboursée';
                                }
                            }  ?>
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