<?php
	$infos = $infos ?? [];
?>

<style>
	.cards-wrapper { display: flex; flex-direction: column; gap: 16px; padding: 1rem 0; }
	.health-card { background: var(--card); border: 1px solid var(--border); border-radius: 1rem; overflow: hidden; }
	.card-header { display: flex; align-items: center; justify-content: space-between; padding: 13px 18px; border-bottom: 1px solid var(--border); }
	.card-title { font-size: 13px; font-weight: 600; color: var(--muted-foreground); display: flex; align-items: center; gap: 6px; margin: 0; }
	.card-date { font-size: 12px; color: var(--muted-foreground); display: flex; align-items: center; gap: 5px; }
	.card-body { padding: 14px 18px 16px; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 10px; }
	.metric { background: var(--secondary); border-radius: 0.75rem; padding: 10px 12px; }
	.metric-label { font-size: 11px; color: var(--muted-foreground); text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 4px; }
	.metric-value { font-size: 20px; font-weight: 600; color: var(--foreground); margin: 0; line-height: 1.2; }
	.metric-unit { font-size: 12px; color: var(--muted-foreground); font-weight: 400; }
	.card-footer { display: flex; align-items: center; justify-content: space-between; padding: 11px 18px; border-top: 1px solid var(--border); }
	.objective-label { font-size: 11px; color: var(--muted-foreground); margin: 0 0 2px; text-transform: uppercase; letter-spacing: 0.05em; }
	.objective-text { font-size: 13px; color: var(--foreground); margin: 0; font-weight: 600; }
	.badge { display: flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 0.75rem; font-size: 13px; font-weight: 600; }
	.badge-gain { background: #e1f5ee; color: #085041; }
	.badge-loss { background: #faece7; color: #712b13; }
	.badge-maintain { background: #e6f1fb; color: #0c447c; }
	.empty-state { text-align: center; color: var(--muted-foreground); padding: 2rem 1rem; }
	@media (max-width: 768px) { .card-body { grid-template-columns: 1fr; } }
</style>

<div class="section-title" style="text-align:center;margin-bottom:1.5rem">
	<h2 class="h2">Historique infos sante & objectifs</h2>
	<p class="section-sub">Consultez l'historique de vos donnees et ajoutez un nouvel objectif.</p>
	<a href="<?= site_url('/information') ?>" class="btn btn-outline" style="margin-top:1rem">Ajouter un nouvel objectif</a>
</div>

<div class="cards-wrapper">
	<?php if (empty($infos)): ?>
		<div class="health-card">
			<div class="empty-state">Aucune information disponible.</div>
		</div>
	<?php endif; ?>

	<?php foreach ($infos as $info): ?>
		<?php
			$poids = (float) ($info['poids'] ?? 0);
			$taille = (float) ($info['taille'] ?? 0);
			$tailleM = $taille > 0 ? $taille / 100 : 0;
			$imc = $tailleM > 0 ? ($poids / ($tailleM * $tailleM)) : 0;
			$objectif = (float) ($info['valeur_objectif'] ?? 0);
			$badgeClass = 'badge-maintain';
			$badgeText = '0 kg';
			if ($objectif > 0) {
				$badgeClass = 'badge-gain';
				$badgeText = '+ ' . number_format($objectif, 0, '.', ' ') . ' kg';
			} elseif ($objectif < 0) {
				$badgeClass = 'badge-loss';
				$badgeText = '- ' . number_format(abs($objectif), 0, '.', ' ') . ' kg';
			}
			$dateInfo = ! empty($info['date_info']) ? date('d/m/Y', strtotime($info['date_info'])) : '';
		?>
		<div class="health-card">
			<div class="card-header">
				<p class="card-title">Informations de sante</p>
				<div class="card-date"><?= htmlspecialchars($dateInfo, ENT_QUOTES, 'UTF-8') ?></div>
			</div>
			<div class="card-body">
				<div class="metric">
					<p class="metric-label">Poids</p>
					<p class="metric-value"><?= number_format($poids, 1, '.', ' ') ?><span class="metric-unit"> kg</span></p>
				</div>
				<div class="metric">
					<p class="metric-label">Taille</p>
					<p class="metric-value"><?= number_format($tailleM, 2, '.', ' ') ?><span class="metric-unit"> m</span></p>
				</div>
				<div class="metric">
					<p class="metric-label">IMC</p>
					<p class="metric-value"><?= $imc > 0 ? number_format($imc, 1, '.', ' ') : '—' ?></p>
				</div>
			</div>
			<div class="card-footer">
				<div>
					<p class="objective-label">Objectif</p>
					<p class="objective-text"><?= htmlspecialchars((string) ($info['label'] ?? '—'), ENT_QUOTES, 'UTF-8') ?></p>
				</div>
				<div class="badge <?= $badgeClass ?>"><?= htmlspecialchars($badgeText, ENT_QUOTES, 'UTF-8') ?></div>
			</div>
		</div>
	<?php endforeach; ?>
</div>