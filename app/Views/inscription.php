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
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
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
          <input type="text" id="fullname" name="fullname" required placeholder="Jean Dupont">
          <span class="error-msg" id="fullname-error"></span>
        </div>

        <!-- Email -->
        <div class="field">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" required placeholder="jean@exemple.com">
          <span class="error-msg" id="email-error"></span>
        </div>

        <!-- Genre -->
        <div class="field">
          <label>Genre *</label>
          <div class="radio-group" style="display:flex;gap:2rem">
            <label class="radio-label">
              <input type="radio" name="gender" value="M" required>
              <span>Homme</span>
            </label>
            <label class="radio-label">
              <input type="radio" name="gender" value="F" required>
              <span>Femme</span>
            </label>
            <label class="radio-label">
              <input type="radio" name="gender" value="other" required>
              <span>Autre</span>
            </label>
          </div>
          <span class="error-msg" id="gender-error"></span>
        </div>

        <!-- Mot de passe -->
        <div class="field">
          <label for="password">Mot de passe *</label>
          <input type="password" id="password" name="password" required placeholder="••••••••" minlength="8">
          <span class="info-msg">Minimum 8 caractères</span>
          <span class="error-msg" id="password-error"></span>
        </div>

        <!-- Confirmer mot de passe -->
        <div class="field">
          <label for="confirm-password">Confirmer le mot de passe *</label>
          <input type="password" id="confirm-password" name="confirm-password" required placeholder="••••••••">
          <span class="error-msg" id="confirm-password-error"></span>
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
        Déjà inscrit? <a href="index.php" style="color:#6366f1;text-decoration:none;font-weight:600">Retourner à l'accueil</a>
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
.error-msg { display: none; font-size: 0.875rem; color: #ef4444; }
.error-msg.show { display: block; }
.info-msg { font-size: 0.75rem; color: #666; }
.radio-group { margin-top: 0.5rem; }
.radio-label { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-weight: 400; }
.radio-label input { margin: 0; width: auto; }
</style>

<script>
const form = document.getElementById('signup-form');
const successMsg = document.getElementById('success-msg');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  
  // Récupérer les valeurs
  const fullname = document.getElementById('fullname').value.trim();
  const email = document.getElementById('email').value.trim();
  const gender = document.querySelector('input[name="gender"]:checked')?.value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;
  
  // Réinitialiser les erreurs
  document.querySelectorAll('.error-msg').forEach(el => el.classList.remove('show'));
  document.querySelectorAll('input').forEach(el => el.classList.remove('error'));
  
  let isValid = true;
  
  // Validation nom
  if (!fullname || fullname.length < 2) {
    document.getElementById('fullname-error').textContent = 'Veuillez entrer un nom valide';
    document.getElementById('fullname-error').classList.add('show');
    document.getElementById('fullname').classList.add('error');
    isValid = false;
  }
  
  // Validation email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!email || !emailRegex.test(email)) {
    document.getElementById('email-error').textContent = 'Email invalide';
    document.getElementById('email-error').classList.add('show');
    document.getElementById('email').classList.add('error');
    isValid = false;
  }
  
  // Validation genre
  if (!gender) {
    document.getElementById('gender-error').textContent = 'Veuillez sélectionner un genre';
    document.getElementById('gender-error').classList.add('show');
    isValid = false;
  }
  
  // Validation mot de passe
  if (password.length < 8) {
    document.getElementById('password-error').textContent = 'Le mot de passe doit avoir au moins 8 caractères';
    document.getElementById('password-error').classList.add('show');
    document.getElementById('password').classList.add('error');
    isValid = false;
  }
  
  // Validation confirmation
  if (password !== confirmPassword) {
    document.getElementById('confirm-password-error').textContent = 'Les mots de passe ne correspondent pas';
    document.getElementById('confirm-password-error').classList.add('show');
    document.getElementById('confirm-password').classList.add('error');
    isValid = false;
  }
  
  if (isValid) {
    // Simuler un appel AJAX
    try {
      // Dans une vraie app, faire un POST vers le serveur
      console.log({fullname, email, gender, password});
      
      // Afficher le succès
      form.style.display = 'none';
      successMsg.style.display = 'block';
      
      // Redirection après 2 secondes
      setTimeout(() => {
        window.location.href = 'information.php';
      }, 2000);
    } catch (error) {
      console.error('Erreur:', error);
    }
  }
});
</script>

</body>
</html>
