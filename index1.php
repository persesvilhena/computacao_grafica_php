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

		$im = imagecreatefrompng('php3.png');
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
					
					/*
					for($i=0; $i < $imgY; $i++){
						echo "<tr>";
						for($j=0; $j < $imgX; $j++){	
						imagefilter($im, IMG_FILTER_GRAYSCALE);		
								$rgb = imagecolorat($im, $j, $i);
								$r = ($rgb >> 16) & 0xFF;
								$g = ($rgb >> 8) & 0xFF;
								$b = $rgb & 0xFF;
                                $hsv = RGB_TO_HSV($r, $g, $b);
								
								
								echo "<td data-tooltip=\"$r,$g,$b | $hsv[0],$hsv[1],$hsv[2]\" width='50px' height='50px' style='background-color: rgb($r,$g,$b)' >
                                </td>";
								
				
						}
						echo "</tr>";
					}*/
					?>

					</table>

                  </center>


				
			  </tbody>
		</table>
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