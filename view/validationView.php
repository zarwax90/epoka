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
                <th scope="col">Validation</th>
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
                    <td>
                        <?php if ($data['validated'] == 0) {  ?>
                            <form action="index.php?action=updateValidation" method="POST">
                                <button type="submit" class="btn btn-success btn-sm" name="valide" value="<?php echo $data['id'] ?>">Valider</button>
                            </form>
                            <?php } else if ($data['validated'] == 1) {
                            if ($data['payed'] == 0) { ?>
                                <form action="index.php?action=cancelValidation" method="POST">
                                    Validée
                                    <button type="submit" class="btn btn-danger btn-sm" name="cancel" value="<?php echo $data['id'] ?>">Annuler</button>
                                </form>
                        <?php
                            } else if ($data['payed'] == 1) {
                                echo 'Validée, Remboursée';
                            }
                        }  ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>