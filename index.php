<html>
<head>
<meta charset="utf-8" />
<title> lorem iphpsum </title>
</head>
<body>
	<?php
		$loremText = "";
		$loremIpsumFileContents = file_get_contents("lorem.txt");
  		
		if(array_key_exists('submit',$_POST)){
		   	// read form values and act accordingly
			$loremType=$_POST['lorem_type'];
			$loremValue=$_POST['lorem_value'];
			
			
			// if user wants letters, loop lorem text as often as needed...			
			if($loremType=="letters") {
				// fallback to lower value, because memory 
				if($loremValue > 99999) {
					$loremValue = 99999;
				}
				if ($loremValue > 9384) {
					$loremRepeat = ceil($loremValue / 9384);
					for($i = 1; $i <= $loremRepeat; $i++) {
						$loremIpsumFileContents .= $loremIpsumFileContents;
					}	
				}
				// ...then cut it after the right amount of numbers
				$loremText = substr($loremIpsumFileContents, 0, $loremValue);
				
				// important for keeping the user-selection after formsubmit
				$loremLettersSelected = true;
				$loremWordsSelected = false;
				
			// if user wants words, loop lorem text as often as needed
			} else if($loremType=="words") {
				// fallback to lower value, because memory 
				if($loremValue > 9999) {
					$loremValue = 9999;
				}
				if($loremValue > 1374) {
					$loremRepeat = ceil($loremValue / 1374);
					for($i = 1; $i <= $loremRepeat; $i++) {
						$loremIpsumFileContents .= $loremIpsumFileContents;
					}
				}
				// important for keeping the user-selection after formsubmit
				$loremWordsSelected = true;
				$loremLettersSelected = false;
				
				// split previously generated lorem text after every space to determine number of words
				$loremTextArray = explode(" ", $loremIpsumFileContents);
				// fuse only the right amount of words together afterwards
				if(count($loremTextArray) > $loremValue) {
					$loremText = implode(" ", array_slice($loremTextArray, 0, $loremValue));  
				}
			}
		} else {
			// default Values for both inputs and textbox
			$loremValue = 100;
			$loremWordsSelected = true;
			$loremLettersSelected = false;
			$loremTextArray = explode(" ", $loremIpsumFileContents);
			if(count($loremTextArray) > 100) {
				$loremText = implode(" ", array_slice($loremTextArray, 0, $loremValue));  
			}
		}
	?>
	
	<!-- form -->
	<form id="lorem_settings" method="post">
		<input type="text" name="lorem_value" id="lorem_words" value="<?php echo $loremValue ?>" maxlength="10" size="6"/>
		<select name="lorem_type" id="lorem_type">
			<option value="words" <?php if($loremWordsSelected) { echo 'selected'; } ?>> Wörter </option>
			<option value="letters" <?php if($loremLettersSelected) { echo 'selected'; } ?>>  Buchstaben </option>
		</select>
		<input type="submit" name="submit" value="Generate"/>
	</form>
	
	<textarea id="lorem_textbox" name="lorem_textbox" cols="100" rows="30"><?php echo $loremText; ?></textarea>

</body>
</html>
