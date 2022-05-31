<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>DOST Calabarzon - {{ $event->event_title }}</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Roboto+Mono" rel="stylesheet">
<style type="text/css">
	html, body{
		font-family: 'Roboto', sans-serif;
		width: 100%;
		height: 100%;
		min-height: 100%;
		padding: 0;
		margin: 0;
		border: 0;
	}

	.barcode{
		font-family: 'Roboto Mono', monospace;
		display: inline-block;
		text-align: center;
		margin: 0 auto;
		border: 1px dashed #666666;
		padding: 8px;

	}

	.event-title{
		font-family: 'Roboto Condensed', sans-serif;
		font-size: 12px;
	}

	.barcode-numbers{
		font-family: 'Roboto Mono', monospace;
		font-size: 12px;
	}

</style>
<body>
<?php
$gen = new \Picqer\Barcode\BarcodeGeneratorPNG();
//$imgdata = $gen->getBarcode($barcode, $gen::TYPE_CODE_128);
//data:image/png;base64,<?php base64_encode($gen->getBarcode($barcode, $gen::TYPE_CODE_128))
//$message->embedData($imgdata, 'registration-barcode.png')
$imgdata = $gen->getBarcode($barcode, $gen::TYPE_CODE_128);

$savepath = realpath(public_path('uploads/barcodes/')).DIRECTORY_SEPARATOR.$barcode.'.png';

file_put_contents($savepath, $imgdata);
?>
Greetings,
<br>
<br>
You have been registered to the <strong>{{ $event->event_title }}</strong> from <strong>{{ date('F j, Y', strtotime($event->event_from)) }}</strong> to <strong>{{ date('F j, Y', strtotime($event->event_to)) }}</strong>
<br>
<br>
<h4>Registration Details : </h4>
<div>Name: {{ $visitor->vis_fname }}&nbsp;{{ $visitor->vis_lname }}</div>
<div>Age: {{ $visitor->vis_age }} yrs. old</div>
<div>Sex: {{ $visitor->gender_name }}</div>
<div>Company/Institution: {{ $visitor->vis_company }}</div>

<?php
if ($visitor->vis_day > 0){
?>
<div>Planned to attend on the {{ $visitor->vis_day }}</div>
<?php
}
?>
<br>
<br>
<h3>Please print the e-ticket from the link below  or have a screenshot on your mobile devices and present it at the venue :</h3>
<br>
<a href="{{ URL::to('/eticket/'.$barcode) }}" title="e-ticket" target="_blank">{{ URL::to('/eticket/'.$barcode) }}</a>
<br>
<br>
Thank you,
<br>
Department of Science and Technology - III
<br>
<br>
This message was sent via automailer. Please do not send a reply.
</html>