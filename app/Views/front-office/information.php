<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>NutriPlan — Informations sanitaires</title>
<meta name="description" content="Renseignez vos informations sanitaires pour un régime parfaitement adapté." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
</head>
<body>

<!-- Reusable inline SVG icons -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-leaf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 4 13c0-7 6-9 17-9 0 11-2 17-9 17a7 7 0 0 1-2-.5"/><path d="M2 22 17 7"/></symbol>
    <symbol id="i-check-circle" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></symbol>
  </defs>
</svg>


<section style="padding:4rem 1rem">
  <div class="container-narrow">
    
    <?php if (!empty($fromSignup)): ?>
      <div style="background:linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);color:white;padding:2rem;border-radius:12px;margin-bottom:3rem;text-align:center">
        <div style="font-size:1.125rem;margin-bottom:0.5rem">Bienvenue!</div>
        <h1 class="h2" style="color:white;margin:0">Vous etes maintenant inscrit</h1>
        <p style="margin-top:0.5rem;opacity:0.95">Vous allez etre en forme. Continuons ensemble!</p>
      </div>
    <?php else: ?>
      <div style="background:linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);color:white;padding:2rem;border-radius:12px;margin-bottom:3rem;text-align:center">
        <div style="font-size:1.125rem;margin-bottom:0.5rem">Mettre a jour</div>
        <h1 class="h2" style="color:white;margin:0">Vos informations sante</h1>
        <p style="margin-top:0.5rem;opacity:0.95">Ajoutez une nouvelle mesure pour suivre vos progres.</p>
      </div>
    <?php endif; ?>

    <div class="section-title" style="text-align:center;margin-bottom:2rem">
      <?php if (!empty($fromSignup)): ?>
        <span class="eyebrow">Etape 2</span>
      <?php endif; ?>
      <h2 class="h2">Vos données sanitaires</h2>
      <p class="section-sub">Renseignez votre taille et votre poids pour un calcul d'IMC précis.</p>
    </div>

    <div class="imc-card" style="max-width:500px;margin:0 auto">
      <form id="health-form" style="display:flex;flex-direction:column;gap:1.5rem">
        
        <!-- Taille -->
        <div class="field">
          <label for="height">Taille (m) *</label>
          <input type="number" id="height" name="height" required placeholder="1.70" max="2.50" step="0.01">
          <span class="error-msg" id="height-error"></span>
        </div>

        <!-- Poids -->
        <div class="field">
          <label for="weight">Poids (kg) *</label>
          <input type="number" id="weight" name="weight" required placeholder="70" max="300">
          <span class="error-msg" id="weight-error"></span>
        </div>

        <!-- Calcul IMC en temps réel -->
        <div style="padding:1rem;background:#f0f4ff;border-radius:8px;text-align:center;display:none" id="imc-preview">
          <div style="font-size:0.875rem;color:#666;margin-bottom:0.5rem">Votre IMC estimé</div>
          <div style="font-size:2rem;font-weight:700;color:#6366f1" id="preview-imc">--</div>
          <div style="font-size:0.875rem;color:#666;margin-top:0.5rem" id="preview-category">--</div>
        </div>

        <!-- Bouton submit -->
        <button type="submit" class="btn btn-primary" style="margin-top:1rem;width:100%">Valider mes informations</button>
        
        <!-- Message succès -->
        <div id="success-msg" style="display:none;padding:1.5rem;background:#e8f5e9;border-radius:8px;text-align:center">
          <svg class="icon" style="width:24px;height:24px;display:block;margin:0 auto 0.5rem;color:#2e7d32"><use href="#i-check-circle"/></svg>
          <div style="color:#2e7d32;font-weight:600">Données enregistrées!</div>
          <p style="font-size:0.875rem;color:#2e7d32;margin-top:0.5rem">Nous vous redirigeons vers l'étape suivante...</p>
        </div>
      </form>
    </div>
  </div>
</section>

<style>
.field { display: flex; flex-direction: column; gap: 0.5rem; }
.field label { font-weight: 500; color: #1a1a1a; }
.field input { padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s; }
.field input:focus { outline: none; border-color: #6366f1; }
.field input.error { border-color: #ef4444; }
.error-msg { display: none; font-size: 0.875rem; color: #ef4444; }
.error-msg.show { display: block; }
</style>

<script>
const form = document.getElementById('health-form');
const successMsg = document.getElementById('success-msg');
const heightInput = document.getElementById('height');
const weightInput = document.getElementById('weight');
const imcPreview = document.getElementById('imc-preview');
const previewImc = document.getElementById('preview-imc');
const previewCategory = document.getElementById('preview-category');
const submitUrl = "health/submit";
const redirectUrl = "choose-obj";

// Calcul IMC en temps réel
function calculateIMC() {
  const height = parseFloat(heightInput.value);
  const weight = parseFloat(weightInput.value);
  
  if (height > 0 && weight > 0) {
    const imc = weight / (height ** 2);
    previewImc.textContent = imc.toFixed(1);
    
    let category = '';
    if (imc < 18.5) category = 'Insuffisance pondérale';
    else if (imc < 25) category = 'Corpulence normale';
    else if (imc < 30) category = 'Surpoids';
    else category = 'Obésité';
    
    previewCategory.textContent = category;
    imcPreview.style.display = 'block';
  } else {
    imcPreview.style.display = 'none';
  }
}

heightInput.addEventListener('input', calculateIMC);
weightInput.addEventListener('input', calculateIMC);

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  
  const height = parseFloat(heightInput.value);
  const weight = parseFloat(weightInput.value);
  
  // Réinitialiser les erreurs
  document.querySelectorAll('.error-msg').forEach(el => el.classList.remove('show'));
  document.querySelectorAll('input').forEach(el => el.classList.remove('error'));
  
  let isValid = true;
  
  // Validation poids
  if (!weight || weight < 20 || weight > 300) {
    document.getElementById('weight-error').textContent = 'Veuillez entrer un poids valide (20-300 kg)';
    document.getElementById('weight-error').classList.add('show');
    weightInput.classList.add('error');
    isValid = false;
  }
  
  if (!isValid) {
    return;
  }

  try {
    const response = await fetch(submitUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ height, weight })
    });
    const result = await response.json();

    if (result.status === 'ok') {
      form.style.display = 'none';
      successMsg.style.display = 'block';

        window.location.href = result.redirect || redirectUrl;
      return;
    }

    if (result.errors) {
      if (result.errors.height) {
        document.getElementById('height-error').textContent = result.errors.height;
        document.getElementById('height-error').classList.add('show');
        heightInput.classList.add('error');
      }
      if (result.errors.weight) {
        document.getElementById('weight-error').textContent = result.errors.weight;
        document.getElementById('weight-error').classList.add('show');
        weightInput.classList.add('error');
      }
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
});
</script>

</body>
</html>
