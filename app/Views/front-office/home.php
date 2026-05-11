<?php $user = session()->get('user'); ?>

<section class="hero home-hero">
  <div class="container hero-grid">
    <div>
      <span class="badge"><svg class="icon"><use href="#i-sparkles"/></svg> Programme nutrition personnalisé</span>
      <h1 class="h1">Mangez mieux,<br/><span class="accent-text">vivez mieux.</span></h1>
      <p class="lede">Atteignez votre poids idéal sans frustration. KomGem analyse votre IMC et vous propose un régime équilibré et une activité sportive adaptés à vos objectifs.</p>
      <div class="cta-row"></div>
      <div class="social-proof">
        <div class="avatars"><span></span><span></span><span></span><span></span></div>
        <div>
          <div class="stars">
            <svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg>
          </div>
          <p style="font-size:.875rem;color:var(--muted-foreground)">+12 000 utilisateurs satisfaits</p>
        </div>
      </div>
    </div>
    <div class="hero-img-wrap">
      <img src="<?= base_url('assets/hero-meal.jpg') ?>" alt="Repas équilibré KomGem" width="1536" height="1152" class="hero-img"/>
      <div class="float-card bl">
        <div class="float-icon green"><svg style="width:24px;height:24px"><use href="#i-trend-down"/></svg></div>
        <div><div class="v">-7 kg</div><div class="l">en moyenne / 8 sem.</div></div>
      </div>
      <div class="float-card tr">
        <div class="float-icon orange"><svg style="width:24px;height:24px"><use href="#i-heart-pulse"/></svg></div>
        <div><div class="v">100% sain</div><div class="l">Validé nutritionniste</div></div>
      </div>
    </div>
  </div>
</section>

<section id="avis" style="padding-top:1rem">
  <div class="container-narrow">
    <div class="section-title"><h2 class="h2">Ils ont changé de vie</h2></div>
    <div class="grid-3">
      <div class="review-card">
        <div class="stars">
          <svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg>
        </div>
        <p>"J'ai perdu 6 kg en 2 mois sans frustration. Les repas sont simples et efficaces."</p>
        <div class="review-name">Tiana R.</div>
        <div class="review-meta">Programme Minceur</div>
      </div>
      <div class="review-card">
        <div class="stars">
          <svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg>
        </div>
        <p>"Je me sens plus en forme, et le suivi sportif m'a vraiment motivé."</p>
        <div class="review-name">Lina M.</div>
        <div class="review-meta">Programme Equilibre</div>
      </div>
      <div class="review-card">
        <div class="stars">
          <svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg><svg><use href="#i-star"/></svg>
        </div>
        <p>"Les recommandations sont claires. J'ai atteint mon IMC ideal plus vite que prevu."</p>
        <div class="review-name">Marc D.</div>
        <div class="review-meta">Programme IMC ideal</div>
      </div>
    </div>
  </div>
</section>

<?php if (empty($user)): ?>
<section id="cta" style="padding-top:0">
  <div class="container">
    <div class="cta-wrap">
      <svg><use href="#i-apple"/></svg>
      <h2>Commencez votre transformation aujourd'hui</h2>
      <p>Inscription en 2 minutes. Sans engagement. Premier bilan IMC offert.</p>
      <a href="/inscription"><button class="btn">Créer mon compte gratuitement</button></a>
    </div>
  </div>
</section>
<?php endif; ?>