<section id="profil" class="profile-bg">
  <div class="container-narrow">
    <div class="section-title">
      <span class="badge"><svg class="icon"><use href="#i-wallet"/></svg> Espace personnel</span>
      <h2 class="h2" style="margin-top:1rem">Mon profil</h2>
      <p class="section-sub">Gérez votre porte-monnaie KomGem et activez vos codes promo pour économiser sur vos prochains régimes.</p>
    </div>
    <div class="grid-2">
      <div class="wallet-card">
        <div class="wallet-top">
          <div class="l"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-wallet"/></svg> Porte-monnaie</div>
          <svg class="icon" style="width:1.25rem;height:1.25rem;opacity:.8"><use href="#i-crown"/></svg>
        </div>
        <div class="wallet-balance"><div class="l">Solde disponible</div><div class="v"><span id="balance">124.50</span> €</div></div>
        <div class="wallet-actions"><button class="recharge">Recharger</button><button class="use">Utiliser</button></div>
        <div class="wallet-bubble"></div>
      </div>
      <div class="code-card">
        <div class="head"><svg class="icon" style="width:1.25rem;height:1.25rem"><use href="#i-sparkles"/></svg> Code promo</div>
        <h3>Insérer un code</h3>
        <p>Entrez votre code de réduction ou de parrainage pour créditer votre porte-monnaie.</p>
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
    <div class="demo-codes">Codes de démo : <span>GOLD15</span> · <span>NUTRI50</span> · <span>ETE2026</span></div>
  </div>
</section>