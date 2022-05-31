<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>DOST III Regional Science and Technology Week</title>
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
header('Content-Transfer-Encoding: base64');
header('Content-Type: multipart/alternative');
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$barcode = $visitor->vis_code;
$barcodeImage = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcode, $generator::TYPE_CODE_128)) . '" alt="'.$barcode.'" style="height: auto;width: 250px;padding:5px;">';
//echo $barcodeImage;
//saving barcode
$imgdata = $generator->getBarcode($barcode, $generator::TYPE_CODE_128);
$savepath = realpath(public_path('uploads/barcodes/')).DIRECTORY_SEPARATOR.$barcode.'.png';
// file_put_contents($savepath, $imgdata);
?>
Warm greetings from DOST Region 3!,
<br>
<br>
We are pleased to inform you that your participation to the 2018 Regional Science and Technology Week (RSTW) celebration at Bulwagan ng Kanlahi (Diwa ng Tarlak), Romulo Boulevard, Tarlac City, Tarlac has been approved.
<br>
For your convenience, we encourage you to bring a printed or a digital copy of the attached barcode on the day(s) of your visit to the 2018 RSTW from August 1 to 3, 2018. Then, you can proceed directly to the barcode scanner available at the Registration Counter in Bulwagan ng Kanlahi to scan your barcode and sign you in.
<br>
<br>
<h4>Registration Details : </h4>
<div>{{ $visitor->vis_name }}</div>
<div>{{ $visitor->vis_company }}</div>
<div>{{ $visitor->class_name }}</div>

<br>
<div style="border:1px dashed black; text-align: center;overflow-wrap: break-word; display: inline-block;">
{!! $barcodeImage !!}
<br>
<span style="text-align: center;">{{ $barcode }}</span>	
<!-- <img src="{{ url('/uploads/barcodes').'/'.$visitor->vis_code.'.png' }}" style="height: auto;width: 250px;"> -->
</div>
<br>
<br>
Again, we would like to express our deepest appreciation for your interest in joining this event. 
<br>
Thank you so much and see you there !
<br>
<br>
All the best,
<br>
Department of Science and Technology Regional Office III
D.M. Government Center, Brgy. Maimpis, City of San Fernando, Pampanga
<br>
<a href="http://region3.dost.gov.ph">http://region3.dost.gov.ph</a>
<br>
<br>
This message was sent via automailer. Please do not send a reply.
</html>