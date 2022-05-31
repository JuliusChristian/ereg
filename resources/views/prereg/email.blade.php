<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=UTF-8">
    <title>DOST Calabarzon</title>
</head>
<body>      
	{{ $event->event_title }} 
	<br>
	<?php echo '<img src="data:image/png;base64,'.base64_encode($gen->getBarcode($zcode, $gen::TYPE_CODE_128)).'">'; ?>
	<br>
	{{ $zcode }}
	<br>
	DOST Calabarzon
</body>