<link rel="stylesheet" href="<?= base_url('dashboard.css') ?>">

<section class="dashboard-section">
    <div class="container">
        <!-- 1. Objectifs & Top 5 Régimes -->
        <div class="dashboard-grid dashboard-grid-2">
            <div class="dash-card">
                <h3>Objectifs</h3>
                <div class="chart-container">
                    <canvas id="objectifChart"></canvas>
                </div>
                <p>Distribution des objectifs</p>
            </div>
            <div class="dash-card">
                <h3>Top 5 Régimes</h3>
                <div class="chart-container">
                    <canvas id="regimeChart"></canvas>
                </div>
                <p>Régimes les plus souscrits</p>
            </div>
        </div>

        <!-- 2. Codes & Gold -->
        <div class="dashboard-grid dashboard-grid-2">
            <div class="dash-card">
                <h3>Codes de Recharge</h3>
                <div class="stat-flex">
                    <div class="chart-box sm">
                        <canvas id="codesGaugeChart"></canvas>
                    </div>
                    <div>
                        <div class="stat-value"><?= $code_percentage ?>%</div>
                        <div class="stat-label"><strong>Utilisés:</strong> <?= $used_codes ?>/<?= $total_codes ?></div>
                        <div class="stat-label"><strong>Restants:</strong> <?= $unused_codes ?></div>
                    </div>
                </div>
            </div>
            <div class="dash-card">
                <h3>Abonnement Gold</h3>
                <div class="stat-flex">
                    <div class="chart-box sm">
                        <canvas id="goldChart"></canvas>
                    </div>
                    <div style="flex: 1;">
                        <div class="stat-box"><?= $gold_users ?> Avec Gold</div>
                        <div class="stat-box alt" style="margin-top: 0.3rem;"><?= $non_gold_users ?> Sans Gold</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Dernières Transactions -->
        <div class="dash-card dashboard-grid-full">
            <h3>Dernières Transactions</h3>
            <div class="table-wrapper">
                <?php if (!empty($last_codes_used)) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Montant (Ar)</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($last_codes_used as $code) : ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($code['code'] ?? 'N/A') ?></strong></td>
                                    <td><?= number_format($code['valeur'] ?? 0, 0, ',', ' ') ?> Ar</td>
                                    <td><?= $code['statut'] == 1 ? '✓ Utilisé' : '⊘ En attente' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div style="text-align: center; padding: 1rem; color: var(--muted-foreground);">Aucune transaction</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- 4. Répartition par Genre -->
        <div class="dash-card">
            <h3>Répartition Genre</h3>
            <div class="gender-grid">
                <?php foreach ($gender_labels as $idx => $label) : ?>
                    <div class="gender-card">
                        <div class="pct"><?= $gender_percentages[$idx] ?>%</div>
                        <div class="name"><?= htmlspecialchars($label) ?></div>
                        <div class="count"><?= $gender_counts[$idx] ?> user(s)</div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 5. Tableau Croisé -->
        <div class="dash-card dashboard-grid-full">
            <h3>Revenus par Régime/Mois</h3>
            <div class="desc-small">Avec prise en compte des remises Gold (15%)</div>
            <div class="table-wrapper">
                <?php if (!empty($months) && !empty($regimes_list)) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Régime</th>
                                <?php foreach ($months as $month) : ?>
                                    <th><?= htmlspecialchars($month) ?></th>
                                <?php endforeach; ?>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $totals = array_fill_keys($months, 0);
                            foreach ($regimes_list as $regime) : 
                                $regime_total = 0;
                            ?>
                                <tr>
                                    <td class="table-header-alt"><strong><?= htmlspecialchars($regime) ?></strong></td>
                                    <?php foreach ($months as $month) : 
                                        $revenue = $crosstab_data[$regime][$month] ?? 0;
                                        $regime_total += $revenue;
                                        $totals[$month] += $revenue;
                                    ?>
                                        <td style="text-align: right;"><?= number_format($revenue, 0, ',', ' ') ?></td>
                                    <?php endforeach; ?>
                                    <td style="text-align: right; font-weight: bold; background: var(--secondary);">
                                        <?= number_format($regime_total, 0, ',', ' ') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-total">
                                <td>TOTAL GÉNÉRAL</td>
                                <?php 
                                $grand_total = 0;
                                foreach ($months as $month) : 
                                    $grand_total += $totals[$month];
                                ?>
                                    <td style="text-align: right;"><?= number_format($totals[$month], 0, ',', ' ') ?></td>
                                <?php endforeach; ?>
                                <td style="text-align: right;"><?= number_format($grand_total, 0, ',', ' ') ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div style="text-align: center; padding: 1rem; color: var(--muted-foreground);">Aucune donnée</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>

<!-- Dashboard Data for Charts -->
<script>
    window.dashboardData = {
        objectif_labels: <?= json_encode($objectif_labels) ?>,
        objectif_counts: <?= json_encode($objectif_counts) ?>,
        regime_labels: <?= json_encode($regime_labels) ?>,
        regime_subscriptions: <?= json_encode($regime_subscriptions) ?>,
        used_codes: <?= $used_codes ?>,
        unused_codes: <?= $unused_codes ?>,
        gold_users: <?= $gold_users ?>,
        non_gold_users: <?= $non_gold_users ?>
    };
</script>
<script src="<?= base_url('dashboard.js') ?>"></script>