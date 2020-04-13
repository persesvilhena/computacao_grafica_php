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
function RGB_TO_HSV($R, $G, $B)    // RGB values:    0-255, 0-255, 0-255
{                                // HSV values:    0-360, 0-100, 0-100
    // Convert the RGB byte-values to percentages
    $R = ($R / 255);
    $G = ($G / 255);
    $B = ($B / 255);

    // Calculate a few basic values, the maximum value of R,G,B, the
    //   minimum value, and the difference of the two (chroma).
    $maxRGB = max($R, $G, $B);
    $minRGB = min($R, $G, $B);
    $chroma = $maxRGB - $minRGB;

    // Value (also called Brightness) is the easiest component to calculate,
    //   and is simply the highest value among the R,G,B components.
    // We multiply by 100 to turn the decimal into a readable percent value.
    $computedV = 100 * $maxRGB;

    // Special case if hueless (equal parts RGB make black, white, or grays)
    // Note that Hue is technically undefined when chroma is zero, as
    //   attempting to calculate it would cause division by zero (see
    //   below), so most applications simply substitute a Hue of zero.
    // Saturation will always be zero in this case, see below for details.
    if ($chroma == 0)
        return array(0, 0, $computedV);

    // Saturation is also simple to compute, and is simply the chroma
    //   over the Value (or Brightness)
    // Again, multiplied by 100 to get a percentage.
    $computedS = 100 * ($chroma / $maxRGB);

    // Calculate Hue component
    // Hue is calculated on the "chromacity plane", which is represented
    //   as a 2D hexagon, divided into six 60-degree sectors. We calculate
    //   the bisecting angle as a value 0 <= x < 6, that represents which
    //   portion of which sector the line falls on.
    if ($R == $minRGB)
        $h = 3 - (($G - $B) / $chroma);
    elseif ($B == $minRGB)
        $h = 1 - (($R - $G) / $chroma);
    else // $G == $minRGB
        $h = 5 - (($B - $R) / $chroma);

    // After we have the sector position, we multiply it by the size of
    //   each sector's arc (60 degrees) to obtain the angle in degrees.
    $computedH = 60 * $h;

    return array(($computedH / 360), ($computedS / 100), ($computedV / 100));
}


	/*if(isset($_POST['ok'])) {
		if(isset($_FILES['fileUpload'])){
       
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4));
      $new_name = date("Y.m.d-H.i.s").$ext; 
      $dir = 'uploads/'; 
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
   	}*/

		$im = imagecreatefromjpeg('padrao.jpg');
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
					/*for($i=0; $i < $imgX; $i++){
						for($j=0; $j < $imgY; $j++){
							$rgb = imagecolorat($im, $i, $j);
							$r = ($rgb >> 16) & 0xFF;
							$g = ($rgb >> 8) & 0xFF;
							$b = $rgb & 0xFF;
							$cinza = ($r + $g + $b)/3;
                            
							
								echo "<tr>";
								echo "<td>$i</td>";
								echo "<td>$j</td>";
								echo "<td>$r</td>";
								echo "<td>$g</td>";
								echo "<td>$b</td>";
                               // echo "<td>$hsv[0]</td>";
								//echo "<td>$hsv[1]</td>";
								//echo "<td>$hsv[2]</td>";
								echo "<td width='10' style='background-color: rgb($r,$g,$b)' ></th>";
								echo "</tr>";
								
							
				
						}
					}*/
					?>
					<center>
					<table>					
					
					<?php
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
					
					echo "<br>maior r:" . $maior_r . "<br>menor r:" . $menor_r . "<br>maior g:" . $maior_g . "<br>menor g:" . $menor_g . "<br>maior b:" . $maior_b . "<br>menor b:" . $menor_b . 
					"<br>maior h:" . $maior_h . "<br>menor h:" . $menor_h . "<br>maior s:" . $maior_s . "<br>menor s:" . $menor_s . "<br>maior v:" . $maior_v . "<br>menor v:" . $menor_v . "";
					?>
						
					</table>

                  </center>


				
			  </tbody>
		</table>


    </div>