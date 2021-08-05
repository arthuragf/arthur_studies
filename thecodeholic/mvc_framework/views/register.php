<h1>Create an account</h1>

<?php $oForm = \app\core\form\Form::begin('', 'post'); ?>
    <div class="row">
        <div class="col">
            <?= $oForm->field($clsRegisterModel, 'sFirstName'); ?>
        </div>
        <div class="col">
            <?= $oForm->field($clsRegisterModel, 'sLastName'); ?>
        </div>
    </div>
    <?= $oForm->field($clsRegisterModel, 'sEmail'); ?>
    <?= $oForm->field($clsRegisterModel, 'sPassword')->passwordField(); ?>
    <?= $oForm->field($clsRegisterModel, 'sConfirmPassword')->passwordField(); ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?= \app\core\form\Form::end(); ?>