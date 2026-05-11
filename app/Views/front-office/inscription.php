<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>KomGem — Inscription</title>
<meta name="description" content="Inscrivez-vous à KomGem et commencez votre transformation." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css" />
</head>
<body>

<!-- Reusable inline SVG icons -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="i-leaf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 4 13c0-7 6-9 17-9 0 11-2 17-9 17a7 7 0 0 1-2-.5"/><path d="M2 22 17 7"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></symbol>
    <symbol id="i-alert" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3.04h16.94a2 2 0 0 0 1.71-3.04L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></symbol>
  </defs>
</svg>

<section style="padding:6rem 1rem">
  <div class="container-narrow">
    <div class="section-title" style="text-align:center;margin-bottom:3rem">
      <h1 class="h2">Créez votre compte KomGem</h1>
      <p class="section-sub">Inscription en 2 minutes. Sans engagement.</p>
    </div>

    <div class="imc-card" style="max-width:500px;margin:0 auto">
      <form id="signup-form" style="display:flex;flex-direction:column;gap:1.5rem">
        
        <!-- Nom -->
        <div class="field">
          <label for="fullname">Nom complet *</label>
          <input type="text" id="fullname" name="nom" required placeholder="Jean Dupont">
          <span class="error-msg" id="nom-error"></span>
          <span class="valid-msg" id="nom-valid"><svg class="icon"><use href="#i-check"/></svg> Valide</span>
        </div>

        <!-- Email -->
        <div class="field">
          <label for="email">Email *</label>
          <input type="email" id="email" name="mail" required placeholder="jean@exemple.com">
          <span class="error-msg" id="mail-error"></span>
          <span class="valid-msg" id="mail-valid"><svg class="icon"><use href="#i-check"/></svg> Valide</span>
        </div>

        <!-- Genre -->
        <div class="field">
          <label>Genre *</label>
          <div class="radio-group" style="display:flex;gap:2rem">
            <label class="radio-label">
              <input type="radio" name="genre" value="M" required>
              <span>Homme</span>
            </label>
            <label class="radio-label">
              <input type="radio" name="genre" value="F" required>
              <span>Femme</span>
            </label>
            <label class="radio-label">
              <input type="radio" name="genre" value="other" required>
              <span>Autre</span>
            </label>
          </div>
          <span class="error-msg" id="genre-error"></span>
          <span class="valid-msg" id="genre-valid"><svg class="icon"><use href="#i-check"/></svg> Valide</span>
        </div>

        <!-- Mot de passe -->
        <div class="field">
          <label for="password">Mot de passe *</label>
          <input type="password" id="password" name="mdp" required placeholder="••••••••" minlength="8">
          <span class="info-msg">Minimum 8 caractères</span>
          <span class="error-msg" id="mdp-error"></span>
          <span class="valid-msg" id="mdp-valid"><svg class="icon"><use href="#i-check"/></svg> Valide</span>
        </div>

        <!-- Confirmer mot de passe -->
        <div class="field">
          <label for="confirm-password">Confirmer le mot de passe *</label>
          <input type="password" id="confirm-password" name="confirm_password" required placeholder="••••••••">
          <span class="error-msg" id="confirm_password-error"></span>
          <span class="valid-msg" id="confirm_password-valid"><svg class="icon"><use href="#i-check"/></svg> Valide</span>
        </div>

        <!-- Bouton submit -->
        <button type="submit" class="btn btn-primary" style="margin-top:1rem;width:100%">Créer mon compte</button>
        
        <!-- Message succès -->
        <div id="success-msg" style="display:none;padding:1rem;background:#e8f5e9;border-radius:8px;color:#2e7d32;text-align:center">
          <svg class="icon" style="width:20px;height:20px;display:inline;margin-right:0.5rem"><use href="#i-check"/></svg>
          Compte créé avec succès!
        </div>
      </form>

      <p style="text-align:center;margin-top:2rem;font-size:0.875rem;color:#666">
        Déjà inscrit? <a href="/connection" style="color:#6366f1;text-decoration:none;font-weight:600">se connecter</a>
      </p>
    </div>
  </div>
</section>

<style>
.field { display: flex; flex-direction: column; gap: 0.5rem; }
.field label { font-weight: 500; color: #1a1a1a; }
.field input { padding: 0.75rem; border: 2px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s; }
.field input:focus { outline: none; border-color: #6366f1; }
.field input.error { border-color: #ef4444; }
.field input.valid { border-color: #22c55e; }
.error-msg { display: none; font-size: 0.875rem; color: #ef4444; }
.error-msg.show { display: block; }
.valid-msg { display: none; font-size: 0.875rem; color: #15803d; align-items: center; gap: 0.25rem; }
.valid-msg.show { display: inline-flex; }
.valid-msg .icon { width: 16px; height: 16px; margin-right: 0.25rem; }
.info-msg { font-size: 0.75rem; color: #666; }
.radio-group { margin-top: 0.5rem; }
.radio-label { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-weight: 400; }
.radio-label input { margin: 0; width: auto; }
</style>

<script>
const form = document.getElementById('signup-form');
const successMsg = document.getElementById('success-msg');
const validateUrl = "/auth/validerChamp";
const submitUrl = "/auth/traiteInscription";
const redirectUrl = "/information";

const fieldConfig = {
  nom: { inputId: 'fullname', errorId: 'nom-error', validId: 'nom-valid' },
  mail: { inputId: 'email', errorId: 'mail-error', validId: 'mail-valid' },
  genre: { inputName: 'genre', errorId: 'genre-error', validId: 'genre-valid' },
  mdp: { inputId: 'password', errorId: 'mdp-error', validId: 'mdp-valid' },
  confirm_password: { inputId: 'confirm-password', errorId: 'confirm_password-error', validId: 'confirm_password-valid' }
};

const fieldOrder = ['nom', 'mail', 'genre', 'mdp', 'confirm_password'];

function getFieldValue(fieldName) {
  if (fieldName === 'genre') {
    return document.querySelector('input[name="genre"]:checked')?.value || '';
  }
  const config = fieldConfig[fieldName];
  return document.getElementById(config.inputId)?.value?.trim() || '';
}

function clearFieldState(fieldName) {
  const config = fieldConfig[fieldName];
  const input = config.inputId ? document.getElementById(config.inputId) : null;
  const errorEl = document.getElementById(config.errorId);
  const validEl = document.getElementById(config.validId);

  if (input) {
    input.classList.remove('error', 'valid');
  }
  if (errorEl) {
    errorEl.textContent = '';
    errorEl.classList.remove('show');
  }
  if (validEl) {
    validEl.classList.remove('show');
  }
}

function setFieldError(fieldName, message) {
  const config = fieldConfig[fieldName];
  const input = config.inputId ? document.getElementById(config.inputId) : null;
  const errorEl = document.getElementById(config.errorId);
  const validEl = document.getElementById(config.validId);

  if (input) {
    input.classList.add('error');
    input.classList.remove('valid');
  }
  if (errorEl) {
    errorEl.textContent = message;
    errorEl.classList.add('show');
  }
  if (validEl) {
    validEl.classList.remove('show');
  }
}

function setFieldValid(fieldName) {
  const config = fieldConfig[fieldName];
  const input = config.inputId ? document.getElementById(config.inputId) : null;
  const errorEl = document.getElementById(config.errorId);
  const validEl = document.getElementById(config.validId);

  if (input) {
    input.classList.remove('error');
    input.classList.add('valid');
  }
  if (errorEl) {
    errorEl.textContent = '';
    errorEl.classList.remove('show');
  }
  if (validEl) {
    validEl.classList.add('show');
  }
}

async function validateField(fieldName) {
  clearFieldState(fieldName);

  const value = getFieldValue(fieldName);
  const payload = {
    field: fieldName,
    value: value,
    password: getFieldValue('mdp'),
    confirm_password: getFieldValue('confirm_password')
  };

  try {
    const response = await fetch(validateUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const result = await response.json();

    if (result.status === 'ok') {
      setFieldValid(fieldName);
    } else {
      setFieldError(fieldName, result.message || 'Champ invalide');
    }
  } catch (error) {
    console.log("Error: " + error);
    setFieldError(fieldName, 'Erreur reseau, reessayez.');
  }
}

fieldOrder.forEach((fieldName) => {
  const config = fieldConfig[fieldName];
  if (fieldName === 'genre') {
    document.querySelectorAll('input[name="genre"]').forEach((radio) => {
      radio.addEventListener('change', () => validateField(fieldName));
    });
    return;
  }

  const input = document.getElementById(config.inputId);
  if (!input) {
    return;
  }
  input.addEventListener('blur', () => validateField(fieldName));
  input.addEventListener('input', () => clearFieldState(fieldName));
});

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  fieldOrder.forEach(clearFieldState);

  const payload = {
    nom: getFieldValue('nom'),
    mail: getFieldValue('mail'),
    genre: getFieldValue('genre'),
    mdp: getFieldValue('mdp'),
    confirm_password: getFieldValue('confirm_password')
  };

  try {
    const response = await fetch(submitUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const result = await response.json();

    if (result.status === 'ok') {
      form.style.display = 'none';
      successMsg.style.display = 'block';
      window.location.href = result.redirect || redirectUrl;
      return;
    }

    if (result.errors) {
      Object.entries(result.errors).forEach(([fieldName, message]) => {
        if (fieldConfig[fieldName]) {
          setFieldError(fieldName, message);
        }
      });
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
});
</script>

</body>
</html>
