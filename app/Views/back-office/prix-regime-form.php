<section class="login-section">
  <div class="container-narrow">

    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2"><?= $prixRegime ? 'Modifier le prix' : 'Nouveau prix régime' ?></h1>
      <p class="section-sub">
        <?= $prixRegime ? 'Modifiez le prix du régime.' : 'Ajoutez un nouveau prix régime.' ?>
      </p>
    </div>

    <div class="card-panel card-panel-centered">

      <form class="login-form"
            method="post"
            action="<?= $prixRegime ? base_url('/back-office/prix-regimes/update/' . $prixRegime['id']) : base_url('/back-office/prix-regimes/create') ?>">

        <?= csrf_field() ?>

        <!-- Sélection du régime -->
        <div class="form-field">
          <label for="id_regime">Régime *</label>

          <select
            id="id_regime"
            name="id_regime"
            required
          >
            <option value="">-- Sélectionner un régime --</option>
            <?php foreach ($regimes as $regime): ?>
              <option value="<?= $regime['id'] ?>" 
                <?= $prixRegime && $prixRegime['id_regime'] == $regime['id'] ? 'selected' : '' ?>>
                <?= $regime['label'] ?>
              </option>
            <?php endforeach; ?>
          </select>

          <?php if(isset($validation) && is_array($validation) && isset($validation['id_regime'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['id_regime'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Jour début -->
        <div class="form-field">
          <label for="jour_debut">Jour début *</label>

          <input
            type="number"
            id="jour_debut"
            name="jour_debut"
            min="1"
            value="<?= $prixRegime ? $prixRegime['jour_debut'] : old('jour_debut') ?>"
            placeholder="Ex: 1"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['jour_debut'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['jour_debut'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Jour fin -->
        <div class="form-field">
          <label for="jour_fin">Jour fin *</label>

          <input
            type="number"
            id="jour_fin"
            name="jour_fin"
            min="1"
            value="<?= $prixRegime ? $prixRegime['jour_fin'] : old('jour_fin') ?>"
            placeholder="Ex: 30"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['jour_fin'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['jour_fin'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Prix journalier -->
        <div class="form-field">
          <label for="prix_journalier">Prix journalier ($) *</label>

          <input
            type="number"
            id="prix_journalier"
            name="prix_journalier"
            min="0"
            step="0.01"
            value="<?= $prixRegime ? $prixRegime['prix_journalier'] : old('prix_journalier') ?>"
            placeholder="Ex: 5.99"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['prix_journalier'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['prix_journalier'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Boutons -->
        <div class="form-buttons">

          <button type="submit"
                  class="btn btn-primary btn-full-width">
            <?= $prixRegime ? 'Mettre à jour' : 'Créer' ?>
          </button>

          <a href="<?= base_url('/back-office/prix-regimes') ?>"
             class="btn btn-outline btn-full-width">
            Annuler
          </a>

        </div>

      </form>

    </div>
  </div>
</section>
