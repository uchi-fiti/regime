<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>KomGem — Confirmation d'achat</title>
<meta name="description" content="Confirmez votre achat de regime." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
</head>
<body>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></symbol>
    <symbol id="i-alert" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3.04h16.94a2 2 0 0 0 1.71-3.04L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></symbol>
  </defs>
</svg>

<section style="padding:4rem 1rem">
  <div class="container-narrow">
    <div class="purchase-layout">
      <div class="purchase-left">
        <h1 class="h2" style="margin-bottom:1rem"><?= htmlspecialchars($regime['label'], ENT_QUOTES, 'UTF-8') ?></h1>

        <div class="imc-card" style="margin-bottom:1.5rem">
          <div style="font-weight:600;margin-bottom:0.75rem">Votre regime comporte</div>
          <div class="composition-bars">
            <div class="bar-row">
              <div class="bar-meta">
                <span class="bar-label">Volaille</span>
                <span class="bar-pct"><?= (float) $regime['pourcentage_volaille'] ?>%</span>
              </div>
              <div class="bar-track"><div class="bar-fill volaille" style="width:<?= (float) $regime['pourcentage_volaille'] ?>%"></div></div>
            </div>
            <div class="bar-row">
              <div class="bar-meta">
                <span class="bar-label">Viande</span>
                <span class="bar-pct"><?= (float) $regime['pourcentage_viande'] ?>%</span>
              </div>
              <div class="bar-track"><div class="bar-fill viande" style="width:<?= (float) $regime['pourcentage_viande'] ?>%"></div></div>
            </div>
            <div class="bar-row">
              <div class="bar-meta">
                <span class="bar-label">Poisson</span>
                <span class="bar-pct"><?= (float) $regime['pourcentage_poisson'] ?>%</span>
              </div>
              <div class="bar-track"><div class="bar-fill poisson" style="width:<?= (float) $regime['pourcentage_poisson'] ?>%"></div></div>
            </div>
          </div>
        </div>

        <div class="imc-card" style="margin-bottom:1.5rem">
          <?php
            $variation = (float) $regime['variation_poids_journalier'];
            $variationMensuelle = round(abs($variation) * 30, 1);
            $mois = (int) max(1, round($duree_jours / 30));
            $verbe = $variation < 0 ? 'perdre' : 'prendre';
          ?>
          <p>En seulement <strong><?= $mois ?> mois</strong>, vous allez <?= $verbe ?> <strong><?= $variationMensuelle ?> kg</strong>.</p>
        </div>

        <div class="imc-card" style="margin-bottom:1.5rem">
          <div style="font-size:0.875rem;color:#666">Prix</div>
          <div style="font-size:1.5rem;font-weight:700;color:#6366f1"><?= number_format((float) $prix, 0, ',', ' ') ?> Ar</div>
        </div>

        <?php if (!empty($error)): ?>
          <div class="note" style="color:#b91c1c;border-color:#ef4444">
            <svg><use href="#i-alert"/></svg> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
          <div class="note" style="color:#15803d;border-color:#22c55e">
            <svg><use href="#i-check"/></svg> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('confirmation-achat') ?>" style="margin-top:1.5rem">
          <input type="hidden" name="regime_id" value="<?= (int) $regime['id'] ?>">
          <input type="hidden" name="sport_id" value="<?= $sport ? (int) $sport['id'] : 0 ?>">
          <button type="submit" class="btn btn-primary" style="width:100%">Confirmer mon achat</button>
        </form>

        <a class="btn btn-outline" style="width:100%;margin-top:0.75rem" href="<?= site_url('model?page=home') ?>">Retour a l'accueil</a>

        <a class="btn btn-outline" style="width:100%;margin-top:0.75rem" href="<?= site_url('confirmation-achat/pdf') ?>?regime=<?= (int) $regime['id'] ?>&sport=<?= $sport ? (int) $sport['id'] : 0 ?>">Exporter PDF</a>
      </div>

      <div class="purchase-right">
        <div class="balance-card <?= $isFirstPurchase ? 'balance-free' : '' ?>">
          <div style="font-size:0.875rem;color:#666">Solde disponible</div>
          <?php if ($isFirstPurchase): ?>
            <div class="balance-value">Achat offert</div>
            <div class="balance-sub">Offre premier regime</div>
          <?php else: ?>
            <div class="balance-value"><?= number_format((float) $balance, 0, ',', ' ') ?> Ar</div>
          <?php endif; ?>
        </div>

        <div class="imc-card" style="margin-top:1.5rem">
          <div style="font-weight:600;margin-bottom:0.75rem">Sport choisi</div>
          <?php if (!empty($sport)): ?>
            <div><?= htmlspecialchars($sport['label'], ENT_QUOTES, 'UTF-8') ?></div>
          <?php else: ?>
            <div style="color:#666">Aucun sport selectionne</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .purchase-layout {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
    gap: 2rem;
  }

  .purchase-right {
    position: sticky;
    top: 2rem;
    align-self: start;
  }

  .balance-card {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: right;
  }

  .balance-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
  }

  .balance-sub {
    font-size: 0.85rem;
    color: #6b7280;
    margin-top: 0.35rem;
  }

  .balance-free {
    background: #7c6fe0;
    border-color: #7c6fe0;
    color: #fff;
  }

  .balance-free .balance-value,
  .balance-free .balance-sub {
    color: #fff;
  }

  .composition-bars {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .bar-row {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .bar-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .bar-label {
    font-size: 0.875rem;
    color: #374151;
  }

  .bar-pct {
    font-size: 0.875rem;
    font-weight: 600;
    color: #111827;
  }

  .bar-track {
    height: 6px;
    background: #eef2ff;
    border-radius: 999px;
    overflow: hidden;
  }

  .bar-fill {
    height: 100%;
    border-radius: 999px;
  }

  .bar-fill.volaille { background: #7c6fe0; }
  .bar-fill.viande { background: #e85d75; }
  .bar-fill.poisson { background: #3bbfad; }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.875rem;
    color: #374151;
    margin-top: 0.5rem;
  }

  .summary-row .key { color: #6b7280; }
  .summary-row .val { font-weight: 600; color: #111827; }

  .summary-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 0.75rem 0;
  }

  .summary-row.total .val { color: #7c6fe0; }

  @media (max-width: 960px) {
    .purchase-layout {
      grid-template-columns: 1fr;
    }

    .purchase-right {
      position: static;
    }
  }
</style>

</body>
</html>
