## Hero section for Prestashop home page

This is just a very basic module that allows an administrator to configure an image and some text on top of it to appear on the home page as well as the cms about page of a prestashop site.
The image is stored in a local image directory inside the module folder so you'll lose it if you reset the module!
However, it also handles the deletion of files if you decide to change the image through the configuration page in the back office so that there is never more than the required files in the image directory.
The code is compatible with Prestashop 9 and later versions only and passes the automatic module validation tests. 

#### Releases

- 1.0.1 Patch so the module works with the new translation system. All the files (and corresponding class names) have been renamed to remove the underscore. If you clone the repository, make sure to rename the directory so that it matches the module's main php file. Or use the release zip.

#### Development

- Make the text configuration fields of type TranslateType so that they can be set for different locales.
