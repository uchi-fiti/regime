<section class="login-section">
  <div class="container-narrow">

    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2"><?= $sport ? 'Modifier le sport' : 'Nouveau sport' ?></h1>
      <p class="section-sub">
        <?= $sport ? 'Modifiez les informations du sport.' : 'Ajoutez un nouveau sport.' ?>
      </p>
    </div>

    <div class="card-panel card-panel-centered">

      <form class="login-form"
            method="post"
            action="<?= $sport ? base_url('back-office/sports/update/' . $sport['id']) : base_url('back-office/sports/create') ?>">

        <?= csrf_field() ?>

        <!-- Label -->
        <div class="form-field">
          <label for="label">Nom du sport *</label>

          <input
            type="text"
            id="label"
            name="label"
            value="<?= $sport ? $sport['label'] : old('label') ?>"
            placeholder="Ex: Natation"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['label'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['label'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Description -->
        <div class="form-field">
          <label for="description">Description *</label>

          <textarea
            id="description"
            name="description"
            placeholder="Décrivez ce sport..."
            rows="4"
            required
          ><?= $sport ? $sport['description'] : old('description') ?></textarea>

          <?php if(isset($validation) && is_array($validation) && isset($validation['description'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['description'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Calories par heure -->
        <div class="form-field">
          <label for="calories_par_heure">
            Calories brûlées par heure *
          </label>

          <input
            type="number"
            id="calories_par_heure"
            name="calories_par_heure"
            min="1"
            step="0.01"
            value="<?= $sport ? $sport['calories_par_heure'] : old('calories_par_heure') ?>"
            placeholder="Ex: 500"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['calories_par_heure'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['calories_par_heure'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Boutons -->
        <div class="form-buttons">

          <button type="submit"
                  class="btn btn-primary btn-full-width">
            <?= $sport ? 'Mettre à jour' : 'Créer' ?>
          </button>

          <a href="<?= base_url('back-office/sports') ?>"
             class="btn btn-outline btn-full-width">
            Annuler
          </a>

        </div>

      </form>

    </div>
  </div>
</section>
