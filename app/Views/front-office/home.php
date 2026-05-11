<?php $user = session()->get('user'); ?>

<section class="hero home-hero">
  <div class="container hero-grid">
    <div>
      <span class="badge"><svg class="icon"><use href="#i-sparkles"/></svg> Programme nutrition personnalisé</span>
      <h1 class="h1">Mangez mieux,<br/><span class="accent-text">vivez mieux.</span></h1>
      <p class="lede">Atteignez votre poids idéal sans frustration. KomGem analyse votre IMC et vous propose un régime équilibré et une activité sportive adaptés à vos objectifs.</p>
      <div class="cta-row"></div>
    </div>
    <div class="hero-img-wrap">
      <img src="<?= base_url('assets/hero-meal.jpg') ?>" alt="Repas équilibré KomGem" width="1536" height="1152" class="hero-img"/>
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