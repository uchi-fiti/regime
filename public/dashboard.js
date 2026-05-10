// Dashboard Chart.js Configuration
(function() {
    // Configuration colors compatible avec le design
    const chartColors = {
        primary: getComputedStyle(document.documentElement).getPropertyValue('--primary').trim(),
        secondary: getComputedStyle(document.documentElement).getPropertyValue('--secondary').trim(),
        accent: getComputedStyle(document.documentElement).getPropertyValue('--accent').trim(),
        muted: getComputedStyle(document.documentElement).getPropertyValue('--muted').trim(),
        border: getComputedStyle(document.documentElement).getPropertyValue('--border').trim()
    };

    // Palette de couleurs pour les graphiques
    const colorPalette = [
        'oklch(0.58 0.16 145)',   // Primary
        'oklch(0.55 0.15 160)',   // Secondary primary
        'oklch(0.74 0.17 55)',    // Accent
        'oklch(0.62 0.16 150)',   // Variant 1
        'oklch(0.7 0.14 170)'     // Variant 2
    ];

    // Attendre que Chart.js soit chargé
    function initCharts() {
        if (typeof Chart === 'undefined') {
            setTimeout(initCharts, 100);
            return;
        }

        // 1. Graphique des Objectifs (Pie Chart)
        const objectifCtx = document.getElementById('objectifChart')?.getContext('2d');
        if (objectifCtx) {
            new Chart(objectifCtx, {
                type: 'pie',
                data: {
                    labels: window.dashboardData?.objectif_labels || [],
                    datasets: [{
                        data: window.dashboardData?.objectif_counts || [],
                        backgroundColor: colorPalette.slice(0, 3),
                        borderColor: 'var(--card)',
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
                                font: { size: 12, family: 'var(--font-sans)' },
                                padding: 12,
                                usePointStyle: true,
                                color: 'var(--foreground)'
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
                    labels: window.dashboardData?.regime_labels || [],
                    datasets: [{
                        label: 'Abonnements',
                        data: window.dashboardData?.regime_subscriptions || [],
                        backgroundColor: 'oklch(0.58 0.16 145)',
                        borderColor: 'oklch(0.55 0.15 160)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                font: { size: 12, family: 'var(--font-sans)' },
                                padding: 12,
                                color: 'var(--foreground)'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { 
                                stepSize: 1,
                                color: 'var(--muted-foreground)',
                                font: { size: 11 }
                            },
                            grid: {
                                color: 'var(--border)',
                                drawBorder: false
                            }
                        },
                        x: {
                            ticks: {
                                color: 'var(--muted-foreground)',
                                font: { size: 11 }
                            },
                            grid: {
                                display: false
                            }
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
                    labels: ['Utilisés', 'Restants'],
                    datasets: [{
                        data: [window.dashboardData?.used_codes || 0, window.dashboardData?.unused_codes || 0],
                        backgroundColor: [
                            'oklch(0.58 0.16 145)',
                            'oklch(0.96 0.03 130)'
                        ],
                        borderColor: 'var(--card)',
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
                                font: { size: 11, family: 'var(--font-sans)' },
                                padding: 8,
                                color: 'var(--foreground)'
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
                    labels: ['Avec Gold', 'Sans Gold'],
                    datasets: [{
                        data: [window.dashboardData?.gold_users || 0, window.dashboardData?.non_gold_users || 0],
                        backgroundColor: [
                            'oklch(0.78 0.14 85)',    // Gold
                            'oklch(0.6 0.22 27)'      // Destructive
                        ],
                        borderColor: 'var(--card)',
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
                                font: { size: 11, family: 'var(--font-sans)' },
                                padding: 8,
                                usePointStyle: true,
                                color: 'var(--foreground)'
                            }
                        }
                    }
                }
            });
        }
    }

    // Initialiser les graphiques au chargement du DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCharts);
    } else {
        initCharts();
    }
})();