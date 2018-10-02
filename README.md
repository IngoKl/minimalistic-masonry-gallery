# Minimalistic Masonry Gallery
This is a minimalistic image/photo gallery written in PHP. It grabs images from a given folder and generates a minimalistic, but appealing gallery.

![Screenshot](https://github.com/IngoKl/minimalistic-masonry-gallery/blob/master/minimalistic-masonry-gallery.png?raw=true)

## Features
- Extremely easy to use and setup
- Simple pagination
- Image shuffling
- A responsible masonry layout powered by [masonry.js](http://masonry.desandro.com)
- Lightbox integration powered by [colorbox](http://www.jacklmoore.com/colorbox)
- Very basic analytics capabilities (views)

## Usage
Upload the files to a webserver and run `composer` in order to get the dependencies. Adjust some basic settings in 
`settings.php` and upload you images to the /imgs folder. The /imgs folder should be writeable by the script. If you want to use the analytics functionality, you'll need a writeable `analytics.csv` file in the main folder.

After uploading new images, the `imgs/sorting.txt` file should be deleted for reindexing.

### Basic Analytics
If the option `$simpleAnalytics` is set to true, the gallery will count how often individual images were loaded. You can access these statistics by looking at *analytics.php?show=views*. It is **not** recommended to use this feature with larger galleries since it is not optimized and slows down the load time of the page.

### Composer
If you don't have [composer](https://getcomposer.org/) installed, run `curl -sS https://getcomposer.org/installer | php` followed by `php composer.phar install`. 