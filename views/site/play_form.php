<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action'=>'/site/play']) ?>
<?= Html::tag('p', Html::encode('Press the button and win a prise')) ?>
<?= Html::submitButton('Play', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>

<?php
$js = <<<JS
$('form').on('beforeSubmit', function(){
 var data = $(this).serialize();
 $.ajax({
 url: '/site/play',
 type: 'POST',
 data: [],
 success: function(res){
 console.log(res);
 },
 error: function(err){
 alert(err);
 }
 });
 return false;
 });
JS;
 
$this->registerJs($js);
?>