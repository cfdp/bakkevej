
Description
-----------


This module provides a range of metatags that can be added to the document head
of each available theme.

In an attempt to keep themes clear of anything that could be considered 
optional, i have aggregated all the frontend related metatags you could ever 
need into one advanced theme settings page which can be found 
at admin/appearance/advanced

Currently Supported Metatags
----------------------------

Mobile Related Metatags

Handheld Friendly
The HandheldFriendly meta-tag was used initially by older Palm 
and Blackberry models as well as browsers like AvantGo.

Mobile Optimized
Microsoft indroduced the MobileOptimized tag for the PocketPC.

Auto Hide Address Bar
Automatically scroll 1 pixel down to hide the address bar.

Safari Links
The script prevents links from opening in mobile safari.

Web App Capable
Makes the web page run in full screen mode when launched from the home 
screen icon; also hides the address bar and component bar at the 
top and bottom of the browser.

Viewport Metatag

This is more widely supported by modern smartphones, including but not limited 
to: mobile, Android, Palm Pre, Blackberry, Windows Phone 7.

Initial Scale
The initial scaling of the page. This should almost always be set to 1.

Minimum Scale
The minimum scaling of the site. This should usually be the same as your Initial
 scale setting.

Maximum Scale
The maximum scaling of the site. This can be any value between 1 and 10, but 
should not be too big if you want to preserve your mobile look and feel.

Scalable by user
Determine if a user can resize the screen. This is usually accomplished via 
multi-touch gestures on mobile and Android devices. If your mobile theme is 
very customized and presented with good typography and graphics for a reduced 
mobile size, it is recommended to leave this setting unchecked. If it is left 
unchecked, the min-scale and max-scale properties will be ignored.

IE Specific Metatags

Suppress IE6 Toolbar
Kill IE6's pop-up-on-mouseover toolbar for images that can interfere with 
certain designs and be pretty distracting in general.

Prompt users to switch to "Desktop Mode" in IE10 Metro
IE10 does not support plugins, such as Flash, in Metro Mode. If your site 
requires plugins, you can let users know that via the X-UA-Compatible meta 
element, which will prompt them to switch to Desktop Mode.

Activate ClearType font smoothing
Mobile IE allows us to activate ClearType technology for smoothing fonts for 
easy reading.

Force latest IE Version
Tell IE it should use the latest, or edge, version of the IE rendering 
environment; second, if already installed, it should use the Chrome frame’s 
rendering engine.

Add google chrome frame
Add google chrome frame script to the footer fo the site.
