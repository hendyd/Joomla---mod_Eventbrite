# Mod_Eventbrite v.0.0.7

## What is it used for?
This module will be used for displaying events from Eventbrite in Joomla. 

## What will you need?
* A Joomla website
* Access within Joomla to upload extensions
* An Eventbrite login
* An Eventbrite API key

## Installation
This module is installed on Joomla. 
1. [Download a ZIP folder of this repository](https://github.com/2buy2-com/Joomla---mod_Eventbrite/archive/refs/heads/master.zip)
2. Navigate to [WEBSITE DOMAIN]/administrator/index.php?option=com_installer 
3. Ensure the module is uploaded as expected. If there are any issues, [please log them here](https://github.com/2buy2-com/Joomla---mod_Eventbrite/issues/new)

## Usage
Once installed, please enable the module in [WEBSITE DOMAIN]/administrator/index.php?option=com_advancedmodules.
You will be required to enter in the API key and Organization ID. If you do not have an API key, [go here](https://www.eventbrite.com/platform/api-keys/). To obtain the Organization ID, [please follow these instructions](https://help.signaturesatori.com/en/articles/1002985-how-to-obtain-eventbrite-organizer-id).
You are also able to determine how many events you would like to display from within the module. By default, this is set to 1.

## Maintenance
The styling of this module is primarily written in SASS. Please update the ```/assets/css/mod_eventbrite.scss``` file and convert it to CSS. [Live SASS converter for VS Code](https://marketplace.visualstudio.com/items?itemName=ritwickdey.live-sass) is a useful extension for this.
By using Joomla's in-built template overrides, you are also able to override the existing layout within your Joomla instance. For more information on how to do this, please see: [Joomla layout documentation](https://docs.joomla.org/J3.x:Layout_Overrides_in_Joomla#Module_Alternative_Layouts).
