<?php
/** @var $model \app\models\User */
/** @var   $this \app\core\View*/
$this->title = 'Sign Up';

?>

<?php $form = \app\core\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'Firstname') ?>
<?php echo $form->field($model, 'Lastname') ?>
<?php echo $form->field($model, 'Email') ?>
<?php echo $form->field($model, 'Nickname') ?>
<?php echo $form->field($model, 'Password')->passwordField() ?>
<?php echo $form->field($model, 'Password2')->passwordField() ?>
<div class="signup">
    <button class="button" type="submit">Let's party</button>
</div>
<?php \app\core\form\Form::end() ?>
