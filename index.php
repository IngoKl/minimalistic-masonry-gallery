<?php
include('gallery.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $galleryTitle; ?></title>
		<meta name="description" content="<?php echo $galleryDescription; ?>">
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href="gallery.css" rel="stylesheet">
		<link href="colorbox2.css" rel="stylesheet">
		<link href="components/colorbox/example3/colorbox.css" rel="stylesheet">

		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>

	<div class="galleryContainer">
		<h1><?php echo $galleryTitle; ?></h1>
		<h2><?php echo $galleryDescription; ?></h2>
		<h3><?php echo $galleryPhotographer; ?></h3>

		<div class="paginationContainer">
			<ul>
			<?php outputPagination(); ?>
			</ul>
		</div>

		<div class="imageContainer">
		<?php outputGallery(); ?>
		</div>
		
	</div>

	<!-- JavaScript for the Masonry-Grid and the Lightbox -->
	<script src="components/jquery/jquery.min.js"></script>
	<script src="vendor/desandro/masonry/dist/masonry.pkgd.min.js"></script>
	<script src="components/colorbox/jquery.colorbox-min.js"></script>

	<script>
	$('.imageContainer').masonry({
		itemSelector: 'img',
	});

	$(document).ready(function(){
		$(".imageContainer a").colorbox({rel:'gallery', maxWidth: '800px', maxHeight: '800px'
			,arrowKey: 'false', escKey: 'false', current: ''});
	});
	</script>

	</body>
</html>