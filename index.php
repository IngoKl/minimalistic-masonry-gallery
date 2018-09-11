<?php
include('gallery.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $galleryTitle; ?></title>
		<meta name="description" content="<?php echo $galleryDescription; ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href="gallery.css" rel="stylesheet">
		<link href="components/colorbox/example2/colorbox.css" rel="stylesheet">

		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>

	<div class="galleryContainer">
		<h1><?php echo $galleryTitle; ?></h1>
		<h2><?php echo $galleryDescription; ?></h2>
		<h3>
		<?php 
		echo $galleryPhotographer;
		if (!empty($galleryPhotographerEmail)) {
			echo '<a href="mailto:'.$galleryPhotographerEmail.'">&nbsp;&#x2709;</a>';
		}
		?>
		</h3>

		<div class="paginationContainer">
			<ul>
			<?php outputPagination(); ?>
			</ul>
		</div>

		<div class="imageContainer">
		<?php outputGallery(); ?>
		</div>

		<div class="paginationLowerContainer">
                        <ul>
                        <?php outputPaginationLower(); ?>
                        </ul>
                </div>
		<footer>
			Es befinden sich <em><?php outputNumberOfImages(); ?></em> Bilder in dieser Gallerie.
		</footer>

	</div>

	<!-- JavaScript for the Masonry-Grid and the Lightbox -->
	<script src="components/jquery/jquery.min.js"></script>
	<script src="vendor/desandro/masonry/dist/masonry.pkgd.min.js"></script>
	<script src="vendor/desandro/imagesloaded/imagesloaded.pkgd.min.js"></script>
	<script src="components/colorbox/jquery.colorbox-min.js"></script>

	<script>
	$(document).ready(function(){
		$(".imageContainer").imagesLoaded(function(){
			$('.imageContainer').masonry({
				itemSelector: 'img',
			});
		});

		$(".imageContainer a").colorbox({rel: 'gallery', maxWidth: '800px', maxHeight: '800px', current: ''});
	});
	</script>

	</body>
</html>
