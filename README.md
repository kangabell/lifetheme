Life Theme
===

Minimalist WordPress theme designed by Chris Glass and built by Kay Belardinelli.

![Website Branding](screenshot.png)

Theme Installation
------------

*   download the [zip file here](https://chrisglass.com/wp-content/uploads/2022/04/lifetheme-1.5.8.zip)
*   in the WP admin, go to Appearance > Themes > Add New, then click “Upload Theme”; upload the zip file
*   click “activate”

Recommended Setup
--------------------------------

*   create a page for homepage, put whatever you want in it
*   create a page for posts/blog, put nothing in it
*   Settings > Reading, under “Your homepage displays” select “A static page”, then set “Homepage” and “Posts page” to the corresponding pages you just made.
*	Settings > Reading, under “Blog pages show at most”, choose a number divisible by 15 (e.g. 15, 30, 60). This will create the optimal grid layout for Favorites and Characters archive pages. Note this settings does not apply to the Posts page, which is set by the theme to 12.

Widget Areas
------------

### Headers (Posts, Projects, Characters, Links, Favorites)

These allow you to customize what appears in the header of the different sections of the website. Add a “Text” widget, and the title will appear as the page heading, along with a paragraph of text in the content of the widget (optional).

### Secondary Content Areas (Homepage, Posts)

Add any content here that you wish, and it will appear below the main content.

Theme Options
-------------

Appearance > Customize

### Site Identity

*   Site Title: appears in the site header, and browser tab/bookmark
*   Tagline: appears in the browser tab/bookmark of homepage, and (optional) in the site header
*   Subfooter: add copyright, privacy, and other info here
*   Display Site Title and Tagline: this toggles the Tagline in the site header
*   Site Icon: add a custom icon to appear in your browser tab/bookmarks
*	Reply Email: add a contact email to display a reply link in RSS feeds

### Colors

*   Link Color: Select any color for text links throughout the site.
*   Dark Mode Link Color: Same as above, but for Dark Mode.

Post Types
----------

*   Posts: the default WordPress post type (generally used as a blog)
*   Projects: use this as a portfolio or to display your finished projects, etc.
*   Favorites: show off all your favorite things <3
*   Links: link to external websites to share with your readers

Menus
-----

### Locations

*   Primary: Drawer/”Hamburger” navigation. Allows up to two levels of depth.
*   Secondary: Horizontal in site header, desktop only (optional)
*   Footer (optional)
*   Projects Submenu (optional): Add links to your Collections here. Can work as a filter.
*   Links Submenu (optional): Add links to your Link Types here. Can work as a filter.
*   Favorites Submenu (optional): Add links to your Favorite Types here. Can work as a filter.

### Adding Website Sections

*   Go to Appearance > Menus
*   In the “Screen Options” tab in the upper right of the page, make sure the following items are checked: Projects, Characters, Links, Pins, Favorites
*   Projects > View All, then select “All Projects” and add to the menu; Repeat for the remaining post types

Custom Fields
-------------

*   “Currently Listening”: Link to an external song or album.
*   Related Characters / Related Posts: Allows you to link Characters to posts and vice versa. These automatically correlate with each other, creating a recipricol relationship. Note: the "	
ACF Post-2-Post" plugin may required for this feature to fully work (to be tested).
*   Sticky Note: Add a little sticky note to any post.

### Installation

*   Install Advanced Custom Fields plugin
*   Go to Custom Fields > Tools; import the json file included in the theme folder
*   If using the Related Characters / Related Posts feature, the add-on plugin "ACF Post-2-Post" is recommended.

WooCommerce
-----------

This theme offers basic support for WooCommerce.

Development
-----------

*   Clone this git repository.
*	The repository does not track css, so the sass must be compiled to css for the theme to work. `cd library` and run `sass --watch sass:css` or something similar.