<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>KomGem — Recommandations</title>
<meta name="description" content="Découvrez vos recommandations de regimes personnalises." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
</head>
<body>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></symbol>
    <symbol id="i-sparkles" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></symbol>
  </defs>
</svg>

<section id="recommandation" class="recommandation-bg">
  <div class="container-narrow">
    <div class="section-title">
      <span class="badge"><svg class="icon"><use href="#i-sparkles"/></svg> Régimes recommandés</span>
      <h2 class="h2" style="margin-top:1rem">Choisissez votre programme</h2>
      <p class="section-sub">Découvrez nos régimes sur mesure, adaptés à vos objectifs et votre budget. Sélectionnez le programme qui vous convient et exportez votre plan d'action.</p>
    </div>

    <?php if (!empty($recommandations)): ?>
      <div class="grid-3">
        <?php foreach ($recommandations as $reco): ?>
          <div class="regime selectable-card" data-type="regime" data-id="<?= (int) ($reco['id_regime'] ?? 0) ?>" data-label="<?= htmlspecialchars($reco['label'] ?? 'Programme', ENT_QUOTES, 'UTF-8') ?>">
            <h3><?= htmlspecialchars($reco['label'] ?? 'Programme', ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="sub"><?= (int) ($reco['duree'] ?? 0) ?> jours</p>
            <div class="price">
              <span class="num price-num"><?= number_format((float) ($reco['prix'] ?? 0), 0, ',', ' ') ?> Ar</span>
            </div>
            <ul class="feat">
              <li><svg><use href="#i-check"/></svg> Programme adapte</li>
              <li><svg><use href="#i-check"/></svg> Duree ciblee</li>
              <li><svg><use href="#i-check"/></svg> Suivi nutritionnel</li>
            </ul>
            <div style="display:flex;gap:0.5rem;margin-top:1rem">
              <button class="btn btn-primary" style="flex:1" type="button">Sélectionner</button>
              <!-- <button class="btn btn-outline" style="flex:1">📥 PDF</button> -->
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="note" style="margin-top:2rem">
        <svg><use href="#i-check"/></svg> Aucune recommandation disponible pour le moment.
      </div>
    <?php endif; ?>

    <div class="note" style="margin-top:2rem">
      <svg><use href="#i-check"/></svg> Tous nos régimes incluent un suivi nutritionnel personnalisé et accès à notre communauté.
    </div>

    <div class="section-title" style="margin-top:3rem">
      <span class="badge"><svg class="icon"><use href="#i-sparkles"/></svg> Sports recommandés</span>
      <h2 class="h2" style="margin-top:1rem">Bougez avec un plan adapte</h2>
      <p class="section-sub">Choisissez un sport qui correspond a votre objectif pour accelerer vos resultats.</p>
    </div>

    <?php if (!empty($sports)): ?>
      <div class="grid-3">
        <?php foreach ($sports as $sport): ?>
          <div class="regime selectable-card" data-type="sport" data-id="<?= (int) ($sport['id_sport'] ?? 0) ?>" data-label="<?= htmlspecialchars($sport['label'] ?? 'Sport', ENT_QUOTES, 'UTF-8') ?>">
            <h3><?= htmlspecialchars($sport['label'] ?? 'Sport', ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="sub"><?= (int) ($sport['duree'] ?? 0) ?> jours</p>
            <div class="price">
              <span class="num price-num"><?= number_format((float) ($sport['variation'] ?? 0), 3, ',', ' ') ?> kg/j</span>
            </div>
            <ul class="feat">
              <li><svg><use href="#i-check"/></svg> Rythme progressif</li>
              <li><svg><use href="#i-check"/></svg> Objectif cible</li>
              <li><svg><use href="#i-check"/></svg> Routine accessible</li>
            </ul>
            <div style="display:flex;gap:0.5rem;margin-top:1rem">
              <button class="btn btn-primary" style="flex:1" type="button">Sélectionner</button>
              <!-- <button class="btn btn-outline" style="flex:1">📥 PDF</button> -->
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="note" style="margin-top:2rem">
        <svg><use href="#i-check"/></svg> Aucune recommandation sportive disponible pour le moment.
      </div>
    <?php endif; ?>
  </div>
</section>

<div class="floating-cta" id="floating-cta" aria-hidden="true">
  <a class="btn btn-primary" id="start-program" href="<?= site_url('confirmation-achat') ?>">Demarrer mon programme</a>
</div>

<style>
  .grid-3 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
    justify-content: center;
    justify-items: center;
  }

  .grid-3 .regime {
    width: 100%;
    max-width: 320px;
  }

  .price-num {
    font-size: 1.5rem;
  }

  .selectable-card {
    border: 3px solid #e5e7eb;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .selectable-card:hover {
    border-color: #6366f1;
    background: #f0f4ff;
  }

  .selectable-card.selected {
    border-color: #6366f1;
    background: #6366f1;
    color: #fff;
  }

  .selectable-card.selected .price-num,
  .selectable-card.selected .sub,
  .selectable-card.selected .feat {
    color: #fff;
  }

  .selectable-card.selected .feat li,
  .selectable-card.selected h3 {
    color: #fff;
  }

  .floating-cta {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease;
  }

  .floating-cta.show {
    opacity: 1;
    pointer-events: auto;
  }
</style>

<script>
  const cards = document.querySelectorAll('.selectable-card');
  const floatingCta = document.getElementById('floating-cta');
  const startProgramLink = document.getElementById('start-program');
  let selectedRegimeId = null;
  let selectedSportId = null;

  function updateCta() {
    if (selectedRegimeId || selectedSportId) {
      floatingCta.classList.add('show');
      floatingCta.setAttribute('aria-hidden', 'false');
    } else {
      floatingCta.classList.remove('show');
      floatingCta.setAttribute('aria-hidden', 'true');
    }

    const params = new URLSearchParams();
    if (selectedRegimeId) {
      params.set('regime', selectedRegimeId);
    }
    if (selectedSportId) {
      params.set('sport', selectedSportId);
    }

    const baseUrl = "<?= site_url('confirmation-achat') ?>";
    startProgramLink.href = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
  }

  cards.forEach((card) => {
    card.addEventListener('click', () => {
      const type = card.dataset.type;
      const isSelected = card.classList.contains('selected');

      if (type === 'regime') {
        document.querySelectorAll('.selectable-card[data-type="regime"]').forEach((node) => {
          node.classList.remove('selected');
        });
        if (!isSelected) {
          card.classList.add('selected');
          selectedRegimeId = card.dataset.id || null;
        } else {
          selectedRegimeId = null;
        }
      }

      if (type === 'sport') {
        document.querySelectorAll('.selectable-card[data-type="sport"]').forEach((node) => {
          node.classList.remove('selected');
        });
        if (!isSelected) {
          card.classList.add('selected');
          selectedSportId = card.dataset.id || null;
        } else {
          selectedSportId = null;
        }
      }

      updateCta();
    });
  });

  updateCta();
</script>

</body>
</html>
