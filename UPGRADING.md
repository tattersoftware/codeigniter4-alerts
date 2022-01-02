# Upgrade Guide

## Version 2 to 3
***

> Note: This is a complete refactor! Please be sure to read the docs carefully before upgrading.

* All handling is now routed through `AlertsFilter` - read the docs on how to enable the Filter and add the token to your layouts
* Related, the service, exceptions, and language files have been removed
* `Alerts` no longer uses session prefixes but matches to the Config `$classes` - beware of session collision
* The view templates no longer include a wrapper; if you would like consistent behavior then put your token in an `<aside>` tag:
```html
    <aside id="alerts-wrapper">
        {alerts}
    </aside>
```
* This library no longer provides CSS for the wrapper or positioning; if you would like consistent behavior then include the old CSS:
```css
	<!-- CSS for Alerts -->
	<style>
		#alerts-wrapper {
			position: fixed;
			top: 10%;
			right: 10px;
			left: 10px;
			z-index: 10;
		}
		@media screen and (min-width: 768px) {
			#alerts-wrapper {
				left: 60%;
			}
		}
	</style>
```
