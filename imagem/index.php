<!DOCTYPE html>
<html>
<head>
	<title>Computação Gráfica</title>
	    <style>
        [data-tooltip] {
  position: relative;
  font-weight: bold;
}

[data-tooltip]:after {
  display: none;
  position: absolute;
  top: -5px;
  padding: 5px;
  border-radius: 3px;
  left: calc(100% + 2px);
  content: attr(data-tooltip);
  white-space: nowrap;
  background-color: #0095ff;
  color: White;
    z-index: 1000;
}

[data-tooltip]:hover:after {
  display: block;
}
        </style>
		
		<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="css/pace.css">

</head>
<body>

<div class="container">
	<div class="row">
		<nav class="navbar navbar-inverse bg-inverse ">
			<a class="navbar-brand" href="http://localhost/imagem" >Computação Gráfica</a>
		</nav>
		<br>


			<div class="col-md-3">
				<a href="index.php?pixel" class="btn btn-danger btn-lg btn-block" role="button">Pixel</a>
			</div>

			<div class="col-md-3">
				<a href="index.php?histograma" class="btn btn-warning btn-lg btn-block" role="button">Histograma</a>
			</div>

			<div class="col-md-3">
				<a href="index.php?borda" class="btn btn-info btn-lg btn-block" role="button">Borda</a>
			</div>

			<div class="col-md-3">
				<a href="index.php?padrao" class="btn btn-success btn-lg btn-block" role="button">Padrao</a>
			</div>	
			<br><br><br>
			<div class="col-md-3">
				<a href="index.php?chromabackup" class="btn btn-success btn-lg btn-block" role="button">Chroma key 1</a>
			</div>

			<div class="col-md-3">
				<a href="index.php?chroma" class="btn btn-success btn-lg btn-block" role="button">Chroma key 2</a>
			</div>

			<!--<div class="col-md-3">
				<a href="index.php?borda" class="btn btn-info btn-lg btn-block" role="button">Borda</a>
			</div>

			<div class="col-md-3">
				<a href="index.php?chroma" class="btn btn-success btn-lg btn-block" role="button">Chroma key</a>
			</div>		-->

	</div>


		

<script type="text/javascript" src="js/pace.min.js"></script>
	<hr>


<?php




























if(isset($_GET['pixel'])){
	?>



	<div class="container">




	<?php
	function RGB_TO_HSV($R, $G, $B){
	    $R = ($R / 255);
	    $G = ($G / 255);
	    $B = ($B / 255);
	    $maxRGB = max($R, $G, $B);
	    $minRGB = min($R, $G, $B);
	    $chroma = $maxRGB - $minRGB;
	    $computedV = 100 * $maxRGB;
	    if ($chroma == 0)
	        return array(0, 0, $computedV);
	    $computedS = 100 * ($chroma / $maxRGB);
	    if ($R == $minRGB)
	        $h = 3 - (($G - $B) / $chroma);
	    elseif ($B == $minRGB)
	        $h = 1 - (($R - $G) / $chroma);
	    else
	        $h = 5 - (($B - $R) / $chroma);
	    $computedH = 60 * $h;

	    return array(($computedH / 360), ($computedS / 100), ($computedV / 100));
	}
			$im = imagecreatefromjpeg('imgs/padrao.jpg');
			$imgX = imagesx($im);
			$imgY = imagesy($im);

		?>	
			<table class="table">
				  <thead>
				    <tr>
				      <th width="100">Posição X</th>
				      <th width="100">Posição Y</th>
				      <th style="color: red">Red</th>
				      <th style="color: green">Green</th>
				      <th style="color: blue">Blue</th>
	                  <th>H</th>
				      <th>S</th>
				      <th>V</th>
				      <th width="10">Cor</th>
				    </tr>
				  </thead>
				  <tbody>

				   <?php
						for($i=0; $i < $imgX; $i++){
							for($j=0; $j < $imgY; $j++){
								$rgb = imagecolorat($im, $i, $j);
								$r = ($rgb >> 16) & 0xFF;
								$g = ($rgb >> 8) & 0xFF;
								$b = $rgb & 0xFF;
								$hsv = RGB_TO_HSV($r, $g, $b);
									$h = $hsv[0];
									$s = $hsv[1];
									$v = $hsv[2];
								$cinza = ($r + $g + $b)/3;
	                            
								
									echo "<tr>";
									echo "<td>$i</td>";
									echo "<td>$j</td>";
									echo "<td>$r</td>";
									echo "<td>$g</td>";
									echo "<td>$b</td>";
	                                echo "<td>$h</td>";
									echo "<td>$s</td>";
									echo "<td>$v]</td>";
									echo "<td width='10' style='background-color: rgb($r,$g,$b)' ></th>";
									echo "</tr>";
									
								
					
							}
						}
						?>
				  </tbody>
			</table>


	    </div>

		<?php
}




























if(isset($_GET['borda'])){


function RGBtoHSV($r, $g, $b) {
	$r = $r/255.; // convert to range 0..1
	$g = $g/255.;
	$b = $b/255.;
	$cols = array("r" => $r, "g" => $g, "b" => $b);
	asort($cols, SORT_NUMERIC);
	$min = key(array_slice($cols, 1)); // "r", "g" or "b"
	$max = key(array_slice($cols, -1)); // "r", "g" or "b"
	// hue
	if($cols[$min] == $cols[$max]) {
		$h = 0;
	} else {
		if($max == "r") {
			$h = 60. * ( 0 + ( ($cols["g"]-$cols["b"]) / ($cols[$max]-$cols[$min]) ) );
		} elseif ($max == "g") {
			$h = 60. * ( 2 + ( ($cols["b"]-$cols["r"]) / ($cols[$max]-$cols[$min]) ) );
		} elseif ($max == "b") {
			$h = 60. * ( 4 + ( ($cols["r"]-$cols["g"]) / ($cols[$max]-$cols[$min]) ) );
		}
		if($h < 0) {
			$h += 360;
		}
	}
	// saturation
	if($cols[$max] == 0) {
		$s = 0;
	} else {
		$s = ( ($cols[$max]-$cols[$min])/$cols[$max] );
		$s = $s * 255;
	}
	// lightness
	$v = $cols[$max];
	$v = $v * 255;
	return(array($h, $s, $v));
}




$filename = "imgs/goku.png";
$dimensions = getimagesize($filename);
$w = $dimensions[0]; // width
$h = $dimensions[1]; // height
$im = imagecreatefrompng($filename);
for($hi=0; $hi < $h; $hi++) {
	for($wi=0; $wi < $w; $wi++) {
		$rgb = imagecolorat($im, $wi, $hi);
		$r = ($rgb >> 16) & 0xFF;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;
		$hsv = RGBtoHSV($r, $g, $b);
		$matriz[$hi][$wi]['r'] = $hsv[0];
		$matriz[$hi][$wi]['s'] = $hsv[1];
		$matriz[$hi][$wi]['v'] = $hsv[2];
		
	}
}
/*function diferenca_valores($x, $y, $dif){
	global $matriz;
	if(abs($matriz[$hi -1][$wi]['v'] - $matriz[$hi][$wi]['v']));

}*/
for($hi=0; $hi < $h; $hi++) {
	for($wi=0; $wi < $w; $wi++) {
		if(isset($matriz[$hi -1][$wi]['v'])){
			if(abs($matriz[$hi -1][$wi]['v'] - $matriz[$hi][$wi]['v']) > 20) {
				imagesetpixel($im, $wi, $hi, imagecolorallocate($im, 255, 255, 255));
			} else {
				imagesetpixel($im, $wi, $hi, imagecolorallocate($im, 0, 0, 0));
			}
		}
	}
}
for($wi=0; $wi < $h; $wi++) {
	for($hi=0; $hi < $w; $hi++) {
		if(isset($matriz[$hi -1][$wi]['v'])){
			if(abs($matriz[$hi -1][$wi]['v'] - $matriz[$hi][$wi]['v']) > 20) {
				imagesetpixel($im, $wi, $hi, imagecolorallocate($im, 255, 255, 255));
			} else {
				imagesetpixel($im, $wi, $hi, imagecolorallocate($im, 0, 0, 0));
			}
		}
	}
}

imagepng($im, 'saidas/imagem_edge.png');





?>
<body>
	<img src='saidas/imagem_edge.png' align="left">
	<img src='imgs/goku.png'>
</body>

<?php
}



























if(isset($_GET['histograma'])){

		$im = imagecreatefrompng('imgs/php3.png');
		$imgX = imagesx($im);
		$imgY = imagesy($im);

	?>	

		<div id="myDiv"></div>
		<script>
			var x = [];

				<?php
				$coco = 0;
				for($i=0; $i < $imgY; $i++){
					for($j=0; $j < $imgX; $j++){	
					imagefilter($im, IMG_FILTER_GRAYSCALE);		
						$rgb = imagecolorat($im, $j, $i);
						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;
						
						
						echo "x[$coco] = $r;";
								$coco++;			
							
					}
				}
				?>

				



			var data = [
			  {
			    x: x,
			    type: 'histogram',
			      marker: {
			    color: 'rgba(100,250,100,0.7)',
				width: 1
			    },
			  }
			];
			Plotly.newPlot('myDiv', data);
		</script>

    </div>

    
<script type="text/javascript" src="js/pace.min.js"></script>
	<?php
}


































if(isset($_GET['padrao'])){
	function RGB_TO_HSV($R, $G, $B){

	    $R = ($R / 255);
	    $G = ($G / 255);
	    $B = ($B / 255);

	    $maxRGB = max($R, $G, $B);
	    $minRGB = min($R, $G, $B);
	    $chroma = $maxRGB - $minRGB;

	    $computedV = 100 * $maxRGB;

	    if ($chroma == 0)
	        return array(0, 0, $computedV);

	    $computedS = 100 * ($chroma / $maxRGB);

	    if ($R == $minRGB)
	        $h = 3 - (($G - $B) / $chroma);
	    elseif ($B == $minRGB)
	        $h = 1 - (($R - $G) / $chroma);
	    else
	        $h = 5 - (($B - $R) / $chroma);

	    $computedH = 60 * $h;

	    return array(($computedH / 360), ($computedS / 100), ($computedV / 100));
	}
	$im_padrao = imagecreatefromjpeg('imgs/padrao3.jpg');
	$imgX_padrao = imagesx($im_padrao);
	$imgY_padrao = imagesy($im_padrao);

	$menor_r = 255;
	$maior_r = 0;
	$menor_g = 255;
	$maior_g = 0;
	$menor_b = 255;
	$maior_b = 0;
	$menor_h = 1;
	$maior_h = 0;
	$menor_s = 1;
	$maior_s = 0;
	$menor_v = 1;
	$maior_v = 0;
	
	for($i=0; $i < $imgY_padrao; $i++){
		for($j=0; $j < $imgX_padrao; $j++){	
				$rgb = imagecolorat($im_padrao, $j, $i);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$hsv = RGB_TO_HSV($r, $g, $b);
				$h = $hsv[0];
				$s = $hsv[1];
				$v = $hsv[2];
				/////r
				if($r > $maior_r){
					$maior_r = $r;
				}
				if($r < $menor_r){
					$menor_r = $r;
				}
				////g
				if($g > $maior_g){
					$maior_g = $g;
				}
				if($g < $menor_g){
					$menor_g = $g;
				}
				//////b
				if($b > $maior_b){
					$maior_b = $b;
				}
				if($b < $menor_b){
					$menor_b = $b;
				}
				
				/////h
				if($h > $maior_h){
					$maior_h = $h;
				}
				if($h < $menor_h){
					$menor_h = $h;
				}
				////s
				if($s > $maior_s){
					$maior_s = $s;
				}
				if($s < $menor_s){
					$menor_s = $s;
				}
				//////v
				if($v > $maior_v){
					$maior_v = $v;
				}
				if($v < $menor_v){
					$menor_v = $v;
				}
					
					

		}
	}
?>

    
	

	<?php
	for($x = 1; $x < 10; $x++){
		$nome_imagem = "imagem0" . $x . ".jpg";
		$im = imagecreatefromjpeg("imgs/" . $nome_imagem);
		//imagefilter($im, IMG_FILTER_EDGEDETECT);
		$imgX = imagesx($im);
		$imgY = imagesy($im);

		
		/*
		for($i=0; $i < $imgY; $i++){
			for($j=0; $j < $imgX; $j++){	
					$rgb = imagecolorat($im, $j, $i);
					$r = ($rgb >> 16) & 0xFF;
					$g = ($rgb >> 8) & 0xFF;
					$b = $rgb & 0xFF;
					if(($r >= $menor_r && $r <= $maior_r) && ($g >= $menor_g && $g <= $maior_g) && ($b >= $menor_b && $b <= $maior_b)){
						imagesetpixel($im, $j, $i, imagecolorallocate($im, 255, 0, 0));
					}else{
						imagesetpixel($im, $j, $i, imagecolorallocate($im, $r, $g, $b));
					}
			}
		}*/

		
		for($i=0; $i < $imgY; $i++){
			for($j=0; $j < $imgX; $j++){	
					$rgb = imagecolorat($im, $j, $i);
					$r = ($rgb >> 16) & 0xFF;
					$g = ($rgb >> 8) & 0xFF;
					$b = $rgb & 0xFF;
					$hsv = RGB_TO_HSV($r, $g, $b);
					$h = $hsv[0];
					$s = $hsv[1];
					$v = $hsv[2];
					if(($r >= $menor_r && $r <= $maior_r) && ($g >= $menor_g && $g <= $maior_g) && ($b >= $menor_b && $b <= $maior_b) && ($h >= $menor_h && $h <= $maior_h) && ($s >= $menor_s && $s <= $maior_s) && ($v >= $menor_v && $v <= $maior_v)){
						imagesetpixel($im, $j, $i, imagecolorallocate($im, 255, 0, 0));
					}else{
						imagesetpixel($im, $j, $i, imagecolorallocate($im, $r, $g, $b));
					}
			}
		}
		imagejpeg($im, 'saidas/' . $nome_imagem);
		?>
		<br>
		<img src="imgs/<?php echo $nome_imagem; ?>">
		<img src="saidas/<?php echo $nome_imagem; ?>">




	<?php
	}
	?>

    </div>
    <?php
}








































if(isset($_GET['chromabackup'])){
		function RGB_TO_HSV($R, $G, $B){
		    $R = ($R / 255);
		    $G = ($G / 255);
		    $B = ($B / 255);

		    $maxRGB = max($R, $G, $B);
		    $minRGB = min($R, $G, $B);
		    $chroma = $maxRGB - $minRGB;
		    $computedV = 100 * $maxRGB;
		    if ($chroma == 0)
		        return array(0, 0, $computedV);
		    $computedS = 100 * ($chroma / $maxRGB);
		    if ($R == $minRGB)
		        $h = 3 - (($G - $B) / $chroma);
		    elseif ($B == $minRGB)
		        $h = 1 - (($R - $G) / $chroma);
		    else
		        $h = 5 - (($B - $R) / $chroma);
		    $computedH = 60 * $h;
		    return array(($computedH / 360), ($computedS / 100), ($computedV / 100));
		}

		$im_padrao = imagecreatefromjpeg('imgs/chroma_padrao.jpg');
		$imgX_padrao = imagesx($im_padrao);
		$imgY_padrao = imagesy($im_padrao);
		$menor_r = 255;
		$maior_r = 0;
		$menor_g = 255;
		$maior_g = 0;
		$menor_b = 255;
		$maior_b = 0;
		$menor_h = 1;
		$maior_h = 0;
		$menor_s = 1;
		$maior_s = 0;
		$menor_v = 1;
		$maior_v = 0;
			
		for($i=0; $i < $imgY_padrao; $i++){
			for($j=0; $j < $imgX_padrao; $j++){	
				$rgb = imagecolorat($im_padrao, $j, $i);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$hsv = RGB_TO_HSV($r, $g, $b);
				$h = $hsv[0];
				$s = $hsv[1];
				$v = $hsv[2];
				if($r > $maior_r){ $maior_r = $r; }
				if($r < $menor_r){ $menor_r = $r; }
				if($g > $maior_g){ $maior_g = $g; }
				if($g < $menor_g){ $menor_g = $g; }
				if($b > $maior_b){ $maior_b = $b; }
				if($b < $menor_b){ $menor_b = $b; }
				if($h > $maior_h){ $maior_h = $h; }
				if($h < $menor_h){ $menor_h = $h; }
				if($s > $maior_s){ $maior_s = $s; }
				if($s < $menor_s){ $menor_s = $s; }
				if($v > $maior_v){ $maior_v = $v; }
				if($v < $menor_v){ $menor_v = $v; }
			}
		}

		$im_fundo = imagecreatefromjpeg('imgs/chroma_fundo.jpg');
		$imgX_fundo = imagesx($im_fundo);
		$imgY_fundo = imagesy($im_fundo);
		for($i=0; $i < $imgY_fundo; $i++){
			for($j=0; $j < $imgX_fundo; $j++){	
				$rgb = imagecolorat($im_fundo, $j, $i);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$matriz[$j][$i][0] = $r;
				$matriz[$j][$i][1] = $g;
				$matriz[$j][$i][2] = $b;
			}
		}

		$nome_imagem = "imgs/chroma_entrada.jpg";
		$im = imagecreatefromjpeg($nome_imagem);
		$imgX = imagesx($im);
		$imgY = imagesy($im);
	

		for($i=0; $i < $imgY; $i++){
			for($j=0; $j < $imgX; $j++){	
					$rgb = imagecolorat($im, $j, $i);
					$r = ($rgb >> 16) & 0xFF;
					$g = ($rgb >> 8) & 0xFF;
					$b = $rgb & 0xFF;
					$hsv = RGB_TO_HSV($r, $g, $b);
					$h = $hsv[0];
					$s = $hsv[1];
					$v = $hsv[2];
					if(($r >= $menor_r && $r <= $maior_r) && ($g >= $menor_g && $g <= $maior_g) && ($b >= $menor_b && $b <= $maior_b) && ($h >= $menor_h && $h <= $maior_h) && ($s >= $menor_s && $s <= $maior_s) && ($v >= $menor_v && $v <= $maior_v)){
						$r = $matriz[$j % $imgY_fundo][$i % $imgX_fundo][0];
						$g = $matriz[$j % $imgY_fundo][$i % $imgX_fundo][1];
						$b = $matriz[$j % $imgY_fundo][$i % $imgX_fundo][2];
						imagesetpixel($im, $j, $i, imagecolorallocate($im, $r, $g, $b));
					}else{
						imagesetpixel($im, $j, $i, imagecolorallocate($im, $r, $g, $b));
					}
			}
		}
		imagejpeg($im, 'saidas/chroma_saida.jpg');
		?>
		<br>
		<img src="<?php echo $nome_imagem; ?>">
		<img src="saidas/chroma_saida.jpg">

<?php
}
































if(isset($_GET['chroma'])){

		/////////////////////////////////////FUNCAO PARA CONVERTER RGB PARA HSV
		function RGB_TO_HSV($R, $G, $B){
		    $R = ($R / 255);
		    $G = ($G / 255);
		    $B = ($B / 255);

		    $maxRGB = max($R, $G, $B);
		    $minRGB = min($R, $G, $B);
		    $chroma = $maxRGB - $minRGB;
		    $computedV = 100 * $maxRGB;
		    if ($chroma == 0)
		        return array(0, 0, $computedV);
		    $computedS = 100 * ($chroma / $maxRGB);
		    if ($R == $minRGB)
		        $h = 3 - (($G - $B) / $chroma);
		    elseif ($B == $minRGB)
		        $h = 1 - (($R - $G) / $chroma);
		    else
		        $h = 5 - (($B - $R) / $chroma);
		    $computedH = 60 * $h;
		    return array(($computedH / 360), ($computedS / 100), ($computedV / 100));
		}




		function modulo_find($x, $y, $razao, $vx, $vy){
			global $matriz;
			if(isset($matriz[$x + $vx][$y + $vy][0])){
				if((abs($matriz[$x][$y][0] - $matriz[$x + $vx][$y + $vy][0]) < $razao) && 
					(abs($matriz[$x][$y][1] - $matriz[$x + $vx][$y + $vy][1]) < $razao) && 
					(abs($matriz[$x][$y][2] - $matriz[$x + $vx][$y + $vy][2]) < $razao)){
					find($x + $vx, $y + $vy, $razao);
				}
			}
		}


		/////////////////////////////////////
		function find($x, $y, $razao){
			global $matriz;
			if($matriz[$x][$y][3] == 0){
				$matriz[$x][$y][3] = 1;
				modulo_find($x, $y, $razao, -1, -1);
				modulo_find($x, $y, $razao, -1, 0);
				modulo_find($x, $y, $razao, -1, 1);
				modulo_find($x, $y, $razao, 0, -1);
				modulo_find($x, $y, $razao, 0, 1);
				modulo_find($x, $y, $razao, 1, -1);
				modulo_find($x, $y, $razao, 1, 0);
				modulo_find($x, $y, $razao, 1, 1);
			}
		}


		///////////////////////ENCONTRA O MAIOR E MENOR VALOR DO PADRAO EM RGB E HSV
		$im_padrao = imagecreatefromjpeg('imgs/chroma_padrao.jpg');
		$imgX_padrao = imagesx($im_padrao);
		$imgY_padrao = imagesy($im_padrao);
		$menor_r = 255;
		$maior_r = 0;
		$menor_g = 255;
		$maior_g = 0;
		$menor_b = 255;
		$maior_b = 0;
		$menor_h = 1;
		$maior_h = 0;
		$menor_s = 1;
		$maior_s = 0;
		$menor_v = 1;
		$maior_v = 0;
		for($i=0; $i < $imgY_padrao; $i++){
			for($j=0; $j < $imgX_padrao; $j++){	
				$rgb = imagecolorat($im_padrao, $j, $i);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$hsv = RGB_TO_HSV($r, $g, $b);
				$h = $hsv[0];
				$s = $hsv[1];
				$v = $hsv[2];
				if($r > $maior_r){ $maior_r = $r; }
				if($r < $menor_r){ $menor_r = $r; }
				if($g > $maior_g){ $maior_g = $g; }
				if($g < $menor_g){ $menor_g = $g; }
				if($b > $maior_b){ $maior_b = $b; }
				if($b < $menor_b){ $menor_b = $b; }
				if($h > $maior_h){ $maior_h = $h; }
				if($h < $menor_h){ $menor_h = $h; }
				if($s > $maior_s){ $maior_s = $s; }
				if($s < $menor_s){ $menor_s = $s; }
				if($v > $maior_v){ $maior_v = $v; }
				if($v < $menor_v){ $menor_v = $v; }
			}
		}


		////////////////////////////////////////////TRANSFORMA O FUNDO DO CHROMA EM UMA MATRIZ
		$im_fundo = imagecreatefromjpeg('imgs/chroma_fundo.jpg');
		$imgX_fundo = imagesx($im_fundo);
		$imgY_fundo = imagesy($im_fundo);
		for($y=0; $y < $imgY_fundo; $y++){
			for($x=0; $x < $imgX_fundo; $x++){	
				$rgb = imagecolorat($im_fundo, $x, $y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$matriz_fundo[$x][$y][0] = $r;
				$matriz_fundo[$x][$y][1] = $g;
				$matriz_fundo[$x][$y][2] = $b;
			}
		}



		////////////////////////////////////////////TRANSFORMA A IMAGEM PRINCIPAL EM UMA MATRIZ
		$nome_imagem = "imgs/chroma_entrada.jpg";
		$im = imagecreatefromjpeg($nome_imagem);
		$imgX = imagesx($im);
		$imgY = imagesy($im);
		for($y=0; $y < $imgY; $y++){
			for($x=0; $x < $imgX; $x++){	
				$rgb = imagecolorat($im, $x, $y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$matriz[$x][$y][0] = $r;
				$matriz[$x][$y][1] = $g;
				$matriz[$x][$y][2] = $b;
				$matriz[$x][$y][3] = 0;
			}
		}
	



		///////////////////////////////////VERIFICA ONDE SE APLICA O PADRAO
		/*for($y=0; $y < $imgY; $y++){
			for($x=0; $x < $imgX; $x++){	
					$rgb = imagecolorat($im, $x, $y);
					$r = ($rgb >> 16) & 0xFF;
					$g = ($rgb >> 8) & 0xFF;
					$b = $rgb & 0xFF;
					$hsv = RGB_TO_HSV($r, $g, $b);
					$h = $hsv[0];
					$s = $hsv[1];
					$v = $hsv[2];
					if(($r >= $menor_r && $r <= $maior_r) && ($g >= $menor_g && $g <= $maior_g) && ($b >= $menor_b && $b <= $maior_b) && ($h >= $menor_h && $h <= $maior_h) && ($s >= $menor_s && $s <= $maior_s) && ($v >= $menor_v && $v <= $maior_v)){
						$matriz[$x][$y][3] = 1;
					}
			}
		}*/
		////////////////passa pixel 250*300
		find(150, 100, 16);


		///////////////////////////////APLICA O PADRAO NA IMAGEM FINAL
		for($y=0; $y < $imgY; $y++){
			for($x=0; $x < $imgX; $x++){	
					$rgb = imagecolorat($im, $x, $y);
					$r = ($rgb >> 16) & 0xFF;
					$g = ($rgb >> 8) & 0xFF;
					$b = $rgb & 0xFF;
					$hsv = RGB_TO_HSV($r, $g, $b);
					$h = $hsv[0];
					$s = $hsv[1];
					$v = $hsv[2];
					if($matriz[$x][$y][3] == 0){
						$r = $matriz_fundo[$x % $imgY_fundo][$y % $imgX_fundo][0];
						$g = $matriz_fundo[$x % $imgY_fundo][$y % $imgX_fundo][1];
						$b = $matriz_fundo[$x % $imgY_fundo][$y % $imgX_fundo][2];
						imagesetpixel($im, $x, $y, imagecolorallocate($im, $r, $g, $b));
					}else{
						imagesetpixel($im, $x, $y, imagecolorallocate($im, $r, $g, $b));
					}
			}
		}
		imagejpeg($im, 'saidas/chroma_saida.jpg');
		?>
		<br>
		<img src="<?php echo $nome_imagem; ?>">
		<img src="saidas/chroma_saida.jpg">

<?php
}
?>