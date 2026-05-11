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

<header class="nav">
  <div class="container nav-inner">
    <a href="#" class="brand">
      <span class="brand-mark"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-leaf"/></svg></span>
      KomGem
    </a>
    <nav class="nav-links">
      <a href="#imc">Mon IMC</a>
      <a href="#objectifs">Objectifs</a>
      <a href="#regimes">Régimes</a>
      <a href="#activite">Activités</a>
    </nav>
    <div class="nav-actions">
      <a href="/connection" class="btn-link">Connexion</a>
      <a href="/inscription" class="btn btn-primary btn-sm">S'inscrire</a>
    </div>
  </div>
</header>

<section class="hero">
  <div class="container hero-grid">
    <div>
      <span class="badge"><svg class="icon"><use href="#i-sparkles"/></svg> Programme nutrition personnalisé</span>
      <h1 class="h1">Mangez mieux,<br/><span class="accent-text">vivez mieux.</span></h1>
      <p class="lede">Atteignez votre poids idéal sans frustration. KomGem analyse votre IMC et vous propose un régime équilibré et une activité sportive adaptés à vos objectifs.</p>
      <div class="cta-row">
        <a href="#imc" class="btn btn-primary">Calculer mon IMC</a>
        <a href="#regimes" class="btn btn-outline">Découvrir les régimes</a>
      </div>
      <div class="social-proof">
        <!-- <div class="avatars"><span></span><span></span><span></span><span></span></div>
        <div>
          <div class="stars">
            <svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg>
          </div>
          <p style="font-size:.875rem;color:var(--muted-foreground)">+12 000 utilisateurs satisfaits</p>
        </div> -->
      </div>
    </div>
    <div class="hero-img-wrap">
      <img src="assets/hero-meal.jpg" alt="Repas équilibré KomGem" width="1536" height="1152" class="hero-img"/>
      <!-- <div class="float-card bl">
        <div class="float-icon green"><svg style="width:24px;height:24px"><use href="#i-trend-down"/></svg></div>
        <div><div class="v">-7 kg</div><div class="l">en moyenne / 8 sem.</div></div>
      </div> -->
      <!-- <div class="float-card tr"> -->
        <!-- <div class="float-icon orange"><svg style="width:24px;height:24px"><use href="#i-heart-pulse"/></svg></div>
        <div><div class="v">100% sain</div><div class="l">Validé nutritionniste</div></div>
      </div> -->
    <!-- </div> -->
  </div>
</section>

<section id="imc">
  <div class="container-narrow">
    <div class="section-title">
      <span class="eyebrow">Étape 1</span>
      <h2 class="h2">Comprendre votre IMC</h2>
      <p class="section-sub">Découvrez les catégories d'IMC et trouvez la vôtre pour un programme adapté.</p>
    </div>
    <div class="grid-2" style="margin-bottom:2rem">
      <div class="imc-category" style="border-bottom:4px solid #3b82f6;border-right:4px solid #3b82f6;border-left:2px solid #3b82f6;border-top:1px solid #3b82f6;padding:1.5rem;background:rgba(59,130,246,0.05);border-radius:0.5rem">
        <div style="font-weight:600;color:#3b82f6;margin-bottom:0.5rem;font-size:1.1rem">IMC &lt; 18.5</div>
        <div style="margin-bottom:0.5rem;font-weight:500">Insuffisance pondérale</div>
        <div style="font-size:0.875rem;color:var(--muted-foreground)">Prise de masse recommandée</div>
      </div>
      <div class="imc-category" style="border-bottom:4px solid #10b981;border-right:4px solid #10b981;border-left:2px solid #10b981;border-top:1px solid #10b981;padding:1.5rem;background:rgba(16,185,129,0.05);border-radius:0.5rem">
        <div style="font-weight:600;color:#10b981;margin-bottom:0.5rem;font-size:1.1rem">IMC 18.5 - 24.9</div>
        <div style="margin-bottom:0.5rem;font-weight:500">Corpulence normale</div>
        <div style="font-size:0.875rem;color:var(--muted-foreground)">Poids idéal maintenu</div>
      </div>
      <div class="imc-category" style="border-bottom:4px solid #f59e0b;border-right:4px solid #f59e0b;border-left:2px solid #f59e0b;border-top:1px solid #f59e0b;padding:1.5rem;background:rgba(245,158,11,0.05);border-radius:0.5rem">
        <div style="font-weight:600;color:#f59e0b;margin-bottom:0.5rem;font-size:1.1rem">IMC 25 - 29.9</div>
        <div style="margin-bottom:0.5rem;font-weight:500">Surpoids</div>
        <div style="font-size:0.875rem;color:var(--muted-foreground)">Réduction recommandée</div>
      </div>
      <div class="imc-category" style="border-bottom:4px solid #ef4444;border-right:4px solid #ef4444;border-left:2px solid #ef4444;border-top:1px solid #ef4444;padding:1.5rem;background:rgba(239,68,68,0.05);border-radius:0.5rem">
        <div style="font-weight:600;color:#ef4444;margin-bottom:0.5rem;font-size:1.1rem">IMC ≥ 30</div>
        <div style="margin-bottom:0.5rem;font-weight:500">Obésité</div>
        <div style="font-size:0.875rem;color:var(--muted-foreground)">Suivi médical conseillé</div>
      </div>
    </div>
    <div style="text-align:center">
      <a href="#cta" class="btn btn-primary">Calculer votre IMC</a>
    </div>
  </div>
</section>

<section id="objectifs" class="bg-soft">
  <div class="container-narrow">
    <div class="section-title">
      <span class="eyebrow">Étape 2</span>
      <h2 class="h2">Choisissez votre objectif</h2>
    </div>
    <div class="grid-3">
      <div class="obj"><div class="obj-icon"><svg><use href="#i-trend-up"/></svg></div><h3>Augmenter mon poids</h3><p>Prise de masse saine et progressive grâce à un régime hyperprotéiné équilibré.</p></div>
      <div class="obj"><div class="obj-icon"><svg><use href="#i-trend-down"/></svg></div><h3>Réduire mon poids</h3><p>Perdez du poids durablement sans privation, avec des repas savoureux.</p></div>
      <div class="obj"><div class="obj-icon"><svg><use href="#i-target"/></svg></div><h3>Atteindre mon IMC idéal</h3><p>Stabilisez votre corpulence sur la zone verte recommandée par les experts.</p></div>
    </div>
  </div>
</section>

<section id="regimes">
  <div class="container-narrow">
    <div class="section-title">
      <span class="eyebrow">Étape 3</span>
      <h2 class="h2">Nos régimes</h2>
      <p class="section-sub">Composés sur mesure : viande, poisson et volaille en parfait équilibre.</p>
    </div>
    <div class="grid-3">
      <?php foreach ($regimes as $r) { ?>
        
      <div class="regime">
        <h3><?= $r['label'] ?></h3>
        <!-- <p class="sub">4 semaines</p> -->
        <div class="price"><span class="num"><?= $r['variation_poids_journalier'] * 1000?>g</span><span class="sub">/jour</span></div>
        <ul class="feat">
          <li><svg><use href="#i-check"/></svg><?= $r['pourcentage_viande']?>% viande</li>
          <li><svg><use href="#i-check"/></svg><?= $r['pourcentage_poisson']?>% poisson</li>
          <li><svg><use href="#i-check"/></svg><?= $r['pourcentage_volaille']?>% volaille</li>
        </ul>
        <a href="/#cta"><button>Voir les details</button></a>
      </div>
    <?php } ?>
    </div>
    <div class="note">
      <svg><use href="#i-wallet"/></svg> Vous avez un code promo ? Rechargez votre porte-monnaie depuis votre compte.
    </div>
  </div>
</section>

<section id="activite" class="bg-soft">
  <div class="container-narrow act-grid">
    <img src="assets/coach.jpg" alt="Coach sportif KomGem" loading="lazy" width="1024" height="1280" class="coach"/>
    <div>
      <span class="eyebrow">Activité physique</span>
      <h2 class="h2">Bougez à votre rythme</h2>
      <p class="section-sub" style="text-align:left">Chaque programme est complété par une activité sportive adaptée à votre forme actuelle.</p>
      <div class="act-cards">
        <?php foreach ($sports as $s) { ?>
          <div class="act"><span class="emo"></span><div><div class="n"><?= $s['label']?></div></div></div>
        <?php } ?>
    </div>
  </div>
</section>

<!-- <section id="avis">
  <div class="container-narrow">
    <div class="section-title"><h2 class="h2">Ils ont changé de vie</h2></div>
    <div class="grid-3" id="reviews"></div>
  </div>
</section> -->

<section id="cta" style="padding-top:0">
  <div class="container">
    <div class="cta-wrap">
      <svg><use href="#i-apple"/></svg>
      <h2>Commencez votre transformation aujourd'hui</h2>
      <p>Inscription en 2 minutes. Sans engagement.</p>
      <a href="/inscription"><button class="btn">Créer mon compte gratuitement</button></a>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="foot-grid">
      <div>
        <div class="brand"><span class="brand-mark"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-leaf"/></svg></span> KomGem</div>
        <p>Votre partenaire nutrition, à vos côtés au quotidien.</p>
      </div>
      <div class="foot-col"><div class="t">IMC</div><ul><li><a href="#">Régimes</a></li><li><a href="#">Activités</a></li><li><a href="#">Connection</a></li><li><a href="#">Inscription</a></li></ul></div>
      
    </div>
    <div class="copyright">© 2026 KomGem — Projet ITU S4 P18 <br> ETU003902 - ETU004025 - ETU004171</div>


  </div>
</footer>

<script src="<?= base_url('app.js') ?>"></script>
</body>
</html>
