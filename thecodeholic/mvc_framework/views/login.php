<?php 
    /** @var $clsUser \app\models\User */
    /** @var $this \app\core\View */
    $this->sTitle = 'Profile';
?>

<h1>Login</h1>

<?php $oForm = \app\core\form\Form::begin('', 'post'); ?>
    <?= $oForm->InputField($clsModel, 'email'); ?>
    <?= $oForm->InputField($clsModel, 'password')->passwordField(); ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?= \app\core\form\Form::end(); ?>