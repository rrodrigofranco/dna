<?php
	// check there are no errors
	function getMatchs() {
		$csv1 = array();
		$csv2 = array();
		if(isset($_FILES["csv1"]) && isset($_FILES["csv2"]) && !empty($_FILES["csv1"]["name"]) && !empty($_FILES["csv2"]["name"]) && isset($_POST['plataforma']) ){
			$name1 = $_FILES['csv1']['name'];
			$name2 = $_FILES['csv2']['name'];
			$ext1 = strtolower(explode('.', $_FILES['csv1']['name'])[1]);
			$ext2 = strtolower(explode('.', $_FILES['csv2']['name'])[1]);
			$type1 = $_FILES['csv1']['type'];
			$type2 = $_FILES['csv2']['type'];
			$tmpName1 = $_FILES['csv1']['tmp_name'];
			$tmpName2 = $_FILES['csv2']['tmp_name'];
			$plataforma = $_POST['plataforma'];
			$pos = 1;
			$pos2 = 9;
			if($plataforma == "MyHeritage"){
				$pos1 = 1;
				$pos2 = 9;
			}else if($plataforma == "FTDNA"){
				$pos1 = 0;
				$pos2 = 6;
			}
			// check the file is a csv
			if($ext1 == 'csv' && $ext2 == 'csv'){
				if(($handle1 = fopen($tmpName1, 'r')) != FALSE && ($handle2 = fopen($tmpName2, 'r')) != FALSE) {
					// necessary if a large csv 
					$i = 0;
					
					while(($data1 = fgetcsv($handle1, 1024, ',')) != FALSE) {
						if(sizeof($data1) > 1){
							if($data1[$pos1] != '' && !is_null($data1[$pos1]) && !empty($data1[$pos2]) ){
								$dna1[$i] = $data1[$pos1];
							/*	$dna1Obj = new DNA();
								$dna1Obj->setNome($data1[$pos1]);
								$dna1Obj->setcM($data1[$pos2]);
								$ar_dna1[] = $dna1Obj;*/ 
								$i = $i + 1;
							}
						}
					}
					fclose($handle1);
					$i = 0;
					while(($data2 = fgetcsv($handle2, 1024, ',')) != FALSE) {
						if(sizeof($data2) > 1){
							if($data2[$pos1] != '' && !is_null($data2[$pos1]) && !empty($data2[$pos2])){
								$dna2[$i] = $data2[$pos1];
							/*	$dna2Obj = new DNA();
								$dna2Obj->setNome($data2[$pos1]);
								$dna2Obj->setcM($data2[$pos2]);
								$ar_dna2[] = $dna2Obj;*/
								
								$i = $i + 1;
							}
						}
					}
					fclose($handle2);
				}
				
				//$dna = new DNA();
				
				//echo"<script>console.log('tam = $tam')</script>";
				$dna = array_intersect($dna1, $dna2);
				/*
				for($i = 0; $i < count($ar_dna1); $i++){
					for($j = 0; $j < count($ar_dna2); $j++){
						if($ar_dna1[$i]->getNome() == $ar_dna2[$j]->getNome()){
							$DNA[] = $ar_dna1[$i];
						}
					}
				}
				//$DNA = array_uintersect($ar_dna1, $ar_dna2, function($ar_dna1, $ar_dna2) {
				//	return strcmp(spl_object_hash($ar_dna1), spl_object_hash($ar_dna2));
				//});
				$teste = count($DNA);
				echo"<script>console.log('$teste')</script>";
				//$dna = array_intersect($ar_dna1->getNome(), $ar_dna2->getNome());
				*/
				return $dna;
			}else{
				return "Esse arquivo não é csv!";
				//echo "Esse arquivo não é csv!";
			}
			
		}else{
			return "nada";
		}
	}
	class DNA{

		private $nome;
		private $cM;

		public function setNome($nome){
			return $this->nome = $nome;
		}

		public function setcM($cM){
			return $this->cM = $cM;
		}
		public function getNome(){
		  return $this->nome;
		}
		public function getcM(){
		  return $this->cM;
		}
	}
?>