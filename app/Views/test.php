<div class="container mt-5">
    <h1>Résultats du Test</h1>
    
    <!-- Affichage des Infos de Santé -->
    <section class="mt-4">
        <h2>Informations de Santé</h2>
        <?php if (!empty($infos)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>ID Utilisateur</th>
                            <th>Taille (cm)</th>
                            <th>Poids (kg)</th>
                            <th>ID Objectif</th>
                            <th>Valeur Objectif</th>
                            <th>Date Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($infos as $info): ?>
                            <tr>
                                <td><?= $info['id'] ?></td>
                                <td><?= $info['id_user'] ?></td>
                                <td><?= $info['taille'] ?></td>
                                <td><?= $info['poids'] ?></td>
                                <td><?= $info['id_objectif'] ?></td>
                                <td><?= $info['valeur_objectif'] ?></td>
                                <td><?= $info['date_info'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Aucune information de santé trouvée.</div>
        <?php endif; ?>
    </section>

    <!-- Affichage des Recommandations -->
    <section class="mt-5">
        <h2>Recommandations</h2>
        <?php if (!empty($recommandations)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Régime</th>
                            <th>Durée (jours)</th>
                            <th>Prix Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recommandations as $reco): ?>
                            <tr>
                                <td><?= $reco['id_regime'] ?? 'N/A' ?></td>
                                <td><?= $reco['duree'] ?? 'N/A' ?></td>
                                <td><?= $reco['prix'] ?? '0' ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Aucune recommandation disponible.</div>
        <?php endif; ?>
    </section>
</div>
