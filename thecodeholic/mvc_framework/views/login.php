<?php 
    /** @var $clsUser \app\models\User */
?>

<h1>Login</h1>

<?php $oForm = \app\core\form\Form::begin('', 'post'); ?>
    <?= $oForm->field($clsModel, 'email'); ?>
    <?= $oForm->field($clsModel, 'password')->passwordField(); ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?= \app\core\form\Form::end(); ?>