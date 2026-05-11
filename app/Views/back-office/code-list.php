<section class="login-section">
  <div class="container">
    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2">Liste des codes de promotion</h1>
      <p class="section-sub">Gérez les codes de remise et de promotion.</p>
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
      <a href="<?= base_url('/back-office/codes/create') ?>" class="btn btn-primary">
        + Nouveau code
      </a>
    </div>

    <!-- Table des codes -->
    <div style="background: var(--card); border-radius: var(--radius); border: 1px solid var(--border); overflow: hidden; box-shadow: var(--shadow-card);">
      
      <?php if (empty($codes)): ?>
        <div style="padding: 2rem; text-align: center; color: var(--muted-foreground);">
          <p>Aucun code trouvé. <a href="<?= base_url('/back-office/codes/create') ?>" style="color: var(--primary); font-weight: 600;">Créer le premier</a></p>
        </div>
      <?php else: ?>
        
        <table style="width: 100%; border-collapse: collapse;">
          <thead>
            <tr style="background: var(--secondary); border-bottom: 1px solid var(--border);">
              <th style="padding: 1rem; text-align: left; font-weight: 600;">ID</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Code</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Remise</th>
              <th style="padding: 1rem; text-align: left; font-weight: 600;">Statut</th>
              <th style="padding: 1rem; text-align: center; font-weight: 600;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($codes as $c): ?>
              <tr style="border-bottom: 1px solid var(--border);">
                <td style="padding: 1rem;"><?= $c['id'] ?></td>
                <td style="padding: 1rem; font-weight: 600; font-family: monospace; color: var(--primary);"><?= strtoupper($c['code']) ?></td>
                <td style="padding: 1rem;">
                  <span style="background: oklch(0.58 0.16 145 / .1); color: var(--primary); padding: 0.375rem 0.75rem; border-radius: 999px; font-weight: 600; font-size: 0.875rem;">
                    <?= $c['valeur'] ?>%
                  </span>
                </td>
                <td style="padding: 1rem;">
                  <?php 
                    $statusColor = $c['statut'] == 'actif' ? 'oklch(0.58 0.16 145 / .1)' : ($c['statut'] == 'expire' ? 'oklch(0.6 0.22 27 / .1)' : 'oklch(0.96 0.03 130)');
                    $statusTextColor = $c['statut'] == 'actif' ? 'var(--primary)' : ($c['statut'] == 'expire' ? 'var(--destructive)' : 'var(--muted-foreground)');
                  ?>
                  <span style="background: <?= $statusColor ?>; color: <?= $statusTextColor ?>; padding: 0.375rem 0.75rem; border-radius: 999px; font-weight: 600; font-size: 0.875rem;">
                    <?= ucfirst($c['statut']) ?>
                  </span>
                </td>
                <td style="padding: 1rem; text-align: center;">
                  <a href="<?= base_url('/back-office/codes/edit/' . $c['id']) ?>" class="btn btn-sm" style="background: var(--primary); color: var(--primary-foreground); margin-right: 0.5rem;">
                    Modifier
                  </a>
                  <a href="<?= base_url('/back-office/codes/delete/' . $c['id']) ?>" class="btn btn-sm" style="background: var(--destructive); color: white;" onclick="return confirm('Êtes-vous sûr ?')">
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
