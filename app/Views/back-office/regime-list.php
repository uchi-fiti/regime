<section class="login-section">
  <div class="container">
    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2">Liste des régimes</h1>
      <p class="section-sub">Gérez les régimes alimentaires disponibles sur KomGem.</p>
    </div>

    <!-- Messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="form-message success show" style="margin-bottom: 2rem;">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="form-message error show" style="margin-bottom: 2rem;">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- Bouton créer -->
    <div style="margin-bottom: 2rem;">
      <a href="<?= base_url('/back-office/regimes/create') ?>" class="btn btn-primary">
        + Nouveau régime
      </a>
    </div>

    <!-- Table des régimes -->
    <div style="background: var(--card); border-radius: var(--radius); border: 1px solid var(--border); overflow: hidden; box-shadow: var(--shadow-card);">
      
      <?php if (empty($regimes)): ?>
        <div style="padding: 2rem; text-align: center; color: var(--muted-foreground);">
          <p>Aucun régime trouvé. <a href="<?= base_url('/back-office/regimes/create') ?>" style="color: var(--primary); font-weight: 600;">Créer le premier</a></p>
        </div>
      <?php else: ?>
        
        <table style="width: 100%; border-collapse: collapse;">
          <thead>
            <tr style="background: var(--secondary); border-bottom: 1px solid var(--border);">
              <th style="padding: 1rem; text-align: left; font-weight: 600;">ID</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Nom</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Viande (%)</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Poisson (%)</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Volaille (%)</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Variation (kg)</th>
              <th style="padding: 1rem; text-align: center; font-weight: 600;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($regimes as $regime): ?>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 1rem;"><?= $regime['id'] ?></td>
                <td style="padding: 1rem; font-weight: 500;"><?= $regime['label'] ?></td>
                <td style="padding: 1rem;"><?= $regime['pourcentage_viande'] ?>%</td>
                <td style="padding: 1rem;"><?= $regime['pourcentage_poisson'] ?>%</td>
                <td style="padding: 1rem;"><?= $regime['pourcentage_volaille'] ?>%</td>
                <td style="padding: 1rem;"><?= $regime['variation_poids_journalier'] ?></td>
                <td style="padding: 1rem; text-align: center;">
                  <a href="<?= base_url('/back-office/regimes/edit/' . $regime['id']) ?>" class="btn btn-sm" style="background: var(--primary); color: var(--primary-foreground); margin-right: 0.5rem;">
                    Modifier
                  </a>
                  <a href="<?= base_url('/back-office/regimes/delete/' . $regime['id']) ?>" class="btn btn-sm" style="background: var(--destructive); color: white;" onclick="return confirm('Êtes-vous sûr ?')">
                    Supprimer
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      <?php endif; ?>

    </div>
  </div>
</section>
