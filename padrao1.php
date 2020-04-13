<link rel="stylesheet" type="text/css" href="css/pace.css">

<?php
function RGB_TO_HSV($R, $G, $B)
{

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
	$im_padrao = imagecreatefromjpeg('padrao3.jpg');
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

</head>
    
	
	
<body>

</body>
</html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">



<div class="container">



	<?php
	for($x = 3; $x < 10; $x++){
		$nome_imagem = "imagem0" . $x . ".jpg";
		$im = imagecreatefromjpeg($nome_imagem);
		//imagefilter($im, IMG_FILTER_EDGEDETECT);
		$imgX = imagesx($im);
		$imgY = imagesy($im);
	?>	
		<table>
		
		<?php
		
		
		for($i=0; $i < $imgY; $i++){
			echo "<tr>";
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
						$r = $r + 100;
						echo "<td width='1px' height='1px' style='background-color: rgb($r,$g,$b)' >
						</td>";
					}else{
						echo "<td width='1px' height='1px' style='background-color: rgb($r,$g,$b)' >
						</td>";
					}
			}
			echo "</tr>";
		}
		?>

		</table>

		<br>
		<img src="<?php echo $nome_imagem; ?>" style="width: 50%; height: 50%;">
	<?php
	}
	?>

    </div>
	<div class="col-md-12">
	<div class="col-md-3">
		<a href="index.php" class="btn btn-danger btn-lg btn-block" role="button">Voltar</a>
	</div>
</div>
<script type="text/javascript" src="js/pace.min.js"></script>