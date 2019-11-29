<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action'=>'/site/play']) ?>
<div>
	<span>User money: </span>
	<span id="user-money-amount"></span>
</div>
	<div>
		<span>User bonuses: </span>
		<span id="user-bonuses-amount"></span>
</div>
<?= Html::tag('p', Html::encode('Press the button and win a prise')) ?>
<?= Html::submitButton('Play', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>

<?php
$js = <<<JS
$( document ).ready(function() {
    $('#user-money-amount').text('0');
    $('#user-bonuses-amount').text('0');
    
     $.ajax({
		 url: '/site/get-user-data',
		 type: 'POST',
		 data: [],
		 success: function(res){
			$('#user-money-amount').text(res['money']);
    		$('#user-bonuses-amount').text(res['bonuses']);
		 },
		 error: function(err){
		    alert('Error happened');
			console.log(err.responseText);
			console.log(err.statusText);
		 }
	 });
});

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
    alert('Error happened');
	console.log(err.responseText);
	console.log(err.statusText);
 }
 });
 return false;
 });
JS;
 
$this->registerJs($js);
?>