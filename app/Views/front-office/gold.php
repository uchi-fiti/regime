<?php
  $abonnements = $abonnements ?? [];
  $premiumColors = [
    '#d4a73c',
    '#1e40af',
    '#9333ea',
    '#b45309',
  ];
  shuffle($premiumColors);
?>

<section id="gold">
  <div class="container">
    <div class="section-title">
      <span class="badge"><svg class="icon"><use href="#i-crown"/></svg> Abonnements</span>
      <h2 class="h2" style="margin-top:1rem">Choisissez votre abonnement premium</h2>
      <p class="section-sub">Bénéficiez de remises et d'avantages exclusifs sur tous vos programmes.</p>
    </div>

    <?php if (empty($abonnements)): ?>
      <div class="imc-card" style="margin-top:2.5rem;text-align:center">Aucun abonnement disponible.</div>
    <?php endif; ?>

    <?php foreach ($abonnements as $index => $abo): ?>
      <?php $color = $premiumColors[$index % count($premiumColors)]; ?>
      <div class="gold-wrap" style="margin-top:2.5rem;background: <?= htmlspecialchars($color, ENT_QUOTES, 'UTF-8') ?>">
        <div class="gold-grid">
          <div>
            <span class="gold-badge"><svg class="icon"><use href="#i-crown"/></svg> Abonnement premium</span>
            <h2 class="h2" style="margin-top:1.25rem">-<?= number_format((float) $abo['remise'], 0, ',', ' ') ?>% sur tous vos regimes</h2>
            <p style="margin-top:1rem;font-size:1.125rem;opacity:.85">
              Un paiement unique de <strong><?= number_format((float) $abo['prix'], 0, ',', ' ') ?> Ar</strong> et profitez de remises automatiques et d'un suivi privilegie.
            </p>
            <ul class="feat" style="margin-top:1.5rem">
              <li><svg><use href="#i-check"/></svg> Remise automatique sur les regimes</li>
              <li><svg><use href="#i-check"/></svg> Acces premium KomGem</li>
              <li><svg><use href="#i-check"/></svg> Paiement unique</li>
            </ul>
            <a class="btn btn-dark" style="margin-top:2rem" href="<?= site_url('confirmation-abonnement') ?>?abonnement=<?= (int) $abo['id'] ?>">Choisir <?= htmlspecialchars($abo['label'], ENT_QUOTES, 'UTF-8') ?></a>
          </div>
          <div>
            <div class="gold-card">
              <div class="top"><svg><use href="#i-crown"/></svg><span>PREMIUM</span></div>
              <div style="margin-top:1.5rem;font-family:var(--font-display);font-size:1.5rem"><?= htmlspecialchars($abo['label'], ENT_QUOTES, 'UTF-8') ?></div>
              <div style="font-size:.875rem;color:var(--muted-foreground);margin-top:.25rem">Avantages actifs a vie</div>
              <div class="gold-stats">
                <div class="stat"><div class="l">Remise</div><div class="v">-<?= number_format((float) $abo['remise'], 0, ',', ' ') ?>%</div></div>
                <div class="stat"><div class="l">Prix</div><div class="v"><?= number_format((float) $abo['prix'], 0, ',', ' ') ?> Ar</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>