<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>KomGem — Connexion</title>
<meta name="description" content="Connectez-vous à KomGem et retrouvez votre régime personnalisé." />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('styles.css') ?>" />
</head>
<body>

<svg width="0" height="0" class="svg-icons" aria-hidden="true">
  <defs>
    <symbol id="i-leaf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 4 13c0-7 6-9 17-9 0 11-2 17-9 17a7 7 0 0 1-2-.5"/><path d="M2 22 17 7"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></symbol>
    <symbol id="i-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></symbol>
    <symbol id="i-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></symbol>
  </defs>
</svg>


<section class="login-section">
  <div class="container-narrow">
    <div class="section-title">
      <h1 class="h2">Back office - KomGem</h1>
      <p class="section-sub">Accédez à votre profil et retrouvez toutes les fonctionnalités de gestion.</p>
    </div>

    <div class="card-panel card-panel-centered">
      <form id="login-form" class="login-form" method="post" action="/back-office/connection">
      <?= csrf_field() ?>  
      <div class="form-field">
          <label for="nom">Nom d'utilisateur *</label>
          <input type="text" id="nom" name="nom" value="admin" required>
          <span class="field-error-msg" id="nom-error"></span>
        </div>

        <!-- Mot de passe -->
        <div class="form-field">
          <label for="password">Mot de passe *</label>
          <div class="password-wrapper">
            <input type="password" id="password" name="password" value="1234" required placeholder="••••••••" autocomplete="current-password">
            <button type="button" class="toggle-password" id="toggle-password" title="Afficher le mot de passe">
              <svg class="toggle-password-icon"><use href="#i-eye"/></svg>
            </button>
          </div>
          <span class="field-error-msg" id="password-error"></span>
        </div>

        <!-- Checkbox Se souvenir -->
        <div class="checkbox-wrapper">
          <label class="checkbox-label">
            <input type="checkbox" id="remember" name="remember">
            <span>Se souvenir de moi</span>
          </label>
        </div>

        <!-- Bouton submit -->
        <button type="submit" class="btn btn-primary btn-full-width">Se connecter</button>
        
        <!-- Message d'erreur général -->
        <?php if (session()->getFlashdata('error')): ?>
          <div id="error-msg" class="form-message error show">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php else: ?>
          <div id="error-msg" class="form-message error">
            Nom d'utilisateur ou mot de passe incorrect
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</section>


<script>
const togglePasswordBtn = document.getElementById('toggle-password');
const passwordInput = document.getElementById('password');
const eyeIcon = togglePasswordBtn.querySelector('svg use');

// Toggle affichage/masquage mot de passe
togglePasswordBtn.addEventListener('click', (e) => {
  e.preventDefault();
  const type = passwordInput.type === 'password' ? 'text' : 'password';
  passwordInput.type = type;
  eyeIcon.setAttribute('href', type === 'password' ? '#i-eye' : '#i-eye-off');
});
</script>

</body>
</html>