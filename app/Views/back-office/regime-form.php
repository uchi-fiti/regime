<section class="login-section">
  <div class="container-narrow">

    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2"><?= $regime ? 'Modifier le régime' : 'Nouveau régime' ?></h1>
      <p class="section-sub">
        <?= $regime ? 'Modifiez les informations du régime.' : 'Ajoutez un nouveau régime alimentaire.' ?>
      </p>
    </div>

    <div class="card-panel card-panel-centered">

      <form class="login-form"
            method="post"
            action="<?= $regime ? base_url('back-office/regimes/update/' . $regime['id']) : base_url('back-office/regimes/create') ?>"
            enctype="multipart/form-data">

        <?= csrf_field() ?>

        <!-- Label -->
        <div class="form-field">
          <label for="label">Nom du régime *</label>

          <input
            type="text"
            id="label"
            name="label"
            value="<?= $regime ? $regime['label'] : old('label') ?>"
            placeholder="Ex: Régime Keto"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['label'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['label'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Pourcentage viande -->
        <div class="form-field">
          <label for="pourcentage_viande">
            Pourcentage viande (%) *
          </label>

          <input
            type="number"
            id="pourcentage_viande"
            name="pourcentage_viande"
            min="0"
            max="100"
            step="0.01"
            value="<?= $regime ? $regime['pourcentage_viande'] : old('pourcentage_viande') ?>"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['pourcentage_viande'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['pourcentage_viande'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Pourcentage poisson -->
        <div class="form-field">
          <label for="pourcentage_poisson">
            Pourcentage poisson (%) *
          </label>

          <input
            type="number"
            id="pourcentage_poisson"
            name="pourcentage_poisson"
            min="0"
            max="100"
            step="0.01"
            value="<?= $regime ? $regime['pourcentage_poisson'] : old('pourcentage_poisson') ?>"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['pourcentage_poisson'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['pourcentage_poisson'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Pourcentage volaille -->
        <div class="form-field">
          <label for="pourcentage_volaille">
            Pourcentage volaille (%) *
          </label>

          <input
            type="number"
            id="pourcentage_volaille"
            name="pourcentage_volaille"
            min="0"
            max="100"
            step="0.01"
            value="<?= $regime ? $regime['pourcentage_volaille'] : old('pourcentage_volaille') ?>"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['pourcentage_volaille'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['pourcentage_volaille'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Variation poids -->
        <div class="form-field">
          <label for="variation_poids_journalier">
            Variation poids journalier (kg) *
          </label>

          <input
            type="number"
            id="variation_poids_journalier"
            name="variation_poids_journalier"
            step="0.01"
            value="<?= $regime ? $regime['variation_poids_journalier'] : old('variation_poids_journalier') ?>"
            placeholder="Ex: -0.25"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['variation_poids_journalier'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['variation_poids_journalier'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Boutons -->
        <div class="form-buttons">

          <button type="submit"
                  class="btn btn-primary btn-full-width">
            <?= $regime ? 'Mettre à jour' : 'Créer' ?>
          </button>

          <a href="<?= base_url('back-office/regimes') ?>"
             class="btn btn-outline btn-full-width">
            Annuler
          </a>

        </div>

      </form>

    </div>
  </div>
</section>