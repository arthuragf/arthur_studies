<?php
/** @var $this \app\core\View */
/** @var $clsModel \app\models\ContactForm */
$this->sTitle = 'Contact';
?>
<h1>Contact us</h1>

<?php $oForm = \app\core\form\Form::begin('', 'post'); ?>
<?= $oForm->InputField($clsModel, 'sSubject'); ?>
<?= $oForm->InputField($clsModel, 'sEmail'); ?>
<?= $oForm->TextareaField($clsModel, 'sBody'); ?>
<button type="submit" class="btn btn-primary">Send Message</button>
<?= \app\core\form\Form::end(); ?>