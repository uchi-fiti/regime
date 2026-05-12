<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>KomGem — Choisir votre objectif</title>
<meta name="description" content="Sélectionnez votre objectif et commencez votre transformation avec KomGem." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
</head>
<body>

<?php
$imcAdjective = $imcAdjective ?? 'Corpulence normale';
$imcValue = $imcValue ?? 24.2;
$weight = $weight ?? 70;
$height = $height ?? 170;
$recommendedWeight = $recommendedWeight ?? 66;
$fromSignup = $fromSignup ?? false;
?>

<!-- Reusable inline SVG icons -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-leaf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 4 13c0-7 6-9 17-9 0 11-2 17-9 17a7 7 0 0 1-2-.5"/><path d="M2 22 17 7"/></symbol>
    <symbol id="i-trend-up" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></symbol>
    <symbol id="i-trend-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></symbol>
    <symbol id="i-target" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></symbol>
    <symbol id="i-sparkles" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></symbol>
  </defs>
</svg>

<section style="padding:4rem 1rem">
  <div class="container-narrow">
    
    <!-- Catégorie IMC -->
    <div style="text-align:center;margin-bottom:3rem">
      <div style="display:inline-block;padding:1rem 2rem;background:#f0f4ff;border-radius:12px;margin-bottom:1rem">
        <div style="font-size:0.875rem;color:#666;margin-bottom:0.5rem">Votre corpulence</div>
        <div style="font-size:1.5rem;font-weight:700;color:#6366f1" id="imc-category"><?= htmlspecialchars($imcAdjective, ENT_QUOTES, 'UTF-8') ?></div>
      </div>
    </div>

    <div class="section-title" style="text-align:center;margin-bottom:3rem">
      <?php if (!empty($fromSignup)): ?>
        <span class="eyebrow">Etape 3</span>
      <?php endif; ?>
      <h2 class="h2">Quel est votre objectif?</h2>
      <p class="section-sub">Nous vous recommandons un objectif adapté à votre profil.</p>
    </div>

    <!-- Grille des objectifs -->
    <div class="grid-3" style="margin-bottom:3rem" id="objectives-grid">
      <!-- Les boutons objectifs seront générés par JavaScript -->
    </div>

    <!-- Section d'entrée de valeur objectif -->
    <div class="imc-card" style="max-width:500px;margin:0 auto;display:none" id="target-input-section">
      <form id="objective-form" style="display:flex;flex-direction:column;gap:1.5rem">
        <div style="text-align:center">
          <h3 style="margin:0;margin-bottom:0.5rem" id="target-label">Votre objectif</h3>
          <p style="font-size:0.875rem;color:#666;margin:0" id="target-desc">Entrez la valeur désirée</p>
        </div>

        <div class="field">
          <label for="target-value" id="target-input-label">Poids cible (kg) *</label>
          <input type="number" id="target-value" name="target-value" required placeholder="70" min="20" max="300" step="0.1">
          <span class="error-msg" id="target-error"></span>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%">Voir mes recommandations</button>
      </form>
    </div>

    <!-- Recommandation -->
    <div style="padding:1.5rem;background:#fef3c7;border-left:4px solid #f59e0b;border-radius:8px;margin-top:2rem;display:none" id="recommendation-box">
      <div style="display:flex;gap:1rem;align-items:flex-start">
        <svg style="width:24px;height:24px;color:#f59e0b;flex-shrink:0;margin-top:0.25rem"><use href="#i-sparkles"/></svg>
        <div>
          <div style="font-weight:600;color:#92400e">Recommandation</div>
          <p style="margin:0.5rem 0 0;font-size:0.875rem;color:#78350f" id="recommendation-text">Nous recommandons de maintenir votre poids pour rester en bonne santé.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.objective-btn {
  padding: 1.5rem;
  border: 3px solid #e5e7eb;
  border-radius: 12px;
  background: white;
  cursor: pointer;
  transition: all 0.3s;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.objective-btn:hover {
  border-color: #6366f1;
  background: #f0f4ff;
}

.objective-btn.selected {
  border-color: #6366f1;
  background: #6366f1;
  color: white;
}

.objective-btn.selected svg {
  color: white;
}

.objective-icon {
  width: 48px;
  height: 48px;
  color: #6366f1;
}

.objective-btn.selected .objective-icon {
  color: white;
}

.objective-title {
  font-weight: 600;
  font-size: 1.125rem;
}

.objective-desc {
  font-size: 0.875rem;
  color: #666;
}

.objective-btn.selected .objective-desc {
  color: rgba(255, 255, 255, 0.9);
}

.field { display: flex; flex-direction: column; gap: 0.5rem; }
.field label { font-weight: 500; color: #1a1a1a; }
.field input { padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s; }
.field input:focus { outline: none; border-color: #6366f1; }
.field input.error { border-color: #ef4444; }
.error-msg { display: none; font-size: 0.875rem; color: #ef4444; }
.error-msg.show { display: block; }
</style>

<script>
const objectivesGrid = document.getElementById('objectives-grid');
const targetInputSection = document.getElementById('target-input-section');
const recommendationBox = document.getElementById('recommendation-box');
const objectiveForm = document.getElementById('objective-form');
const targetValue = document.getElementById('target-value');
const saveObjectiveUrl = "<?= site_url('health/objective') ?>";
let selectedObjective = null;

// Données d'exemple (normalement viendrait du serveur)
let userData = {
  imc: <?= json_encode($imcValue) ?>,
  weight: <?= json_encode($weight) ?>,
  height: <?= json_encode($height) ?>,
  imcCategory: <?= json_encode($imcAdjective) ?>,
  recommendedWeight: <?= json_encode($recommendedWeight) ?>
};

// Déterminer la catégorie IMC
function getImcCategory(imc) {
  if (imc < 18.5) return 'Insuffisance pondérale';
  if (imc < 25) return 'Corpulence normale';
  if (imc < 30) return 'Surpoids';
  return 'Obésité';
}

function getRecommendation(imc) {
  if (imc < 18.5) return {
    title: 'Augmenter mon poids',
    text: 'Vous êtes en insuffisance pondérale. Nous recommandons une prise de masse progressive et saine.'
  };
  if (imc < 25) return {
    title: 'Maintenir mon poids',
    text: 'Vous êtes en bonne santé. Nous recommandons de maintenir votre poids actuel et une activité régulière.'
  };
  if (imc < 30) return {
    title: 'Réduire mon poids',
    text: 'Vous êtes en surpoids. Nous recommandons une perte de poids progressive pour atteindre votre IMC idéal.'
  };
  return {
    title: 'Réduire mon poids',
    text: 'Nous recommandons une perte de poids pour votre santé et bien-être.'
  };
}

// Données des objectifs
const objectives = [
  {
    id: 'gain',
    title: 'Augmenter mon poids',
    description: 'Prise de masse saine et progressive grâce à un régime hyperprotéiné équilibré.',
    icon: 'i-trend-up',
    inputLabel: 'Poids cible (kg) ',
    formula: (w) => w + 5
  },
  {
    id: 'loss',
    title: 'Réduire mon poids',
    description: 'Perdez du poids durablement sans privation, avec des repas savoureux.',
    icon: 'i-trend-down',
    inputLabel: 'Poids cible (kg)  ',
    formula: (w) => w - 5
  },
  {
    id: 'maintain',
    title: 'Atteindre mon IMC idéal',
    description: 'Stabilisez votre corpulence sur la zone verte recommandée par les experts.',
    icon: 'i-target',
    inputLabel: 'Poids cible (kg)',
    formula: (w) => userData.recommendedWeight
  }
];

// Afficher la catégorie IMC
document.getElementById('imc-category').textContent = userData.imcCategory || getImcCategory(userData.imc);

// Créer les boutons objectifs
objectives.forEach(obj => {
  const btn = document.createElement('button');
  btn.type = 'button';
  btn.className = 'objective-btn';
  btn.innerHTML = `
    <svg class="objective-icon"><use href="#${obj.icon}"/></svg>
    <div class="objective-title">${obj.title}</div>
    <div class="objective-desc">${obj.description}</div>
  `;
  
  btn.addEventListener('click', () => {
    selectedObjective = obj;
    // Déselectionner les autres
    document.querySelectorAll('.objective-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    
    // Afficher la section d'entrée
    targetInputSection.style.display = 'block';
    
    // Mettre à jour les labels
    document.getElementById('target-label').textContent = obj.title;
    document.getElementById('target-input-label').textContent = obj.inputLabel;
    
    // Calculer et préremplir la valeur recommandée
    const recommendedValue = obj.formula(userData.weight);
    targetValue.value = recommendedValue.toFixed(1);
    
    // Afficher la recommandation
    const rec = getRecommendation(userData.imc);
    if (rec.title === obj.title) {
      recommendationBox.style.display = 'block';
      document.getElementById('recommendation-text').textContent = rec.text;
    } else {
      recommendationBox.style.display = 'none';
    }
    
    // Scroll vers la section
    targetInputSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
  
  objectivesGrid.appendChild(btn);
});

// Gestion de la soumission du formulaire
objectiveForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  
  const targetVal = parseFloat(targetValue.value);
  const errorEl = document.getElementById('target-error');
  
  // Réinitialiser les erreurs
  errorEl.classList.remove('show');
  targetValue.classList.remove('error');
  
  // Validation
  if (!selectedObjective) {
    errorEl.textContent = 'Veuillez choisir un objectif.';
    errorEl.classList.add('show');
    return;
  }

  if (!targetVal || targetVal < 20 || targetVal > 300) {
    errorEl.textContent = 'Veuillez entrer une valeur valide (20-300 kg)';
    errorEl.classList.add('show');
    targetValue.classList.add('error');
    return;
  }
  
  try {
    const response = await fetch(saveObjectiveUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        objective_label: selectedObjective.title,
        objective_key: selectedObjective.id,
        target_value: targetVal
      })
    });

    const result = await response.json();
    if (response.ok && result.status === 'ok') {
      window.location.href = result.redirect || 'index.php#regimes';
      return;
    }

    if (result.errors && result.errors.target_value) {
      errorEl.textContent = result.errors.target_value;
      errorEl.classList.add('show');
      targetValue.classList.add('error');
    } else {
      errorEl.textContent = 'Impossible d\'enregistrer votre objectif.';
      errorEl.classList.add('show');
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
});
</script>

</body>
</html>
