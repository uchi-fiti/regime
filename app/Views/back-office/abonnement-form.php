<section class="login-section">
  <div class="container-narrow">

    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2"><?= $abonnement ? 'Modifier l\'abonnement' : 'Nouvel abonnement' ?></h1>
      <p class="section-sub">
        <?= $abonnement ? 'Modifiez les informations de l\'abonnement.' : 'Ajoutez un nouvel abonnement.' ?>
      </p>
    </div>

    <div class="card-panel card-panel-centered">

      <form class="login-form"
            method="post"
            action="<?= $abonnement ? base_url('/back-office/abonnements/update/' . $abonnement['id']) : base_url('/back-office/abonnements/create') ?>">

        <?= csrf_field() ?>

        <!-- Label -->
        <div class="form-field">
          <label for="label">Nom de l'abonnement *</label>

          <input
            type="text"
            id="label"
            name="label"
            value="<?= $abonnement ? $abonnement['label'] : old('label') ?>"
            placeholder="Ex: Premium"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['label'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['label'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Prix -->
        <div class="form-field">
          <label for="prix">Prix ($) *</label>

          <input
            type="number"
            id="prix"
            name="prix"
            min="0"
            step="0.01"
            value="<?= $abonnement ? $abonnement['prix'] : old('prix') ?>"
            placeholder="Ex: 19.99"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['prix'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['prix'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Remise -->
        <div class="form-field">
          <label for="remise">Remise (0-1) *</label>

          <input
            type="number"
            id="remise"
            name="remise"
            min="0"
            max="1"
            step="0.01"
            value="<?= $abonnement ? $abonnement['remise'] : old('remise') ?>"
            placeholder="Ex: 0.10"
            required
          >

          <small style="color: var(--muted-foreground); margin-top: 0.25rem; display: block;">
            Entre 0 et 1 (0.10 = 10% de remise)
          </small>

          <?php if(isset($validation) && is_array($validation) && isset($validation['remise'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['remise'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Boutons -->
        <div class="form-buttons">

          <button type="submit"
                  class="btn btn-primary btn-full-width">
            <?= $abonnement ? 'Mettre à jour' : 'Créer' ?>
          </button>

          <a href="<?= base_url('/back-office/abonnements') ?>"
             class="btn btn-outline btn-full-width">
            Annuler
          </a>

        </div>

      </form>

    </div>
  </div>
</section>
