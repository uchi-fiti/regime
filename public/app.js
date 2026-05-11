// KomGem – vanilla JS

// ---- IMC ----
const tailleEl = document.getElementById('taille');
const poidsEl = document.getElementById('poids');
const tailleVal = document.getElementById('taille-val');
const poidsVal = document.getElementById('poids-val');
const imcValue = document.getElementById('imc-value');
const imcCat = document.getElementById('imc-cat');
const genreToggle = document.getElementById('genre-toggle');

// Initialiser IMC seulement si les éléments existent
if (tailleEl && poidsEl && imcValue && imcCat) {
  function updateImc(){
    const t = +tailleEl.value, p = +poidsEl.value;
    tailleVal.textContent = t;
    poidsVal.textContent = p;
    const m = t/100;
    const imc = p/(m*m);
    imcValue.textContent = imc.toFixed(1);
    let label='Corpulence normale', cls='normal';
    if (imc < 18.5){ label='Insuffisance pondérale'; cls='warn'; }
    else if (imc < 25){ label='Corpulence normale'; cls='normal'; }
    else if (imc < 30){ label='Surpoids'; cls='warn'; }
    else { label='Obésité'; cls='danger'; }
    imcCat.textContent = label;
    imcCat.className = 'imc-cat '+cls;
  }
  tailleEl.addEventListener('input', updateImc);
  poidsEl.addEventListener('input', updateImc);
  if (genreToggle) {
    genreToggle.addEventListener('click', e=>{
      const b = e.target.closest('button[data-g]');
      if(!b) return;
      genreToggle.querySelectorAll('button').forEach(x=>x.classList.remove('active'));
      b.classList.add('active');
    });
  }
  updateImc();
}

// ---- Regimes ----
const regimesGrid = document.getElementById('regimes-grid');
if (regimesGrid) {
  const regimes = [
    { name:'Équilibre', duree:'4 semaines', prix:89, viande:30, poisson:40, volaille:30, popular:false },
    { name:'Minceur+', duree:'8 semaines', prix:159, viande:20, poisson:50, volaille:30, popular:true },
    { name:'Performance', duree:'12 semaines', prix:219, viande:35, poisson:30, volaille:35, popular:false },
  ];
  const ck = '<svg><use href="#i-check"/></svg>';
  regimesGrid.innerHTML = regimes.map(r=>`
    <div class="regime${r.popular?' popular':''}">
      ${r.popular?'<span class="popular-tag">⭐ Le plus choisi</span>':''}
      <h3>${r.name}</h3>
      <p class="sub">${r.duree}</p>
      <div class="price"><span class="num">${r.prix}€</span><span class="sub">/programme</span></div>
      <ul class="feat">
        <li>${ck} ${r.viande}% viande</li>
        <li>${ck} ${r.poisson}% poisson</li>
        <li>${ck} ${r.volaille}% volaille</li>
        <li>${ck} Suivi nutritionnel</li>
      </ul>
      <a href="/#cta"><button>Choisir ce régime</button></a>
    </div>
  `).join('');
}

// ---- Reviews ----
const reviewsWrap = document.getElementById('reviews');
if (reviewsWrap) {
  const reviews = [
    { name:'Sophie L.', text:"J'ai perdu 8 kg en 2 mois sans frustration. Les régimes sont vraiment équilibrés !", note:5 },
    { name:'Karim B.', text:"L'option Gold est rentabilisée dès le 2e programme. Le coaching est top.", note:5 },
    { name:'Émilie R.', text:"Enfin une appli qui s'adapte à moi et pas l'inverse. Je recommande à 100%.", note:5 },
  ];
  reviewsWrap.innerHTML = reviews.map(r=>`
    <div class="testi">
      <div class="stars">${'<svg><use href="#i-star"/></svg>'.repeat(r.note)}</div>
      <p>"${r.text}"</p>
      <div class="who"><div class="av"></div><div class="n">${r.name}</div></div>
    </div>
  `).join('');
}

// ---- Profile / Wallet ----
const balanceEl = document.getElementById('balance');
const histEl = document.getElementById('history');
const msgEl = document.getElementById('msg');
const codeForm = document.getElementById('code-form');
const codeInput = document.getElementById('code-input');

// Initialiser le wallet seulement si les éléments existent
if (balanceEl && histEl && codeForm && msgEl) {
  let history = [];
  const rawHistory = histEl.getAttribute('data-history');
  if (rawHistory) {
    try {
      const parsed = JSON.parse(rawHistory);
      if (Array.isArray(parsed)) {
        history = parsed;
      }
    } catch (_) {
      history = [];
    }
  }

  function renderHistory(){
    histEl.innerHTML = history.map(h=>`
      <li>
        <div class="item"><svg><use href="#i-check"/></svg>
          <span class="code">${h.code}</span>
          <span class="date">${h.date}</span>
        </div>
        <span class="amt">+${Number(h.amount).toFixed(0)} Ar</span>
      </li>
    `).join('');
  }
  function renderBalance(value){
    const num = Number(value);
    if (!Number.isNaN(num)) {
      balanceEl.textContent = num.toFixed(0);
    }
  }
  function showMsg(type, text){
    msgEl.innerHTML = `<div class="msg ${type}">${text}</div>`;
    setTimeout(()=>{ msgEl.innerHTML=''; }, 4000);
  }
  codeForm.addEventListener('submit', e=>{
    e.preventDefault();
    const key = codeInput.value.trim().toUpperCase();
    if (!key) return;

    fetch('/wallet/redeem', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ code: key })
    })
      .then(res => res.json().then(data => ({ ok: res.ok, data })))
      .then(({ ok, data }) => {
        if (!ok || data.status !== 'ok') {
          showMsg('error', data.message || 'Code invalide ou expiré.');
          return;
        }

        const movement = data.movement || { code: key, amount: 0, date: new Date().toLocaleDateString('fr-FR') };
        history.unshift(movement);
        renderHistory();
        renderBalance(data.balance);
        showMsg('success', data.message || `+${movement.amount} Ar credites sur votre porte-monnaie !`);
        codeInput.value = '';
      })
      .catch(() => {
        showMsg('error', 'Erreur de connexion.');
      });
  });
  renderHistory();
}
