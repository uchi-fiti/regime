<?php
  $balance = $balance ?? 0;
  $objectifLabel = $objectif_label ?? null;
  $taille = $taille ?? null;
  $poids = $poids ?? null;
  $valeurObjectif = $valeur_objectif ?? null;
  $imc = $imc ?? null;
  $abonnement = $abonnement ?? null;
  $programmeActif = $programme_actif ?? null;
  $objectifPoids = ($poids !== null && $valeurObjectif !== null)
    ? (float) $poids + (float) $valeurObjectif
    : null;
?>

<section id="profil" class="profile-bg">
  <div class="container-narrow">
    <div class="section-title">
      <span class="badge"><svg class="icon"><use href="#i-wallet"/></svg> Espace personnel</span>
      <h2 class="h2" style="margin-top:1rem">Mon profil</h2>
      <p class="section-sub">Gérez votre porte-monnaie KomGem et activez vos codes promo pour économiser sur vos prochains régimes.</p>
    </div>
    <div class="grid-2" style="margin-top:1.5rem">
      <div class="wallet-card">
        <div class="wallet-top">
          <div class="l"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-wallet"/></svg> Porte-monnaie</div>
          <svg class="icon" style="width:1.25rem;height:1.25rem;opacity:.8"><use href="#i-crown"/></svg>
        </div>
        <div class="wallet-balance"><div class="l">Solde disponible</div><div class="v"><span id="balance"><?= number_format((float) $balance, 2, '.', ' ') ?></span> €</div></div>
        <div class="wallet-bubble"></div>
      </div>
      <div class="code-card">
        <div class="head"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-sparkles"/></svg> Code promo</div>
        <h3>Inserer un code</h3>
        <p>Entrez votre code de reduction ou de parrainage pour crediter votre porte-monnaie.</p>
        <form class="code-form" id="code-form">
          <input type="text" id="code-input" placeholder="EX: GOLD15" autocomplete="off"/>
          <button type="submit">Valider</button>
        </form>
        <div id="msg"></div>
        <div class="history">
          <div class="history-title">Historique</div>
          <ul id="history"></ul>
        </div>
      </div>
    </div>
    <div class="grid-3 profile-grid">
      <div class="profile-card">
        <div class="profile-card-title">Objectif et IMC</div>
        <div class="profile-row"><span>Objectif actuel</span><strong><?= $objectifLabel ?: 'Aucun' ?></strong></div>
        <div class="profile-row"><span>Objectif poids</span><strong><?= $objectifPoids !== null ? number_format((float) $objectifPoids, 1, ',', ' ') . ' kg' : '—' ?></strong></div>
        <div class="profile-row"><span>Taille</span><strong><?= $taille !== null ? number_format((float) $taille, 0, ',', ' ') . ' cm' : '—' ?></strong></div>
        <div class="profile-row"><span>Poids</span><strong><?= $poids !== null ? number_format((float) $poids, 1, ',', ' ') . ' kg' : '—' ?></strong></div>
        <div class="profile-row"><span>IMC</span><strong><?= $imc !== null ? number_format((float) $imc, 1, ',', ' ') : '—' ?></strong></div>
      </div>
      <div class="profile-card">
        <div class="profile-card-title">Abonnement actif</div>
        <?php if (! empty($abonnement)): ?>
          <div class="profile-row"><span>Offre</span><strong><?= htmlspecialchars($abonnement['label'], ENT_QUOTES, 'UTF-8') ?></strong></div>
          <div class="profile-row"><span>Prix</span><strong><?= number_format((float) $abonnement['prix'], 0, ',', ' ') ?> Ar</strong></div>
          <div class="profile-row"><span>Remise</span><strong><?= number_format((float) $abonnement['remise'], 0, ',', ' ') ?> %</strong></div>
          <div class="profile-row"><span>Date</span><strong><?= htmlspecialchars($abonnement['date_achat'], ENT_QUOTES, 'UTF-8') ?></strong></div>
        <?php else: ?>
          <p class="profile-empty">Aucun abonnement actif.</p>
        <?php endif; ?>
      </div>
      <div class="profile-card">
        <div class="profile-card-title">Programme actif</div>
        <?php if (! empty($programmeActif)): ?>
          <div class="profile-row"><span>Regime</span><strong><?= htmlspecialchars($programmeActif['regime_label'], ENT_QUOTES, 'UTF-8') ?></strong></div>
          <div class="profile-row"><span>Sport</span><strong><?= $programmeActif['sport_label'] ? htmlspecialchars($programmeActif['sport_label'], ENT_QUOTES, 'UTF-8') : 'Aucun' ?></strong></div>
          <div class="profile-row"><span>Duree</span><strong><?= number_format((float) $programmeActif['duree'], 0, ',', ' ') ?> jours</strong></div>
          <div class="profile-row"><span>Prix</span><strong><?= number_format((float) $programmeActif['prix'], 0, ',', ' ') ?> Ar</strong></div>
          <div class="profile-row"><span>Date</span><strong><?= htmlspecialchars($programmeActif['date_commande'], ENT_QUOTES, 'UTF-8') ?></strong></div>
        <?php else: ?>
          <p class="profile-empty">Aucun programme actif.</p>
        <?php endif; ?>
      </div>
    </div>
    <div class="demo-codes">Codes de demo : <span>GOLD15</span> · <span>NUTRI50</span> · <span>ETE2026</span></div>
  </div>
</section>