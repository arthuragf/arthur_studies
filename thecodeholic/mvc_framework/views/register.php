<h1>Create an account</h1>

<?php $oForm = \app\core\form\Form::begin('', 'post'); ?>
    <div class="row">
        <div class="col">
            <?= $oForm->field($clsUser, 'firstname'); ?>
        </div>
        <div class="col">
            <?= $oForm->field($clsUser, 'lastname'); ?>
        </div>
    </div>
    <?= $oForm->field($clsUser, 'email'); ?>
    <?= $oForm->field($clsUser, 'password')->passwordField(); ?>
    <?= $oForm->field($clsUser, 'confirmpassword')->passwordField(); ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?= \app\core\form\Form::end(); ?>