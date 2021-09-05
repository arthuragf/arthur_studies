<?php 
    /** @var $clsUser \app\models\User */
    /** @var $this \app\core\View */
    $this->sTitle = 'Profile';
?>

<h1>Create an account</h1>

<?php $oForm = \app\core\form\Form::begin('', 'post'); ?>
    <div class="row">
        <div class="col">
            <?= $oForm->InputField($clsUser, 'firstname'); ?>
        </div>
        <div class="col">
            <?= $oForm->InputField($clsUser, 'lastname'); ?>
        </div>
    </div>
    <?= $oForm->InputField($clsUser, 'email'); ?>
    <?= $oForm->InputField($clsUser, 'password')->passwordField(); ?>
    <?= $oForm->InputField($clsUser, 'confirmPassword')->passwordField(); ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?= \app\core\form\Form::end(); ?>