<section class="login-section">
  <div class="container-narrow">

    <div class="section-title">
      <span class="eyebrow">Administration</span>
      <h1 class="h2"><?= $code ? 'Modifier le code' : 'Nouveau code' ?></h1>
      <p class="section-sub">
        <?= $code ? 'Modifiez les informations du code de promotion.' : 'Ajoutez un nouveau code de promotion.' ?>
      </p>
    </div>

    <div class="card-panel card-panel-centered">

      <form class="login-form"
            method="post"
            action="<?= $code ? base_url('back-office/codes/update/' . $code['id']) : base_url('back-office/codes/create') ?>">

        <?= csrf_field() ?>

        <!-- Code -->
        <div class="form-field">
          <label for="code">Code de promotion *</label>

          <input
            type="text"
            id="code"
            name="code"
            value="<?= $code ? $code['code'] : old('code') ?>"
            placeholder="Ex: SUMMER2024"
            required
          >

          <?php if(isset($validation) && is_array($validation) && isset($validation['code'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['code'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Valeur -->
        <div class="form-field">
          <label for="valeur">Valeur (remise %) *</label>

          <input
            type="number"
            id="valeur"
            name="valeur"
            min="0"
            max="100"
            step="0.01"
            value="<?= $code ? $code['valeur'] : old('valeur') ?>"
            placeholder="Ex: 15"
            required
          >

          <small style="color: var(--muted-foreground); margin-top: 0.25rem; display: block;">
            Pourcentage de remise (0-100)
          </small>

          <?php if(isset($validation) && is_array($validation) && isset($validation['valeur'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['valeur'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Statut -->
        <div class="form-field">
          <label for="statut">Statut *</label>

          <select
            id="statut"
            name="statut"
            required
          >
            <option value="">-- Sélectionner un statut --</option>
            <option value="actif" <?= $code && $code['statut'] == 'actif' ? 'selected' : '' ?>>
              Actif
            </option>
            <option value="inactif" <?= $code && $code['statut'] == 'inactif' ? 'selected' : '' ?>>
              Inactif
            </option>
            <option value="expire" <?= $code && $code['statut'] == 'expire' ? 'selected' : '' ?>>
              Expiré
            </option>
          </select>

          <?php if(isset($validation) && is_array($validation) && isset($validation['statut'])) : ?>
            <span class="field-error-msg show">
              <?= $validation['statut'] ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Boutons -->
        <div class="form-buttons">

          <button type="submit"
                  class="btn btn-primary btn-full-width">
            <?= $code ? 'Mettre à jour' : 'Créer' ?>
          </button>

          <a href="<?= base_url('back-office/codes') ?>"
             class="btn btn-outline btn-full-width">
            Annuler
          </a>

        </div>

      </form>

    </div>
  </div>
</section>
