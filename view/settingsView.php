<?php $title = 'Paramètres'; ?>

<?php ob_start(); ?>
<?php $datas = $cities->fetchAll(); ?>
<?php $datas2 = $distance->fetchAll(); ?>
<?php $datas3 = $settings->fetch(); ?>
<div class="container my-3">
    <h1>Paramétrage de l'application</h1>
    <div class="border border-primary border-2 rounded">
        <div class="row">
            <div class="col-md-9 left">
                <form method="POST" action="index.php?action=updateSettings" class="was-validated my-3 mx-3">
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
                        <div>Prix km : <strong><?= htmlspecialchars($datas3['priceKm']) ?></strong></div>
                        <div>Indemnité : <strong><?= htmlspecialchars($datas3['priceDay']) ?></strong></div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border border-primary border-2 rounded my-3">
        <form method="POST" action="index.php?action=distance" class="was-validated my-3 mx-3">
            <h2>Distance entre les villes</h2>
            <div class="input-group mb-3">
                <span class="input-group-text">De :</span>
                <input type="hidden" id="text1" name="text1" required>
                <input class="form-control" list="city1" id="ville1" placeholder="Choisir une ville..." required>
                <datalist id="city1">
                    <?php foreach ($datas as $data) {
                        echo ('<option id="' . $data['id'] . '" value="' . $data['city_name'] . '"> (' . $data['cp'] . ')');
                    } ?>
                </datalist>
                <span class="input-group-text">À :</span>
                <input type="hidden" id="text2" name="text2" required>
                <input class="form-control" list="city2" id="ville2" placeholder="Choisir une ville..." required>
                <datalist id="city2">
                    <?php foreach ($datas as $data) {
                        echo ('<option id="' . $data['id'] . '" value="' . $data['city_name'] . '"> (' . $data['cp'] . ')');
                    } ?>
                </datalist>
                <span class="input-group-text">Distance en km :</span>
                <input type="number" class="form-control" placeholder="" min="0" id="km" name="km" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
            <?php echo ($alert) ?>
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
                    <?php foreach ($datas2 as $data2) { ?>
                        <tr>
                            <td><?= htmlspecialchars($data2['city1']) ?></td>
                            <td><?= htmlspecialchars($data2['city2']) ?></td>
                            <td><?= htmlspecialchars($data2['Km']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="public/js/idVille.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>