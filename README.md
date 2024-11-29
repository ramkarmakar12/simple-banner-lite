# Getting Started with the plugin `Simple Banner Lite`

This plugin is made for wordpress site to add announcement banner in the site.


## Getting Ahead

Prerequisite:
Must have a wordpress site hosted or built on local server using : https://localwp.com/\
Have Access to the database and admin panel of the site

In the wordpress project admin directory, you can run:

Go to plugin section ->
Click on add new plugin ->
Click on upload plugin -> 
upload the zip file of the plugin ->
click on activate plugin ->
Plugin details can be shown from installed plugin section ->
A new section added below settings named `Simple banner Lite`

On clicking on it redirects to the settigs where we can modify and banner and it will be reflected over website.

The plugin created and tested on Local server created on localwp.

### Folder structure

Simple Banner Lite/
├── Simple-banner-ite.php  (Main plugin file)
├── assets/
│   ├── css/
│   │   └── style.css         (Custom CSS for the banner)
│   ├── js/
│   │   └── script.js         (Custom JavaScript for dynamic behavior)
├── includes/
│   └── settings-page.php     (Settings page logic)
├── templates/
│   └── banner.php            (HTML template for the banner)


### Unit tests

The unit testcases tested against the basic functionalty of the plugin and ran with  `phpunit` with composer.\

### Architechtural Diagram

Used eraser.io for TDD and diagram for the plugin workflow with a generic workflow for creating a wordpress plugin.\
Access it here : https://app.eraser.io/workspace/3qKs3VS8utMcYqNn3KlI


### Code Splitting

The code made sort of modular by keeping files in different folders.\

### Making a Progressive Web App

The plugin is created and maintained by me.\
Added readme.text file to submit it to wordpress plugin repo.

