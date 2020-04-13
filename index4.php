<!DOCTYPE html>
<html>
<head>
	<title>Computação Gráfica</title>
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

</body>
</html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

<div class="container">
     
	<!-- <div class="row">
		<div class="col-md-12">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="file" name="fileUpload" />		
				<input type="submit" name="ok" value="Enviar" class="btn btn-success" />				
			</form>
		</div>
	</div>
	-->

	<?php
		$imagem = 'Imagem01.jpg';
		
	
		$im = imagecreatefromjpeg($imagem);		
		$imgX = imagesx($im);
		$imgY = imagesy($im);	

		imagefilter($im, IMG_FILTER_GRAYSCALE);
		
		//imagefilter($im, IMG_FILTER_BRIGHTNESS, 10);
		//imagefilter($im, IMG_FILTER_CONTRAST, -20); 
   		imagefilter($im, IMG_FILTER_EDGEDETECT);
    	imagepng($im, 'teste2.png');

   ?>
	
	<div class='row'>
		<div class='col-md-12'>
			<img src='teste2.png' />
		
		</div>	
	</div>

