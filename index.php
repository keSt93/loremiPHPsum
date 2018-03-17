<html>
<head>
<meta charset="utf-8" />
<title> lorem iphpsum </title>
</head>
<body>
	<?php
		$loremText = "";
		$loremIpsumFileContents = file_get_contents("lorem.txt");
  
		// check if our form has been submitted...
		if(isset($_POST['submit'])){
			
			// read form values and act accordingly
			$loremType=$_POST['lorem_type'];
			$loremValue=$_POST['lorem_value'];
						
			if($loremType=="letters") {
				if ($loremValue > 9384) {
					$loremRepeat = ceil($loremValue / 9384);
					for($i = 1; $i <= $loremRepeat; $i++) {
						$loremIpsumFileContents .= $loremIpsumFileContents;
					}	
				}
				$loremText = substr($loremIpsumFileContents, 0, $loremValue);
				
			} else if($loremType=="words") {
				if($loremValue > 1374) {
					$loremRepeat = ceil($loremValue / 1374);
					for($i = 1; $i <= $loremRepeat; $i++) {
						$loremIpsumFileContents .= $loremIpsumFileContents;
					}
				}
				$loremTextArray = explode(" ", $loremIpsumFileContents);
				if(count($loremTextArray) > $loremValue) {
					$loremText = implode(" ", array_slice($loremTextArray, 0, $loremValue));  
				}
			}
		}   
	?>
	
	<!-- form -->
	<form id="lorem_settings" action ="" method="post">
		<input type="text" name="lorem_value" id="lorem_words" value="200" maxlength="10" size="6"/>
		<select name="lorem_type" id="lorem_type">
			<option value="words" selected="true"> Wörter </option>
			<option value="letters">  Buchstaben </option>
		</select>
		<input type="submit" name="submit" value="Generate"/>
	</form>
	
	<textarea id="lorem_textbox" name="lorem_textbox" cols="100" rows="30"><?php echo $loremText; ?></textarea>

</body>
</html>
