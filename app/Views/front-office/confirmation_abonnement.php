<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>KomGem — Confirmation abonnement</title>
<meta name="description" content="Confirmez votre abonnement." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
</head>
<body>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-crown" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></symbol>
  </defs>
</svg>

<section style="padding:4rem 1rem">
  <div class="container-narrow">
    <div class="imc-card" style="text-align:left;border:1px solid rgba(15,118,110,.15);background:linear-gradient(135deg,rgba(15,118,110,.08),rgba(212,167,60,.08))">
      <span class="badge" style="background:rgba(15,118,110,.1);color:#0f766e;border-color:rgba(15,118,110,.2)">
        <svg class="icon"><use href="#i-crown"/></svg> Abonnement premium
      </span>
      <h1 class="h2" style="margin:1rem 0 0.75rem">Confirmation abonnement</h1>
      <p style="color:var(--muted-foreground)">Merci de confirmer votre abonnement.</p>

      <?php if (!empty($success)): ?>
        <div class="note" style="color:#15803d;border-color:#22c55e;margin-top:1rem">
          <svg><use href="#i-check"/></svg> <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($error)): ?>
        <div class="note" style="color:#b91c1c;border-color:#ef4444;margin-top:1rem">
          <svg><use href="#i-check"/></svg> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>

      <div class="profile-row" style="margin-top:1.5rem">
        <span>Offre</span>
        <strong><?= htmlspecialchars($abonnement['label'], ENT_QUOTES, 'UTF-8') ?></strong>
      </div>
      <div class="profile-row">
        <span>Prix</span>
        <strong><?= number_format((float) $abonnement['prix'], 0, ',', ' ') ?> Ar</strong>
      </div>
      <div class="profile-row">
        <span>Remise</span>
        <strong><?= number_format((float) $abonnement['remise'], 0, ',', ' ') ?> %</strong>
      </div>

      <div style="margin-top:2rem;display:flex;gap:0.75rem;flex-wrap:wrap">
        <form method="post" action="<?= site_url('confirmation-abonnement') ?>" style="flex:1 1 200px">
          <?= csrf_field() ?>
          <input type="hidden" name="abonnement_id" value="<?= (int) $abonnement['id'] ?>">
          <button type="submit" class="btn btn-primary" style="width:100%">Confirmer l'abonnement</button>
        </form>
        <a class="btn btn-outline" href="<?= site_url('model?page=gold') ?>" style="flex:1 1 200px">Retour aux abonnements</a>
      </div>
    </div>
  </div>
</section>

</body>
</html>
