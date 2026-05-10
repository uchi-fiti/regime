<section class="login-section">
  <div class="container-narrow">

    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2">Gestion des régimes</h1>
      <p class="section-sub">
        Ajoutez, modifiez et gérez les régimes alimentaires disponibles sur KomGem.
      </p>
    </div>

    <div class="card-panel card-panel-centered">

      <form class="login-form"
            method="post"
            action="<?= base_url('back-office/regime/create') ?>"
            enctype="multipart/form-data">

        <?= csrf_field() ?>

        <!-- Label -->
        <div class="form-field">
          <label for="label">Nom du régime *</label>

          <input
            type="text"
            id="label"
            name="label"
            value="<?= old('label') ?>"
            placeholder="Ex: Régime Keto"
          >

          <?php if(isset($validation) && $validation->hasError('label')) : ?>
            <span class="field-error-msg show">
              <?= $validation->getError('label') ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Photo -->
        <div class="form-field">
          <label for="photo">Photo du régime *</label>

          <input
            type="file"
            id="photo"
            name="photo"
            accept="image/*"
          >

          <?php if(isset($validation) && $validation->hasError('photo')) : ?>
            <span class="field-error-msg show">
              <?= $validation->getError('photo') ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Pourcentage viande -->
        <div class="form-field">
          <label for="pourcentage_viande">
            Pourcentage viande (%)
          </label>

          <input
            type="number"
            id="pourcentage_viande"
            name="pourcentage_viande"
            min="0"
            max="100"
            step="0.01"
            value="<?= old('pourcentage_viande') ?>"
          >

          <?php if(isset($validation) && $validation->hasError('pourcentage_viande')) : ?>
            <span class="field-error-msg show">
              <?= $validation->getError('pourcentage_viande') ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Pourcentage poisson -->
        <div class="form-field">
          <label for="pourcentage_poisson">
            Pourcentage poisson (%)
          </label>

          <input
            type="number"
            id="pourcentage_poisson"
            name="pourcentage_poisson"
            min="0"
            max="100"
            step="0.01"
            value="<?= old('pourcentage_poisson') ?>"
          >

          <?php if(isset($validation) && $validation->hasError('pourcentage_poisson')) : ?>
            <span class="field-error-msg show">
              <?= $validation->getError('pourcentage_poisson') ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Pourcentage volaille -->
        <div class="form-field">
          <label for="pourcentage_volaille">
            Pourcentage volaille (%)
          </label>

          <input
            type="number"
            id="pourcentage_volaille"
            name="pourcentage_volaille"
            min="0"
            max="100"
            step="0.01"
            value="<?= old('pourcentage_volaille') ?>"
          >

          <?php if(isset($validation) && $validation->hasError('pourcentage_volaille')) : ?>
            <span class="field-error-msg show">
              <?= $validation->getError('pourcentage_volaille') ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Variation poids -->
        <div class="form-field">
          <label for="variation_poids_journalier">
            Variation poids journalier (kg)
          </label>

          <input
            type="number"
            id="variation_poids_journalier"
            name="variation_poids_journalier"
            step="0.01"
            value="<?= old('variation_poids_journalier') ?>"
            placeholder="Ex: -0.25"
          >

          <?php if(isset($validation) && $validation->hasError('variation_poids_journalier')) : ?>
            <span class="field-error-msg show">
              <?= $validation->getError('variation_poids_journalier') ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Boutons -->
        <div style="display:flex; gap:1rem; flex-wrap:wrap">

          <button type="submit"
                  class="btn btn-primary"
                  style="flex:1">
            Enregistrer
          </button>

          <a href="<?= base_url('back-office/regimes') ?>"
             class="btn btn-outline"
             style="flex:1; text-align:center">
            Annuler
          </a>

        </div>

      </form>

    </div>
  </div>
</section>