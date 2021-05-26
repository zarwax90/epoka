<?php $title = 'Paiement'; ?>

<?php ob_start(); ?>
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
                <th scope="col">Statut</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            setlocale(LC_TIME, "fr_FR", "French");
            while ($data = $pay->fetch()) {
                $start = strftime("%A %d %B %G", strtotime($data['start']));
                $end = strftime("%A %d %B %G", strtotime($data['end']));

                $getManager = new GetManager();
                $price = $getManager->getPriceMission($data['id']);
            ?>
                <tr>
                    <td><?= htmlspecialchars($data['surname']) ?></td>
                    <td><?= htmlspecialchars($data['name']) ?></td>
                    <td><?= htmlspecialchars($start) ?></td>
                    <td><?= htmlspecialchars($end) ?></td>
                    <td><?= htmlspecialchars($data['city_name'] . " (" . $data['cp'] . ")") ?></td>
                    <td>
                        <?php if ($price != 'Distance non défini') { ?>
                            <?= htmlspecialchars($price) ?> <?php } ?>
                    </td>
                    <?php if ($data['validated'] == 0) {
                    } else if ($data['validated'] == 1) {
                        if ($data['payed'] == 0 and $price != 'Distance non défini') { ?>
                            <td>En attente</td>
                            <td>
                                <form action="index.php?action=updatePayment" method="POST">
                                    <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
                                    <button type="submit" class="btn btn-success btn-sm" name="valide" value="<?php echo $data['id'] ?>">Rembourser</button>
                                </form>
                            </td>
                        <?php } else if ($data['payed'] == 1) { ?>
                            <td>Remboursée</td>
                            <td>
                                <!-- <form action="index.php?action=cancelPayment" method="POST" onsubmit="if(confirm('Veuillez confirmer cette action d\'annulation')){return true;}else{return false;}">
                                    <button type="submit" class="btn btn-danger btn-sm" name="cancel" value="<?php echo $data['id'] ?>">Annuler</button>
                                </form> -->
                            </td>
                        <?php } else { ?>
                            <td>
                                <!-- <?php if ($price == 'Distance non défini') { ?>
                                    <a href="index.php?action=settings&idUser=<?= htmlspecialchars($data['idUser']) ?>&idVille=<?= htmlspecialchars($data['idVille']) ?>&ville=<?= htmlspecialchars($data['city_name']) ?>"><?= htmlspecialchars($price) ?></a>
                                <?php } ?> -->
                                <?= htmlspecialchars($price) ?>
                            </td>
                            <td></td>
                    <?php }
                    }  ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>