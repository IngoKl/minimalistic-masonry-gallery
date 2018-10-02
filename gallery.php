<?php 
error_reporting(E_ERROR | E_PARSE);

//Settings
include('./settings.php');

//Retrieval of the images
$images = array();

if (!file_exists($imageDirectory.'sorting.txt')) {
	$imagesInDir = glob($imageDirectory.'*.'.$imageFormat);
	
	if ($galleryRandomize) {
		shuffle($imagesInDir);
	} else {
		natsort($imagesInDir);
	}

	$fp = fopen($imageDirectory.'sorting.txt', 'w');
	foreach ($imagesInDir as $image) {
		fwrite($fp, $image.PHP_EOL);
	}
	fclose($fp);
}

$imagesInDir = file($imageDirectory.'sorting.txt');
foreach ($imagesInDir as $image) {
	$image = trim($image);
	$imageSize = getimagesize($image);
	try {
		$imageExif = exif_read_data($image);
	} catch (Exception $e) {
		$imageExif["FileName"] = $image;
	}

	if ($imageSize[1] > $imageSize[0]) {
		$images[] = '<a clas="gallery" href="'.$image.'"><img class="img-vertical" src="img.php?i='.$image.'" alt="'.$imageExif["FileName"].'" /></a>';
	} else {
		$images[] = '<a class="gallery" href="'.$image.'"><img class="img-horizontal" src="img.php?i='.$image.'" alt="'.$imageExif["FileName"].'" /></a>';
	}
}

//Function that prints the images
function outputGallery() {
	global $images;
	global $imagesPerPage;

	if ($_GET["page"]) {
		$pageNr = intval($_GET["page"]);
	} else {
		$pageNr = 1;
	}

	$startImage = $pageNr*$imagesPerPage-$imagesPerPage;

	for ($i = 0; $i < $imagesPerPage; $i++) {
		echo $images[$startImage+$i];
	}

}

//Function that prints the pagination
function outputPaginationLower() {
	global $images;
	global $imagesPerPage;
	$pageNr = intval($_GET["page"]);

	if ($pageNr == '') {
		$pageNr = 1;
	}

	$nrOfPages = ceil(sizeof($images)/$imagesPerPage);

	if ($nrOfPages > 1) {
		if ($pageNr > 0 && $pageNr != 1) {
			echo '<li class="arrow"><a href="?page='.($pageNr - 1).'"><</a></li>';
		}

		for ($i = 1; $i <= $nrOfPages; $i++) {
			if ($pageNr == $i) {
				echo '<li class="active"><a href="?page='.$i.'">'.$i.'</a></li>';
			} else {
				echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
			}			
		}

		if (($pageNr + 1) <= $nrOfPages) {
			echo '<li class="arrow"><a href="?page='.($pageNr + 1).'">></a></li>';
		}

	}
}

//Function that prints the abbreviated pagination
function outputPagination() {
	global $images;
	global $imagesPerPage;
	$pageNr = intval($_GET["page"]);

	if ($pageNr == '') {
		$pageNr = 1;
	}

	$nrOfPages = ceil(sizeof($images)/$imagesPerPage);

	if ($nrOfPages > 1) {
		if ($pageNr > 0 && $pageNr != 1) {
			if ($pageNr >= 3) {
				echo '<li class="arrow"><a href="?page=1"><<</a></li>';
			}
			echo '<li class="arrow"><a href="?page='.($pageNr - 1).'"><</a></li>';
		}

		for ($i = -2; $i <= 2; $i++) {
			$finalPageNum = $pageNr + $i;
			if ($finalPageNum <= 0) {
				//Draw nothing
			} else if ($finalPageNum <= $nrOfPages) {
				if ($i == 0) {
					echo '<li class="active"><a href="?page='.$finalPageNum.'">'.$finalPageNum.'</a></li>';
				} else {
					echo '<li><a href="?page='.$finalPageNum.'">'.$finalPageNum.'</a></li>';
				}	
			}
			
					
		}
		
		if (($pageNr + 3) <= $nrOfPages) {
			echo '<li class="arrow"><a href="?page='.($pageNr + 1).'">></a></li>';
			if (($pageNr+4) <= $nrOfPages) {
				echo '<li class="arrow"><a href="?page='.($nrOfPages).'">>></a></li>';
			}
		}
		

	}
}

//Function that print the number of images in the gallery
function outputNumberOfImages() {
	global $images;
	echo sizeof($images);
}