# Map Block for Order Confirmation

A WordPress plugin that displays a Google Map showing the shipping address on WooCommerce order confirmation pages.

## Description

This plugin adds a map block that automatically displays the shipping address location on WooCommerce order confirmation pages. Simply add the block to your order confirmation template and configure the API key.

### Features
- Automatically displays shipping address from WooCommerce orders
- Configurable map height and zoom level
- Works with Google Maps API
- Simple setup - just add your API key

## Requirements
- WordPress 5.0 or higher
- PHP 7.0 or higher
- WooCommerce installed and activated
- Google Maps API key

## Installation

1. Upload the plugin files to `/wp-content/plugins/map-block-order-confirmation`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Get a Google Maps API key from the Google Cloud Console
4. Add the map block to your order confirmation page template
5. Configure the block settings (height, zoom) as desired

## Configuration

### Getting a Google Maps API Key
1. Visit the [Google Cloud Console](https://console.cloud.google.com)
2. Create a new project or select an existing one
3. Navigate to "APIs & Services" > "Library"
4. Search for "Maps Embed API"
5. Click on "Maps Embed API" in the results
6. Click "Enable"

### Configuring API Key Restrictions
1. In the Google Cloud Console, go to "APIs & Services" > "Credentials"
2. Find your API key and click on it to edit
3. Under "Application restrictions", you can set:
   - HTTP referrers (websites) and add your domain
   - IP addresses if testing locally
4. Under "API restrictions":
   - Select "Restrict key"
   - Choose "Maps Embed API" from the dropdown
5. Save your changes

### Adding the Block
1. Edit your WooCommerce order confirmation page template
2. Add the "Order Confirmation Map" block where you want the map to appear
3. Configure the height and zoom level in the block settings
4. Add your API key in the block settings

## Frequently Asked Questions

### Where should I add the block?
Add it to your WooCommerce order confirmation page template where you want the map to appear. The map will automatically display the shipping address from the order.

### The map isn't showing up
Make sure you have:
1. Added a valid Google Maps API key
2. Enabled the Maps Embed API in your Google Cloud Console
3. Added the block to the order confirmation template
4. The order has a valid shipping address

### Getting "API project not authorized" error?
This usually means the Maps Embed API isn't enabled for your project. Follow the Configuration steps above to enable it in the Google Cloud Console.

## Development

### Building from Source
1. Run `npm install` in the plugin directory
2. Run `npm run build` to compile assets
3. For development, use `npm run dev` to watch for changes

## License
This plugin is licensed under the GPL v2 or later.

## Credits
Created by WP Special Projects 