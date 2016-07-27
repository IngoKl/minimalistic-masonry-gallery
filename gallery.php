<?php 
error_reporting(E_ERROR | E_PARSE);

//Settings
$galleryTitle = 'Gallery';
$galleryPhotographer = 'Photographer';
$galleryPhotographerEmail = '';
$galleryDescription = 'A Simple Gallery';
$galleryRandomize = false;
$imagesPerPage = 10;
$imageFormat = 'jpg';
$imageDirectory = 'imgs/';

//Retrieval of the images
$images = array();

if (!file_exists($imageDirectory.'sorting.txt')) {
	$imagesInDir = glob($imageDirectory.'*.'.$imageFormat);
	
	if ($galleryRandomize) {
		shuffle($imagesInDir);
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
		$images[] = '<a clas="gallery" href="'.$image.'"><img class="img-vertical" src="'.$image.'" alt="'.$imageExif["FileName"].'" /></a>';
	} else {
		$images[] = '<a class="gallery" href="'.$image.'"><img class="img-horizontal" src="'.$image.'" alt="'.$imageExif["FileName"].'" /></a>';
	}
}

//Function that prints the images
function outputGallery($page) {
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
function outputPagination() {
	global $images;
	global $imagesPerPage;
	$pageNr = intval($_GET["page"]);

	$nrOfPages = ceil(sizeof($images)/$imagesPerPage);

	if ($nrOfPages > 1) {
		if ($pageNr > 0) {
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

//Function that print the number of images in the gallery
function outputNumberOfImages() {
	global $images;
	echo sizeof($images);
}