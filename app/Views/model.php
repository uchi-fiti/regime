<?php
// La variable $page est passée par le contrôleur
$page = $page ?? 'home';
?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>KomGem — Votre régime sur mesure pour atteindre votre IMC idéal</title>
<meta name="description" content="KomGem vous aide à choisir le régime alimentaire et l'activité sportive adaptés à vos objectifs. Calculez votre IMC, suivez vos progrès et profitez de l'option Gold avec -15%." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
</head>
<body>

<!-- Reusable inline SVG icons via <symbol>/<use> -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-leaf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 4 13c0-7 6-9 17-9 0 11-2 17-9 17a7 7 0 0 1-2-.5"/><path d="M2 22 17 7"/></symbol>
    <symbol id="i-sparkles" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></symbol>
    <symbol id="i-star" viewBox="0 0 24 24"><path d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></symbol>
    <symbol id="i-trend-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></symbol>
    <symbol id="i-trend-up" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></symbol>
    <symbol id="i-heart-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/><path d="M3.22 12H9.5l.5-1 2 4 .5-2 .5-1h6.27"/></symbol>
    <symbol id="i-scale" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/></symbol>
    <symbol id="i-target" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></symbol>
    <symbol id="i-crown" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></symbol>
    <symbol id="i-wallet" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-2"/><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-4a2 2 0 1 1 0-4h4a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a2 2 0 0 1-2-2"/></symbol>
    <symbol id="i-apple" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/></symbol>
  </defs>
</svg>

<?php $user = session()->get('user'); ?>

<header class="nav">
  <div class="container nav-inner">
    <a href="<?= site_url('model?page=home') ?>" class="brand">
      <span class="brand-mark"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-leaf"/></svg></span>
      KomGem
    </a>
    <nav class="nav-links">
      <a href="<?= site_url('model?page=home') ?>">Accueil</a>
      <a href="<?= site_url('model?page=gold') ?>">Abonnements</a>
      <a href="<?= site_url('model?page=profil') ?>">Mon profil</a>
    </nav>
    <div class="nav-actions">
      <?php if (!empty($user) && !empty($user['nom'])): ?>
        <span class="btn-link">Bonjour <?= htmlspecialchars($user['nom'], ENT_QUOTES, 'UTF-8') ?></span>
      <?php else: ?>
        <a href="/connection" class="btn-link">Connexion</a>
        <a href="/inscription" class="btn btn-primary btn-sm">Inscription</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<!-- include de page -->
<?= view($page) ?>

<footer>
  <div class="container">
    <div class="foot-grid">
      <div>
        <div class="brand"><span class="brand-mark"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-leaf"/></svg></span> KomGem</div>
        <p>Votre partenaire nutrition, à vos côtés au quotidien.</p>
      </div>
      <div class="foot-col"><div class="t">Navigation</div><ul><li><a href="<?= site_url('model?page=home') ?>">Accueil</a></li><li><a href="<?= site_url('model?page=recommandation') ?>">Recommandations</a></li><li><a href="<?= site_url('model?page=gold') ?>">Abonnements</a></li><li><a href="<?= site_url('model?page=profil') ?>">Mon profil</a></li></ul></div>
    </div>
    <div class="copyright">© 2026 KomGem — Projet ITU S4 P18 <br> ETU003902 - ETU004025 - ETU004171</div>
  </div>
</footer>

<script src="<?= base_url('app.js') ?>"></script>
</body>
</html>
