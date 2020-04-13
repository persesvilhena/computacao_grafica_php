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
				<a href="index.php?padrao" class="btn btn-success btn-lg btn-block" role="button">Detecção de padrão</a>
			</div>				


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
		$matriz[$hi][$wi][0] = $r;
		$matriz[$hi][$wi][1] = $g;
		$matriz[$hi][$wi][2] = $b;
		
	}
}
function diferenca_valores_x($x, $y, $dif){
	global $matriz;
	if(($dif > ($matriz[$x -1][$y][0] - $matriz[$x][$y][0])) && (($matriz[$x -1][$y][1] - $matriz[$x][$y][1]) > $dif)){
		return true;
	}else{
		return false;
	}
}
function diferenca_valores_y($x, $y, $dif){
	global $matriz;
	if((abs($matriz[$x][$y - 1][0] - $matriz[$x][$y][0]) > $dif) && (abs($matriz[$x][$y - 1][1] - $matriz[$x][$y][1]) > $dif) && (abs($matriz[$x][$y - 1][2] - $matriz[$x][$y][2]) > $dif)){
		return true;
	}else{
		return false;
	}
}

/*
for($x=0; $x < $h; $x++) {
	for($y=0; $y < $w; $y++) {
		if(isset($matriz[$x -1][$y][0])){
			if(diferenca_valores($x, $y, 10)) {
				imagesetpixel($im, $y, $x, imagecolorallocate($im, 255, 255, 255));
			} else {
				imagesetpixel($im, $y, $x, imagecolorallocate($im, 0, 0, 0));
			}
		}
	}
}
for($x=0; $x < $h; $x++) {
	for($y=0; $y < $w; $y++) {
		if(isset($matriz[$x -1][$y][0])){
			if(diferenca_valores($y, $x, 10)) {
				imagesetpixel($im, $y, $x, imagecolorallocate($im, 255, 255, 255));
			} else {
				imagesetpixel($im, $y, $x, imagecolorallocate($im, 0, 0, 0));
			}
		}
	}
}
*/
$ref=0;
do{

	$x = 0;
	$y = 0;
	do{

		if(isset($matriz[$x -1][$ref][0])){
			if(diferenca_valores_x($x, $ref, 0)) {
				imagesetpixel($im, $ref, $x, imagecolorallocate($im, 255, 255, 255));
			} else {
				imagesetpixel($im, $ref, $x, imagecolorallocate($im, 0, 0, 0));
			}
		}
		$x++;

	} while(isset($matriz[$x][$ref][0]));

	
	do{

		if(isset($matriz[$ref][$y - 1][0])){
			if(diferenca_valores_x($y, $ref, 0)) {
				imagesetpixel($im, $ref, $y, imagecolorallocate($im, 255, 255, 255));
			} else {
				imagesetpixel($im, $ref, $y, imagecolorallocate($im, 0, 0, 0));
			}
		}
		//imagesetpixel($im, $ref, $y, imagecolorallocate($im, 255, 0, 0));
		$y++;

	} while(isset($matriz[$ref][$y][0]));
	$ref++;

}while(isset($matriz[$ref][$ref][0]));

imagepng($im, 'saidas/imagem_edge.png');





?>
<body>
	<img src='saidas/imagem_edge.png' align="left">
	<img src='imgs/goku.png'>
</body>

<?php
}


?>