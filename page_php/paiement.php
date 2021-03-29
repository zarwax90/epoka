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
        if ($_SESSION['canPay'] == 1) {

            $req = $bdd->prepare("SELECT user.surname, user.name, cities.cp, cities.city_name, missions.id, missions.start, missions.end, missions.validated, missions.payed
                                    FROM missions, user, cities 
                                    WHERE missions.idDest = cities.id
                                    AND missions.idUser = user.id
                                    AND missions.validated = 1");

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
                        while ($data = $req->fetch()) {
                            // $req = $bdd->prepare("SELECT d.Km
                            // FROM distance d 
                            // JOIN cities v1 ON v1.id = d.idCity1 
                            // JOIN cities v2 ON v2.id = d.idCity2
                            // WHERE v1.id = 5404
                            // AND v2.id = 5262
                            // OR v1.id = 5262
                            // AND v2.id = 5404");

                            // $req->execute();

                            $start = strftime("%A %d %B %G", strtotime($data['start']));
                            $end = strftime("%A %d %B %G", strtotime($data['end']));
                        ?>
                            <tr>
                                <td><?php echo $data['surname'] ?></td>
                                <td><?php echo $data['name'] ?></td>
                                <td><?php echo $start ?></td>
                                <td><?php echo $end; ?></td>
                                <td><?php echo $data['city_name'] . " (" . $data['cp'] . ")" ?></td>
                                <td><?php echo "prix non défini" ?></td>
                                <td>
                                    <?php if ($data['validated'] == 0) {
                                    } else if ($data['validated'] == 1) {
                                        if ($data['payed'] == 0) {
                                    ?>
                                            <form action="../php/paie.php" method="POST">
                                                <button type="submit" class="btn btn-success btn-sm" name="valide" value="<?php echo $data['id'] ?>">Rembourser</button>
                                            </form>
                                    <?php
                                        } else if ($data['payed'] == 1) {
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