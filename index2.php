<!DOCTYPE html>
<html>
<head>
	<title>Computação Gráfica</title>
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

	/*if(isset($_POST['ok'])) {
		if(isset($_FILES['fileUpload'])){
       
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4));
      $new_name = date("Y.m.d-H.i.s").$ext; 
      $dir = 'uploads/'; 
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
   	}*/

		$im = imagecreatefrompng('teste.png');		
		$imgX = imagesx($im);
		$imgY = imagesy($im);

	
	
	function RGB_TO_HSV ($R, $G, $B){
	
   	$HSL = array();

   $var_R = ($R / 255);
   $var_G = ($G / 255);
   $var_B = ($B / 255);

   $var_Min = min($var_R, $var_G, $var_B);
   $var_Max = max($var_R, $var_G, $var_B);
   $del_Max = $var_Max - $var_Min;

   $V = $var_Max;

   if ($del_Max == 0){
      $H = 0;
      $S = 0;
   }else{
      $S = $del_Max / $var_Max;

      $del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
      $del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
      $del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;

      if      ($var_R == $var_Max) $H = $del_B - $del_G;
      else if ($var_G == $var_Max) $H = ( 1 / 3 ) + $del_R - $del_B;
      else if ($var_B == $var_Max) $H = ( 2 / 3 ) + $del_G - $del_R;

      if ($H<0) $H++;
      if ($H>1) $H--;
   }

   $HSL['H'] = $H;
   $HSL['S'] = $S;
   $HSL['V'] = $V;

   return $HSL;
   }
   
   ?>
	<table class="table table-striped">
	
		<table class="table">
			  <thead>
			    <tr>
			      <th width="100">Posição X</th>
			      <th width="100">Posição Y</th>
			      <th style="color: red">H</th>
			      <th style="color: green">S</th>
			      <th style="color: blue">V</th>
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
							
							
							
								echo "<tr>";
								echo "<td>$i</td>";
								echo "<td>$j</td>";
								echo "<td>$hsv[H]</td>";
								echo "<td>$hsv[S]</td>";
								echo "<td>$hsv[V]</td>";
								echo "<td width='10' style='background-color: rgb($r,$g,$b)' ></th>";
								echo "</tr>";
								
							
								
							
				
						}
					}
					?>
					
					<table >					
					
					<?php
					
					
					for($i=0; $i < $imgY; $i++){
						echo "<tr>";
						for($j=0; $j < $imgX; $j++){			
								$rgb = imagecolorat($im, $j, $i);
								$r = ($rgb >> 16) & 0xFF;
								$g = ($rgb >> 8) & 0xFF;
								$b = $rgb & 0xFF;
								
								echo "<td width='50px' height='50px' style='background-color: rgb($r,$g,$b)' ></td>";
								
				
						}
						echo "</tr>";
					}
					?>

					</table>




				
			  </tbody>
		</table>

