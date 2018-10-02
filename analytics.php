<?php
//Create CSV file
if (!file_exists('analytics.csv')) {
	file_put_contents('analytics.php', '');
}

//Function that counts and individual view
function addView($imgName) {
	$csv = array_map('str_getcsv', file('analytics.csv'));
	$csv_file = fopen('analytics.csv', 'w');

	$updated = false;

	foreach ($csv as $img) {
		if ($img[0] == $imgName) {
			$img[1]++;
			$updated = true;
		}
	
		fputcsv($csv_file, $img);
	}

	if (!$updated) {
		fputcsv($csv_file, array($imgName, 1));
	}
	
	fclose($csv_file);

}

function printViews() {
	$csv = array_map('str_getcsv', file('analytics.csv'));
 	
	echo '<ul>';
	foreach ($csv as $img) {
		echo '<li>'.$img[0].' - '.$img[1].'</li>';
	}
	echo '</ul>';
}

if (isset($_GET['show'])) {
	if ($_GET['show'] == 'views') {
		printViews();
	}
}

?>
