<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KomGem</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        header h1 {
            font-size: 32px;
            margin-bottom: 5px;
        }

        header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .card h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #667eea;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 15px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-box .value {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-box .label {
            font-size: 14px;
            opacity: 0.9;
        }

        .gauge-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .gauge-chart {
            width: 200px;
            height: 200px;
        }

        .gauge-info {
            flex: 1;
        }

        .gauge-info .percentage {
            font-size: 28px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
        }

        .gauge-info p {
            margin: 8px 0;
            font-size: 14px;
            color: #666;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background-color: #f0f2f5;
            border-bottom: 2px solid #667eea;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #667eea;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .gender-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .gender-item {
            text-align: center;
            padding: 15px;
            background-color: #f0f2f5;
            border-radius: 8px;
        }

        .gender-item .percentage {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }

        .gender-item .label {
            font-size: 14px;
            color: #666;
        }

        .crosstab-wrapper {
            overflow-x: auto;
        }

        .crosstab-table {
            border-collapse: collapse;
            width: 100%;
            min-width: 600px;
        }

        .crosstab-table th,
        .crosstab-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: right;
        }

        .crosstab-table th {
            background-color: #667eea;
            color: white;
            font-weight: 600;
        }

        .crosstab-table td:first-child,
        .crosstab-table th:first-child {
            text-align: left;
            background-color: #f0f2f5;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: #999;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 24px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .chart-container {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>📊 Tableau de Bord KomGem</h1>
            <p>Suivi complet des statistiques et performances</p>
        </div>
    </header>

    <div class="container">
        <!-- 1. Statistiques des Objectifs -->
        <div class="dashboard-grid">
            <div class="card">
                <h2>📈 Objectifs des Utilisateurs</h2>
                <div class="chart-container">
                    <canvas id="objectifChart"></canvas>
                </div>
                <p style="font-size: 12px; color: #999; text-align: center;">
                    Distribution des 3 objectifs principaux
                </p>
            </div>

            <!-- 2. Performance des Régimes -->
            <div class="card">
                <h2>🍽️ Top 5 Régimes</h2>
                <div class="chart-container">
                    <canvas id="regimeChart"></canvas>
                </div>
                <p style="font-size: 12px; color: #999; text-align: center;">
                    Régimes les plus souscrits
                </p>
            </div>

            <!-- 3. État du Porte-monnaie et Codes -->
            <div class="card">
                <h2>💳 État des Codes de Recharge</h2>
                <div class="gauge-wrapper">
                    <div class="gauge-chart">
                        <canvas id="codesGaugeChart"></canvas>
                    </div>
                    <div class="gauge-info">
                        <div class="percentage"><?= $code_percentage ?>%</div>
                        <p><strong>Codes utilisés:</strong> <?= $used_codes ?>/<?= $total_codes ?></p>
                        <p><strong>Codes restants:</strong> <?= $unused_codes ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières validations de codes -->
        <div class="card full-width">
            <h2>📝 Dernières Transactions de Codes</h2>
            <div class="table-responsive">
                <?php if (!empty($last_codes_used)) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Code</th>
                                <th>Montant (Ar)</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($last_codes_used as $code) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($code['nom'] ?? 'N/A') ?></td>
                                    <td><strong><?= htmlspecialchars($code['code'] ?? 'N/A') ?></strong></td>
                                    <td><?= number_format($code['valeur'] ?? 0, 0, ',', ' ') ?> Ar</td>
                                    <td><?= $code['statut'] == 1 ? '✓ Utilisé' : '⊘ En attente' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="empty-state">
                        Aucune transaction enregistrée
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- 4. Analyse Utilisateurs -->
        <div class="dashboard-grid">
            <div class="card">
                <h2>👥 Répartition par Genre</h2>
                <div class="gender-stats">
                    <?php foreach ($gender_labels as $idx => $label) : ?>
                        <div class="gender-item">
                            <div class="percentage"><?= $gender_percentages[$idx] ?>%</div>
                            <div class="label"><?= htmlspecialchars($label) ?></div>
                            <div style="font-size: 12px; color: #999;">
                                <?= $gender_counts[$idx] ?> utilisateur(s)
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card">
                <h2>💎 Proportion Abonnement Gold</h2>
                <div class="chart-container">
                    <canvas id="goldChart"></canvas>
                </div>
                <div class="stats-row" style="margin-top: 15px;">
                    <div class="stat-box">
                        <div class="value"><?= $gold_users ?></div>
                        <div class="label">Avec Gold (15% remise)</div>
                    </div>
                    <div class="stat-box" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="value"><?= $non_gold_users ?></div>
                        <div class="label">Sans Gold</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Tableau Croisé Dynamique -->
        <div class="card full-width">
            <h2>📊 Suivi des Revenus (Tableau Croisé)</h2>
            <p style="font-size: 13px; color: #666; margin-bottom: 15px;">
                Chiffre d'affaires par régime et par mois (avec prise en compte des remises Gold)
            </p>
            <div class="crosstab-wrapper">
                <?php if (!empty($months) && !empty($regimes_list)) : ?>
                    <table class="crosstab-table">
                        <thead>
                            <tr>
                                <th>Régime / Mois</th>
                                <?php foreach ($months as $month) : ?>
                                    <th><?= htmlspecialchars($month) ?></th>
                                <?php endforeach; ?>
                                <th style="background-color: #764ba2;">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $totals = array_fill_keys($months, 0);
                            foreach ($regimes_list as $regime) : 
                                $regime_total = 0;
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($regime) ?></td>
                                    <?php foreach ($months as $month) : 
                                        $revenue = $crosstab_data[$regime][$month] ?? 0;
                                        $regime_total += $revenue;
                                        $totals[$month] += $revenue;
                                    ?>
                                        <td><?= number_format($revenue, 0, ',', ' ') ?> Ar</td>
                                    <?php endforeach; ?>
                                    <td style="background-color: #f0f2f5; font-weight: bold;">
                                        <?= number_format($regime_total, 0, ',', ' ') ?> Ar
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr style="background-color: #667eea; color: white; font-weight: bold;">
                                <td>TOTAL GÉNÉRAL</td>
                                <?php 
                                $grand_total = 0;
                                foreach ($months as $month) : 
                                    $grand_total += $totals[$month];
                                ?>
                                    <td><?= number_format($totals[$month], 0, ',', ' ') ?> Ar</td>
                                <?php endforeach; ?>
                                <td><?= number_format($grand_total, 0, ',', ' ') ?> Ar</td>
                            </tr>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="empty-state">
                        Aucune donnée de revenus disponible
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    
    <script>
        // Couleurs personnalisées
        const primaryGradient = ['#667eea', '#764ba2', '#f093fb', '#4facfe', '#00f2fe'];
        const colors = {
            primary: '#667eea',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            light: '#f3f4f6'
        };

        // 1. Graphique des Objectifs (Pie Chart)
        const objectifCtx = document.getElementById('objectifChart')?.getContext('2d');
        if (objectifCtx) {
            new Chart(objectifCtx, {
                type: 'pie',
                data: {
                    labels: <?= json_encode($objectif_labels) ?>,
                    datasets: [{
                        data: <?= json_encode($objectif_counts) ?>,
                        backgroundColor: [
                            '#667eea',
                            '#764ba2',
                            '#f093fb'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 13 },
                                padding: 15,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }

        // 2. Graphique des Régimes (Bar Chart)
        const regimeCtx = document.getElementById('regimeChart')?.getContext('2d');
        if (regimeCtx) {
            new Chart(regimeCtx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($regime_labels) ?>,
                    datasets: [{
                        label: 'Nombre d\'abonnements',
                        data: <?= json_encode($regime_subscriptions) ?>,
                        backgroundColor: '#667eea',
                        borderColor: '#764ba2',
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                font: { size: 13 },
                                padding: 15
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        }

        // 3. Graphique Jauge des Codes
        const gaugeCtx = document.getElementById('codesGaugeChart')?.getContext('2d');
        if (gaugeCtx) {
            new Chart(gaugeCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Codes Utilisés', 'Codes Restants'],
                    datasets: [{
                        data: [<?= $used_codes ?>, <?= $unused_codes ?>],
                        backgroundColor: [
                            '#667eea',
                            '#e5e7eb'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 12 },
                                padding: 10
                            }
                        }
                    }
                }
            });
        }

        // 4. Graphique Gold (Donut Chart)
        const goldCtx = document.getElementById('goldChart')?.getContext('2d');
        if (goldCtx) {
            new Chart(goldCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Avec Gold (15%)', 'Sans Gold'],
                    datasets: [{
                        data: [<?= $gold_users ?>, <?= $non_gold_users ?>],
                        backgroundColor: [
                            '#667eea',
                            '#f5576c'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 13 },
                                padding: 15,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>