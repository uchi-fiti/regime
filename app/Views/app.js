// KomGem – vanilla JS

// ---- IMC ----
const tailleEl = document.getElementById('taille');
const poidsEl = document.getElementById('poids');
const tailleVal = document.getElementById('taille-val');
const poidsVal = document.getElementById('poids-val');
const imcValue = document.getElementById('imc-value');
const imcCat = document.getElementById('imc-cat');
const genreToggle = document.getElementById('genre-toggle');

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
genreToggle.addEventListener('click', e=>{
  const b = e.target.closest('button[data-g]');
  if(!b) return;
  genreToggle.querySelectorAll('button').forEach(x=>x.classList.remove('active'));
  b.classList.add('active');
});
updateImc();

// ---- Regimes ----
const regimes = [
  { name:'Équilibre', duree:'4 semaines', prix:89, viande:30, poisson:40, volaille:30, popular:false },
  { name:'Minceur+', duree:'8 semaines', prix:159, viande:20, poisson:50, volaille:30, popular:true },
  { name:'Performance', duree:'12 semaines', prix:219, viande:35, poisson:30, volaille:35, popular:false },
];
const ck = '<svg><use href="#i-check"/></svg>';
document.getElementById('regimes-grid').innerHTML = regimes.map(r=>`
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
      <li>${ck} Export PDF</li>
    </ul>
    <button>Choisir ce régime</button>
  </div>
`).join('');

// ---- Reviews ----
const reviews = [
  { name:'Sophie L.', text:"J'ai perdu 8 kg en 2 mois sans frustration. Les régimes sont vraiment équilibrés !", note:5 },
  { name:'Karim B.', text:"L'option Gold est rentabilisée dès le 2e programme. Le coaching est top.", note:5 },
  { name:'Émilie R.', text:"Enfin une appli qui s'adapte à moi et pas l'inverse. Je recommande à 100%.", note:5 },
];
document.getElementById('reviews').innerHTML = reviews.map(r=>`
  <div class="testi">
    <div class="stars">${'<svg><use href="#i-star"/></svg>'.repeat(r.note)}</div>
    <p>"${r.text}"</p>
    <div class="who"><div class="av"></div><div class="n">${r.name}</div></div>
  </div>
`).join('');

// ---- Profile / Wallet ----
let balance = 124.5;
let history = [
  { code:'BIENVENUE25', amount:25, date:'12/04/2026' },
  { code:'PARRAIN10', amount:10, date:'28/03/2026' },
];
const codes = { GOLD15:15, NUTRI50:50, ETE2026:20 };
const balanceEl = document.getElementById('balance');
const histEl = document.getElementById('history');
const msgEl = document.getElementById('msg');
const codeForm = document.getElementById('code-form');
const codeInput = document.getElementById('code-input');

function renderHistory(){
  histEl.innerHTML = history.map(h=>`
    <li>
      <div class="item"><svg><use href="#i-check"/></svg>
        <span class="code">${h.code}</span>
        <span class="date">${h.date}</span>
      </div>
      <span class="amt">+${h.amount} €</span>
    </li>
  `).join('');
}
function renderBalance(){ balanceEl.textContent = balance.toFixed(2); }
function showMsg(type, text){
  msgEl.innerHTML = `<div class="msg ${type}">${text}</div>`;
  setTimeout(()=>{ msgEl.innerHTML=''; }, 4000);
}
codeForm.addEventListener('submit', e=>{
  e.preventDefault();
  const key = codeInput.value.trim().toUpperCase();
  if (!key) return;
  if (codes[key]){
    const amount = codes[key];
    balance = +(balance + amount).toFixed(2);
    history.unshift({ code:key, amount, date:new Date().toLocaleDateString('fr-FR') });
    renderBalance(); renderHistory();
    showMsg('success', `+${amount} € crédités sur votre porte-monnaie !`);
    codeInput.value='';
  } else {
    showMsg('error', 'Code invalide ou expiré.');
  }
});
renderBalance(); renderHistory();
