<?php
	$csv1 = array();
	$csv2 = array();
	// check there are no errors
	if($_FILES['csv1']['error'] == 0 && $_FILES['csv2']['error'] == 0){
		$name1 = $_FILES['csv1']['name'];
		$name2 = $_FILES['csv2']['name'];
		$ext1 = strtolower(explode('.', $_FILES['csv1']['name'])[1]);
		$ext2 = strtolower(explode('.', $_FILES['csv2']['name'])[1]);
		$type1 = $_FILES['csv1']['type'];
		$type2 = $_FILES['csv2']['type'];
		$tmpName1 = $_FILES['csv1']['tmp_name'];
		$tmpName2 = $_FILES['csv2']['tmp_name'];

		// check the file is a csv
		if($ext1 == 'csv' && $ext2 == 'csv'){
			if(($handle1 = fopen($tmpName1, 'r')) != FALSE && ($handle2 = fopen($tmpName2, 'r')) != FALSE) {
				// necessary if a large csv 
				$i = 0;
				while(($data1 = fgetcsv($handle1, 1024, ',')) != FALSE) {
					if(sizeof($data1) > 1){
						$dna1[$i] = $data1[1];
						$i = $i + 1;
					}
				}
				fclose($handle1);
				$i = 0;
				while(($data2 = fgetcsv($handle2, 1024, ',')) != FALSE) {
					if(sizeof($data2) > 1){
						$dna2[$i] = $data2[1];
						$i = $i + 1;
					}
				}
				fclose($handle2);
			}
			$dna = array_intersect($dna1, $dna2);
			$dna = array_filter($dna, fn($value) => !is_null($value) && $value !== '');
			echo '<div align = "center"';
			foreach ($dna as $key => $value) {
				if ($key > 0)
					echo ''.$value.'';
					echo '<br>';
			}
			echo '</div>';
		}else{
			echo "Esse arquivo não é csv!";
		}
		
	}	
	
?>