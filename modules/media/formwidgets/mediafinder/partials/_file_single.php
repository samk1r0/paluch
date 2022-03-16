<div
    id="<?= $this->getId() ?>"
    class="field-mediafinder is-file is-single <?= $singleFile ? 'is-populated' : '' ?> <?= $this->previewMode ? 'is-preview' : '' ?>"
    data-control="mediafinder"
    data-template="#<?= $this->getId('template') ?>"
    data-input-name="<?= $field->getName() ?>"
    <?php if ($externalToolbarAppState): ?>data-external-toolbar-app-state="<?= e($externalToolbarAppState)?>"<?php endif ?>
    <?php if ($externalToolbarEventBus): ?>data-external-toolbar-event-bus="<?= e($externalToolbarEventBus)?>"<?php endif ?>
    <?= $field->getAttributes() ?>
>
    <div class="empty-state">
        <img src="<?= Url::asset('/modules/backend/assets/images/no-files.svg') ?>"/>
    </div>

    <div class="mediafinder-control-container <?= $externalToolbarAppState ? 'external-toolbar' : null ?>">
        <div class="mediafinder-control-toolbar">
            <a href="javascript:;" class="backend-toolbar-button control-button toolbar-find-button">
                <i class="octo-icon-common-file-star"></i>
                <span
                    class="button-label"
                    data-upload-label="<?= e(trans('backend::lang.fileupload.upload')) ?>"
                    data-replace-label="<?= e(trans('backend::lang.fileupload.replace')) ?>"
                ><?= $singleFile
                    ? e(trans('backend::lang.mediafinder.replace'))
                    : e(trans('backend::lang.mediafinder.select'))
                ?></span>
            </a>

            <button
                class="backend-toolbar-button control-button find-remove-button populated-only"
            >
                <i class="octo-icon-common-file-remove"></i>
                <span class="button-label"><?= e(trans('backend::lang.fileupload.clear')) ?></span>
            </button>
        </div>

        <!-- Existing file -->
        <div class="mediafinder-files-container">
            <div class="server-file"
                data-public-url="<?= $singleFile->publicUrl ?? '' ?>"
                data-path="<?= $singleFile->spawnPath ?? '' ?>"
                data-title="<?= $singleFile->title ?? '' ?>"
            ></div>
        </div>
    </div>

    <!-- Data locker -->
    <input
        type="hidden"
        name="<?= $field->getName() ?>"
        id="<?= $field->getId() ?>"
        value="<?= $singleFile ? e($singleFile->spawnPath) : '' ?>"
        data-find-value
        />
</div>

<?= $this->makePartial('file_item_template') ?>
