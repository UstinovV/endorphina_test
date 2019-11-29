<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action'=>'/site/save']) ?>
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
<br>
<p>Convert money to bonuses</p>
<button class="btn btn-primary" id="convert-button">Convert</button>

<?php
$js = <<<JS
function refreshUSerData() {
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
}

$( document ).ready(function() {
    $('#user-money-amount').text('0');
    $('#user-bonuses-amount').text('0');
    refreshUSerData();
});

$('form').on('beforeSubmit', function(){
let data = $(this).serialize();
    $.ajax({
        url: '/site/play',
        type: 'POST',
        data: [],
        success: function(res){
            alert('Your prise is: ' + res);
            // as option could refreshed without additional request
            refreshUSerData();
        },
        error: function(err){
            alert('Error happened');
            console.log(err.responseText);
            console.log(err.statusText);
        }
    });
    return false;
});

$('#convert-button').on('click', function(){
    $.ajax({
        url: '/site/convert',
        type: 'POST',
        data: [],
        success: function(res){
            alert('Your prise is: ' + res);
            // as option could refreshed without additional request
            refreshUSerData();
        },
        error: function(err){
            alert('Error happened');
            console.log(err.responseText);
            console.log(err.statusText);
        }
    });
});

JS;
 
$this->registerJs($js);
?>