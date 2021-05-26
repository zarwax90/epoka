<?php $title = 'Validation'; ?>

<?php ob_start(); ?>
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
                <th scope="col">Statut</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            setlocale(LC_TIME, "fr_FR", "French");
            while ($data = $valide->fetch()) {
                $start = strftime("%A %d %B %G", strtotime($data['start']));
                $end = strftime("%A %d %B %G", strtotime($data['end']));
            ?>
                <tr>
                    <td><?= htmlspecialchars($data['surname']) ?></td>
                    <td><?= htmlspecialchars($data['name']) ?></td>
                    <td><?= htmlspecialchars($start) ?></td>
                    <td><?= htmlspecialchars($end) ?></td>
                    <td><?= htmlspecialchars($data['city_name'] . " (" . $data['cp'] . ")") ?></td>

                    <?php if ($data['validated'] == 0) {  ?>
                        <td>En attente</td>
                        <td>
                            <form action="index.php?action=updateValidation" method="POST">
                                <button type="submit" class="btn btn-success btn-sm" name="valide" value="<?php echo $data['id'] ?>">Valider</button>
                            </form>
                        </td>
                        <?php } else if ($data['validated'] == 1) {
                        if ($data['payed'] == 0) { ?>
                            <td>Validée</td>
                            <td>
                                <form action="index.php?action=cancelValidation" method="POST" onsubmit="if(confirm('Veuillez confirmer cette action d\'annulation')){return true;}else{return false;}">
                                    <button type="submit" class="btn btn-danger btn-sm" name="cancel" value="<?php echo $data['id'] ?>">Annuler</button>
                                </form>
                            </td>
                        <?php } else if ($data['payed'] == 1) { ?>
                            <td>Validée, Remboursée</td>
                            <td></td>
                    <?php }
                    }  ?>

                    <td></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>