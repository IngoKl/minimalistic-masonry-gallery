# Minimalistic Masonry Gallery
This is a minimalistic image/photo gallery written in PHP. It grabs images from a given folder and generates a minimalistic, but appealing gallery.

![Screenshot](https://github.com/IngoKl/minimalistic-masonry-gallery/blob/master/minimalistic-masonry-gallery.png?raw=true)

## Features
- Extremely easy to use and setup
- Simple pagination
- Image shuffling
- A responsible masonry layout powered by [masonry.js](http://masonry.desandro.com)
- Lightbox integration powered by [colorbox](http://www.jacklmoore.com/colorbox)

## Usage
Upload the files to a webserver and run `composer` in order to get the dependencies. Adjust some basic settings in the `gallery.php` and upload you images to the /imgs folder. The /imgs folder should be writeable by the script.

After uploading new images, the `imgs/sorting.txt` file should be deleted for reindexing.
