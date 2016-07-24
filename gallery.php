<?php 
error_reporting(E_ERROR | E_PARSE);

//Settings
$galleryTitle = 'Gallery';
$galleryPhotographer = 'Photographer';
$galleryDescription = 'A Simple Gallery';
$imagesPerPage = 10;
$imageFormat = 'png';
$imageDirectory = 'imgs/';

//Retrieval of the images
$images = array();
foreach (glob($imageDirectory.'*.'.$imageFormat) as $image) {
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
	$nrOfPages = ceil(sizeof($images)/$imagesPerPage);

	if ($nrOfPages > 1) {
		for ($i = 1; $i <= $nrOfPages; $i++) {
			echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
		}
	}
}