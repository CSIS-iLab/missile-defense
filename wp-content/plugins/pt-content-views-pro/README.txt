=== Content Views PRO ===
Author: PT Guy
Website: http://www.contentviewspro.com/
Requires at least: 3.3
Tested up to: 4.5.3
Stable tag: 3.9.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Content Views Pro - Premium plugin which extends awesome features (more powerful settings, more amazing layouts) from the Content Views free plugin

== Description ==

You are using "Content Views PRO" plugin.

This plugin requires :
- WordPress 3.3 or higher
- Free version of Content Views plugin which is available at http://wordpress.org/plugins/content-views-query-and-display-post-page/

You can find documentation here http://docs.contentviewspro.com/

Copyright 2014 by PT Guy http://www.contentviewspro.com/



== Installation ==

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `pt-content-views-pro.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard



== Frequently Asked Questions ==

Please check here http://www.contentviewspro.com/faq/



== Screenshots ==



== Changelog ==

= 3.9.2 =
* Fix: Shuffle Filter shows posts of not selected term
* Fix: background color, padding setting are not updated for new Pinterest/Masonry layout
* New: [Terms as output] Able to show Read more button
* Tweak: Add filter hook to modify value of custom field before querying

= 3.9.1 =
* Fix: Conflict with CloudFlare Rocket Loader

= 3.9 =
* New: Able to use Pinterest, Masonry layout with Shuffle Filter
* New: Able to use View pagination when replacing layout of page (Category, Blog, Archive...)
* New: [One & others layout] Able to show custom field, able to show Read-more button independently (without showing Excerpt)
* New: Able to reusing View by keyword, post ID
* And many small improvements

= 3.8 =
* New: (Shuffle Filter - Group options by Taxonomy): Able to select AND/OR operator for each taxonomy
* New: (Shuffle Filter) Able to show All/Limit posts of selected term on pagination
* New: (Shuffle Filter) Able to load posts automatically when click on term
* New: (Meta fields) Able to choose more than 1 taxonomy in "Let me choose" section
* New: Able to force replacing featured image by image/audio/video in post content
* New: Able to show Full Content of other posts in "One & others" layout

= 3.7 =
* New: Able to show ads (Google Adsense, banner...) randomly in View output with friendly settings
* New: Able to sort posts by Drag & Drop in Preview panel
* Update: Add icons for View types, restructure/update settings to improve usability
* Update: Leverage WordPress core translations for text in View dashboard, View output to minimize user translation effort & improve usability

= 3.6.2.3 =
* New: Complete solution to handle manual excerpt (show its original content, trim & format it like generated excerpt, ignore it)
* Update: Show '...' at end of Title when trimming Title length to specific number of letters

= 3.6.2.2 =
* Update: Remove "View type settings" of Collapsible List (includes 2 features: "open first item" will be implemented by default, "open multiple items at same time" is not user-friendly experience)
* Update: Able to show "Edit Post" link even Post Title was not shown (that link was append to Title in prior versions)

= 3.6.2.1 =
* Fix: Incorrect text align for RTL direction
* Fix: Conflict with Javascript library (imagesLoaded)

= 3.6.2 =
* New: Able to show terms (with thumbnail, title, description) on any layout
* New: [Style Setting] Add "Hover animation", "Caption (Scrollable list)" background color setting (it was configured via Content's background color in prior versions)
* New: Able to show X posts of each selected terms (X is an input number)
* New: [Reuse View] Able to filter posts IN category and NOT IN another category
* Fix: Title hover color does not work in Collapsible list
* Update: Remove default font-size in some View elements
* Update: Disable Line up fields when enable Shuffle Filter (it caused some small style issues)
* Update: Hide "Hide this post" button by default
* Tweak: Add description under "Custom size" setting when images are not same size
* Tweak: Add filter to "exclude another field on mouse over", "change loading icon" by custom PHP code
* Improvement: styles for Pinterest, Glossary list, Hover animation

= 3.6.1.1 =
* Fix: TGM-Plugin-Activation stands as another plugin

= 3.6.1 =
* Fix: Conflict with "mootools-1.2.5-core-yc.js"
* New: Able to disable Hover animation on mobile devices
* New: use TGM-Plugin-Activation library to require, install, update Content Views free

= 3.6.0 =
* Bug fixed: [Shuffle filter] Empty filter text in other languages of WPML plugin
* Improvement: Prevent errors of Masonry layout, Shuffle filter (caused by impacts of scripts from theme/other plugins)
* Improvement: Show option to control behavior with Membership plugin (Ultimate Member, Members, Paid Memberships Pro) & Translation plugin (WPML, Polylang, qTranslate)
* Improvement: Twitter share count are back! Fixed performance issue when enables "Show share count"
* Improvement: [Meta fields settings] cleaner structure, add option to remove slash (/) between fields
* Improvement: Style of Masonry, Shuffle filter dropdown
* Update: Resize image inside post content if uses "Custom size"
* Update: Able to reuse View with "post_parent" parameter

= 3.5.5 =
* Improvement: Smooth Pinterest/Masonry layout when do pagination
* Update: [Shuffle Filter & Pagination] Pull all posts of selected filter (term) on click
* Update: Supports "Members", "Paid Memberships Pro" plugin
* Update: [Infinite pagination] Load posts earlier on scroll
* Bug fixed: "No post found" with Polylang 1.8.0
* Bug fixed: "No post found" when filter by taxonomy, with WPML 3.2
* Bug fixed: Style issue by Social buttons text
* Improvement: Style of WooCommerce price, Hover-animation box
* Improvement: [View dashboard] Add/update description, correct dependencies of some settings

= 3.5.4.1 =
* Bug fixed: Responsive settings for Pinterest layout does not work

= 3.5.4 =
* Improvement: Best "line up fields across items" ever for Grid layout
* Improvement: Better description for settings of "One and others" layout
* Update: Hide post if no content found for current language of qTranslate-X plugin
* Bug fixed: Remove empty space of Masonry, One and others layout

= 3.5.3 =
* Bug fixed: Google font works on preview but not on website
* Bug fixed: Popup window (in Firefox browser) has no scrollbar when open item in new window

= 3.5.2 =
* Bug fixed: Read-more button covers content when resize browser
* Improvement: Better Masonry layout for small screens

= 3.5.1 =
* Improvement: Better responsive output for One & others layout

= 3.5 =
* New feature: Show format icon for Post
* New feature: Custom format for Date custom field
* New feature: Can use Limit setting of View when replace WordPress layout (*check doc*)
* New feature: Can set Limit, Offset when reuse View
* Bug fixed: Duplicated posts, show wrong number of posts per page when order randomly & enable pagination
* Bug fixed: Twitter share does not work with Title contains vertical slash "|"
* Bug fixed: Shuffle filter with numbered pagination
* Update: Can select multiple (instead of all) post types
* Update: Can adjust style of active filter in 3rd style of Shuffle-filter
* Update: Do not shuffle posts automatically when Shuffle-filter is enabled
* Update: Disable custom size thumbnail if screen width < 992 pixels
* Update: Sort posts automatically when select posts for "Include only" setting
* Improvement: **View dashboard revolution** (more friendly Style Settings, simplify/remove/restructure text & description, improve display in Tablet)
* Improvement: Better responsive output
* Improvement: Better Shuffle-filter output

= 3.4 =
* New feature: Able to display taxonomy in special place (sample)
* New feature: Able to show author avatar on every layout
* New feature: Able to select what taxonomy to display terms in Meta fields output
* Improvement: [Pinterest layout] Remove "Minimum width" setting. Update responsive output for small screens.
* Improvement: [Pinterest layout] Restructure & update description of settings
* Improvement: [View dashboard] Able to toggle setting groups under "Fields settings"
* Update: Add option to hide prefix "in" (before terms), prefix "by" (before author name) in Meta fields output
* Update: Simplify description of some settings
* Update: Use flat button (border radius = 0) by default
* Tweak: Update filter "pt_cv_ctf_value"

= 3.3 =
* Bug fixed: Custom field value displays incorrectly when contains URL
* Bug fixed: Line up fields across items does not work when Shuffle Filter is enabled
* Improvement: Better function to resizing image to custom size
* Improvement: Better responsive output of One and others layout
* Improvement: Able to replace pagination of page while replacing page layout
* Improvement: Output of meta-fields in Timeline layout when Hover animation is enabled
* Improvement: How numbered pagination show/hide when Shuffle Filter is enabled
* Improvement: Able to show "Edit Post" on Collapsible list
* Improvement: Better responsive output for "Group filter options" type of Shuffle Filter
* Improvement: Style of Scrollable list, center "Text align", "Edit Post" button, Shuffle Filter, WooCommerce products...
* Update: Prevent posts of child terms from being retrieved when Shuffle Filter is enabled
* Update: Disable "the_content" filter for manual excerpt
* Update: Use View ID in Shuffle Filter ID to easy management
* Update: Disable position setting for "Group filter options" type of Shuffle Filter

= 3.2 =
* New feature: New layout "One and others"
* New feature: Able to set padding for each Item
* New feature: Able to reuse View by another post type, by author
* Bug fixed: Include posts does not work with 'Any post types'
* Bug fixed: Not good output of custom field image in Safari, IE
* Bug fixed: Warning messages relates to Twitter share count function
* Update: Reset Offset when reuse View
* Tweak: Change min-height of Pinterest item

= 3.1.2 =
* Bug fixed: Custom field value displays in 2 lines on Firefox
* Improvement: Thumbnail does not fit Pinterest layout
* Improvement: Cleanup script of Content animation

= 3.1.1 =
* Bug fixed: ACF image not found
* Improvement: Avoid bugs caused by ambiguous comparison

= 3.1 =
* Improvement: Reduce processing time by optimizing conditional statements & functions
* New feature: [Woocommerce 2.4.8] Able to show Sale products with 1 single click
* New feature: [Woocommerce 2.4.8] Able to show Sale badge for products
* New feature: Able to set background color for whole item
* New feature: Able to set color, decoration for Tile on hover
* Bug fixed: Fix bug in support for Paid Membership Pro plugin
* Bug fixed: [Woocommerce 2.4.8] Top rated products does not work
* Bug fixed: Images look distorted when use custom size
* Bug fixed: Custom color of content does not work in some themes
* Improvement: [View dashboard] Better descriptions for some settings
* Improvement: Update styles/scripts of Pinterest layout, custom field, pagination to prevent issue caused by style of theme
* Update: [ACF] Show full image (instead of thumbnail image)

= 3.0 =
* New feature: Make Shuffle Filter works with any types of Pagination
* New feature: [View settings] Able to search posts by Title to include, exclude
* New feature: [View settings] Intuitive button to exclude any post (in preview panel)
* New feature: Able to use "Hover animation" for all layouts
* New feature: Able to center fields in hover box vertically manually
* Bug fixed: Colorbox conflict with other plugins
* Bug fixed: Duplicated ID of multiple Shuffle Filter bars
* Improvement: More sexy Collapsible list
* Improvement: Little better Glossary list
* Improvement: Better style for multiple Shuffle Filter bars
* Improvement: Clean code relates to assets_compress_loading, uncompress_assets
* Update: Style for Masonry overlay
* Update: Style on mobile devices
* Update: Style for media thumbnail with layout-format = 2 columns
* Tweak: Update description of some settings

= 2.5.2 =
* Update: Able to select multiple options for Multi-Shuffle Filter
* Update: Able to use Type "Group filter options by Taxonomy" even for one taxonomy
* Update: Better function to extract images in post content: supports WordPress gallery shortcode & shortcode with format [shortcode_for_image src=""]
* Improvement: Update styles for Shuffle Filter dropdown, Collapsible list, pagination, Hover box

= 2.5.1 =
* New feature: Able to filter by any taxonomies if Content type is 'Any post types'
* Bug fixed: Loading icon was stretched in Pinterest, Masonry layout when option "resize to same width/height" was ticked
* Bug fixed: Term as heading does not work for non-latin term (chinese, russian...)
* Bug fixes: Media thumbnail does not fit its container
* Update: Show Large thumbnail (instead of Full image) for "Light box of Full thumbnail" to minimize load time
* Update: CSS improvements for Pinterest layout, custom field
* Tweak: Add filter 'ctf_value' to alter custom field value

= 2.5 =
* New feature: Able to open Full thumbnail in light box
* New feature: Able to resize thumbnail to same width, height
* Bug fixed: Did not display image/icon when query Media files
* Bug fixed: Round border for hover box when Thumbnail style = Rounded
* Improvement: Better default thumbnail image

= 2.4.1 =
* Bug fixed: Can't click on thumbnail on Mobile devices
* Bug fixed: Media thumbnail does not work

= 2.4 =
* New feature: Able to query Media files, any post types in a View
* New feature: Able to display select term as Heading of View
* New feature: Able to show social share count
* New feature: Able to query "in the past" posts by a date custom field
* Bug fixed: Masonry does not work with pagination
* Bug fixed: Solve problems with category/tag name in non-latin languages
* Bug fixed: Timeline body part is empty when untick "Show Content"
* Improvement: Show loading icon before Pinterest, Masonry layout finished
* Improvement: Restructure Taxonomy custom settings
* Improvement: Better instruction for filtering by Custom field. Correct some condition of date value.
* Improvement: Add link to document "Filter by a Date Custom field"
* Update: [Hover animation] Improve hover animation on mobile devices
* Update: Custom fields - sanitize field name before adds as class name of custom field output
* Update: Modify CSS for custom fields
* Update: CSS for hover animation, Pinterest layout

= 2.3 =
* New feature: [Hover animation] Show content block on click (on mobile devices)
* Bug fixed: Excerpt length does not work with Chinese, Japanese...
* Bug fixed: Error when filter by blank custom date/start date/end date
* Update: Use translation of Content Views free if Read-more text is 'Read More' (default text of this button)
* Update: Add filter "social_url"
* Update: Regenerate POT file
* Update: Some CSS modifications

= 2.2 =
* Bug fixed: Supports Ultimate Member ("Content accessible to Logged Out Users" does not work)
* Bug fixed: [Hover animation] Fix background height
* Bug fixed: Order posts by IDs in the list
* Bug fixed: Uncaught query function not defined for Select2 undefined
* Bug fixed: Grid layout for custom fields applied properties of Grid layout for posts. Which causes problem with Shuffle Filter...
* Improvement: More elegant UI for Fields settings
* New feature: [Hover animation] Able to always show Title without hover

= 2.1 =
* Improvement: Better Masonry layout
* Bug fixed: Missing section in some one-page themes when put multiple View shortcodes to sections
* Bug fixed: Height of hover content box is incorrect when images on row have different heights

= 2.0 =
* New feature: Masonry layout
* New feature: New animation effects for showing content on hover
* New feature: Shuffle Filter uses fade out effect
* New feature: New option "Shadow" for Thumbnail style, which add shadow box to thumbnail
* New feature: Add Opacity for Color picker
* Bug fixed: Broken images when set custom sizes for thumbnail
* Bug fixed: Custom fields is clipped off in small window sizes
* Bug fixed: Can't sort by Price of Woocommerce (ver 2.4.6)
* Update: Handle excerpt length of Chinese language
* Update: New system for updating plugin
* Update: More options for "Parent page"
* Improvement: Add default image when no thumbnail found

= 1.8.9 =
* Bug fixed: "Operator to compare" is not saved after reload
* Bug fixed: Fatal error on PHP < 5.4
* New feature: Able to change Name/Label of custom fields in output
* New feature: Able to display random posts from list "Common filters" > "In list"
* New feature: Able to Force same width, height for Custom size thumbnail
* Update: Can filter by 2 custom taxonomy when reuse a View
* Update: Ignore sticky posts for non-builtin post types
* Improvement: display large video (from value of custom field) in Mobile
* Improvement: Better output for Meta fields

= 1.8.8 =
* New feature: Able to place ALL sticky posts at top of View
* New feature: Able to display colon after name of custom field
* Bug fixed: Distorted image in mobile when custom-size is enable
* Bug fixed: Exclude sticky post does not work
* Bug fixed: Height of Hover content block does not correct in Hidden tab
* Update: Support serialized value of custom field (support wp-types checkbox)
* Improvement: Teak HTML of Timeline layout
* Improvement: Update settings for Excerpt

= 1.8.7 =
* New feature: Able to display content relevant to user's role (supports Ultimate Member plugin)
* Bug fixed: Pinterest displays incorrect number of items per row after pagination finished
* Bug fixed: Height of content-hover box is little insufficient
* Bug fixed: Custom background does not work when displays Readmore text as link
* Update: Display image tag if custom field's value is an image URL

= 1.8.6 =
* Update: Big update to improve page performance
* Bug fixed: Show duplicated inline style of View on page
* Bug fixed: Items per row of Pinterest does not work well
* Bug fixed: Title has no link when enable "Edit Post" button
* Update: Append 'future' status automatically if querying by date 'Today and future'
* Improvement: Reload Pinterest page if post's content contains Iframe

= 1.8.5.1 =
* Improvement: Don't execute shortcode in excerpt automatically, update admin css, fix bug JS admin
* Bug fixed: Show 'Edit Post' button for all users

= 1.8.5 =
* Bug fixed: Can't translate strings
* Bug fixed: Text of social buttons display out of position
* New feature: Able to display nothing (video/audio) if no thumbnail found
* New feature: Custom CSS & JS box in Content Views Setting page
* Improvement: More correction in width of Pinterest item
* Update: Move position of "Style Settings" tab for best user experience

= 1.8.4 =
* Bug fixed: Lot of space between items in Shuffle Filter list
* Bug fixed: Can't filter by value of Custom field
* New feature: Support Polylang plugin (1.7.6)
* New feature: Able to display "Edit Post" button for each post in View
* New feature: Grid layout for Custom fields
* Update: Enable Content, Thumbnail... in Glossary list
* Update: Change name of Mobile_Detect class, to prevent bug 'class existed'

= 1.8.3 =
* Bug fixed: Custom field does not show in Timeline layout
* Bug fixed: Can not set negative value for margin
* Bug fixed: Dropdown menu is hidden
* Bug fixed: Click Youtube video in No-action item causes error in IE

= 1.8.2 =
* Bug fixed: Pinterest does not work if parent element is hidden
* Bug fixed: Glossary heading is not ordered A-Z when add filter 'glossary_title_to_extract'
* New feature: Add "Edit View" button to output of View
* Improvement: Add animation for displaying terms as output
* Update: Move "Text direction" to "Style Settings" tab

= 1.8.1.2 =
* Bug fixed: Unwanted output is displayed in excerpt (caused by enabling filter)
* Update: Add option to enable/disable filter in excerpt

= 1.8.1.1 =
* Bug fixed: Unwanted output is displayed in excerpt (caused by enabling filter)

= 1.8.1 =
* New feature: Add option to display which (image or video/audio), if thumbnail not found
* Bug fixed: Translation does not work in excerpt
* Bug fixed: Number of "items per row" does not work well in Tablet
* Bug fixed: Can not redeclare class Mobile_Detect
* Bug fixed: Can not get Youtube embed video to display as thumbnail
* Update: Remove "Unload Colorbox" option in Settings page. Add filter as alternative solution
* Update: Disable "Don't compress styles & scripts of CVPro"
* Update: Always open link of custom field in new tab/window
* Update: Re-generate .po file

= 1.8.0 =
* New feature: Support "Paid Memberships Pro" plugin
* New feature: Display correspond output if custom field's value is url, email, link to mp3 file, link to mp4 file
* New feature: Hide empty terms (which has no posts) in Shuffle Filter list
* New feature: Able to adjust "All" word in Shuffle Filter list
* Update: More option for filtering by Custom fields
* Update: Restructure plugin's core functions & variables
* Update: Use alt tag of post thumbnail for Pinterest sharing button
* Update: Remove special chars from Glossary header
* Bug fixed: Can not click on Glossary header in Preview panel
* Bug fixed: The collapsible list does not toggle when click on "+, -" icon
* Bug fixed: Shuffle Filter does not work
* Bug fixed: Can not order posts by "In list"

= 1.7.2 =
* New feature: Able to change style of Woocommerce "Add to cart" button
* New feature: Add "Report bug" button
* Bug fixed: 'array_replace' Function undefined in PHP < 5.3
* Bug fixed: Can't save Font style in Style Settings tab
* Bug fixed: Can't save display order of selected terms
* Update: Update style & behavior of pagination for Timeline layout
* Update: Update social link of Twitter, Pinterest
* Update: Execute shortcode in Excerpt
* Update: Decrease minimum item width of Pinterest layout
* Update: Better excerpt for Chinese content

= 1.7.1 =
* Improvement: Better responsive for mobile devices

= 1.7.0 =
* Bug fixed: Pagination does not work in page has more than 2 Pinterest Views
* Bug fixed: Blank space in layout which uses Shuffle Filter
* New feature: Able to display Social share links (Facebook, Twitter, Google +, LinkedIn, Pinterest)
* New feature: Able to set number of items per row in Mobile devices
* New feature: Include or exclude posts of children taxonomies
* Update: Resize thumbnail on the fly when 'custom size' is selected
* Update: Able to execute shortcodes before generating excerpt

= 1.6.9 =
* Bug fixed: Multiple paginations on same page do not work
* Bug fixed: Can not re-use a View
* New feature: Filter written/not written by current user

= 1.6.8 =
* Bug fixed: Does not display enough terms ("Display selected terms as output" feature)
* Bug Fixed: "Line up fields" is broken when window resizes
* Bug fixed: Thumbnail is distorted in Tablet
* New feature: Get one post of each selected terms
* New feature: Able to set border-radius of buttons
* Update: Able to use Shuffle Filter with "Normal" Pagination
* Improvement: Force displaying higher dimensions on Mobile

= 1.6.7 =
* Bug fixed: RTL does not work
* Bug fixed: Pinterest layout does not display images on Mobile
* Update: Able to display only index of Glossary layout
* New feature: Able to display terms (category item, tag item...) as output

= 1.6.6 =
* New feature: Glossary list
* New feature: Able to get fields of current post
* Bug fixed: "Read more" button in Grid layout covers content area
* Bug fixed: Media Thumbnail is not shown if Thumbnail size is "Original resolution..."
* Update: Support ACF "Page link" field
* Update: Date format in Timeline view is controllable with 2 options: human readable format OR WordPress format (default value)

= 1.6.5 =
* New feature: Able to display "Read more" as a link, not button
* New feature: Able to configure minimum width of Pinterest item
* New feature: Beautify name of custom field automatically
* Improvement: Enable assets (libraries, view types, common) compression
* Improvement: Update code quality

= 1.6.4 =
* Bug fixed: Googlebot doesn't fetch Pinterest content
* Bug fixed: Colorpicker doesn't work
* Bug fixed: Repeater fields of ACF shows duplicated content
* New feature: Items on filter options bar will be sorted by their appearance in "Select terms" option when "Operator" is "IN" or "AND"

= 1.6.3 =
* Bug fixed: Pinterest layout is broken after paging
* New feature: Able to use Normal pagination (without Ajax)
* New feature: Excludes current post from View output
* New feature: [Advanced filter - Date] Able to display "Today and future" posts (no past posts)
* New feature: [Advanced filter - Custom fields] Able to display "Greater or Equal Today" posts (no past posts)
* New feature: [Pinterest layout] Able to hide bottom border of each fields

= 1.6.2 =
* Bug fixed: Pinterest layout is broken when pagination
* Bug fixed: Center layout disappears when resize window
* New feature: Able to Sort by order of appearance in "Common filters > In list"
* New feature: New option to set Nofollow for item links

= 1.6.1 =
* Bug fixed: Stripped content in Shuffle Filter list
* Update: Add 'EXISTS', 'NOT EXISTS' options to filter by Custom fields
* Update: Able to adjust Font settings for Numbered pagination
* Improvement: Show human readable format (meta field)
* Improvement: Better Pagination style
* Improvement: Update descriptions and positions of setting options

= 1.6.0 =
* New Feature: Hide empty custom field
* New Feature: Prepend sticky posts to beginning of output
* Bug fixed: Fix some bugs with Easy Digital Download
* Bug fixed: Fix warning with ACF select box
* Bug fixed: Editors still can see CVPro setting menu when set Administrator for "User role who can manage Views"
* Bug fixed: 'No post found' when reuses a View with a numeric term value
* Bug fixed: Can't set background color for Scrollable list

= 1.5.0 =
* Bug fixed: Important bug which reset settings on front-end

= 1.4.9 =
* New Feature: Enable to limit Title length (letters)
* New Feature: More options for Sticky posts (prepend to output)

= 1.4.8 =
* Bug fixed: Override WP layout shows empty output
* Bug fixed: Scrollable's transition does not look good in Safari
* Bug fixed: Pinterest layout is weird when click pagination button
* Improvement: Better responsive Pinterest layout
* Improvement: Re-arrange options for Scrollable List
* Improvement: Code refinement

= 1.4.6 =
* Bug fixed: Items in view type are cut off height
* Bug fixed: Shuffle Filter - Match wrong terms if they contain a same string
* Improvement: Better Pinterest layout when browser resizes

= 1.4.5 =
* Bug fixed: Layout is broken when overrides layout of WordPress
* Bug fixed: Layout of Shuffle Filter list is broken
* Bug fixed: Dimensions of image was incorrect if that was image inside content of post

= 1.4.4 =
* Bug fixed: Shuffle Filter has gap after sorting
* Bug fixed: Wrong 'ago' time of Timeline
* Bug fixed: Browser opens new tab in Firefox with 'No action' of 'Open item in'
* Bug fixed: 'Show content on hover' display does not well if thumbnails have different dimensions
* New Feature: Order by Custom fields
* New Feature: Reuse a View - able to filter by multiple taxonomies
* Update: Don't auto select 'Or automatically set current page (or its parent) as Parent for the list'
* Update: Lightbox does not display well in mobile if width, height as 50% x 50%

= 1.4.3 =
* Improvement: A very new customized Bootstrap style
* Bug fixed: Style settings of Title doesn't work when select 'None' as 'Open item in'

= 1.4.2 =
* New Feature: Order by 'Page Order'

= 1.4.1 =
* Bug fixed: Show 'custom-fields' instead of name of custom field

= 1.4 =
* Bug fixed: Pinterest layout is broken when View is loaded by Ajax
* Bug fixed: Icons is not displayed correctly in Meta fields when select custom font-family
* New Feature: Animation & Effect - Show Content on hover
* New Feature: Infinite scrolling pagination
* New Feature: Line up fields (Title, Content...) across items
* Update: Able to show/hide '...' at tail of Excerpt
* Update: Refine Javascript code for Preview/Front-end

= 1.3.6 =
* New Feature: Automatically set current page (or its parent) as Parent for the list (when filter by Parent page)
* Bug fixed: Don't show 'Read more' button if manual excerpt length is smaller than 'Excerpt length'
* Update: Auto trim manual excerpt by 'Excerpt length'

= 1.3.5 =
* New Feature: Filter by Custom field
* Update: Add class for each ACF field, remove link from image field
* Update: Able to display fields dynamically in Pinterest layout

= 1.3.4.1 =
* Bug fixed: Read more settings does not work

= 1.3.4 =
* Update: Support most types of Advanced Custom Fields (ACF)
* Update: Able to drag & drop to change display order of Custom Fields
* Update: Extends feature "overwrite output of WordPress by CVPro layout", allow to pass array of $post

= 1.3.3 =
* New Feature: Filter by Date
* New Feature: Add Text align option
* Update: Auto load refined Bootstrap for Pro users by default

= 1.3.2.3 =
* Bug fixed: Fix bugs of Shuffle Filters (by multiple taxonomies)

= 1.3.2.2 =
* Bug fixed: Custom thumbnail sizes affect other Views in same page
* Improvement: Better label for Background color option in 'Font settings' section

= 1.3.2.1 =
* Bug fixed: Fix display problem when use large font size
* Bug fixed: Fix teaser/more tag problem

= 1.3.2 =
* New Feature: Group filter options by Taxonomies (for Shuffle Filter feature)
* New Feature: Pinterest layout with "Border box" style
* Improvement: Refine layout rendering mechanism of Pinterest

= 1.3.1.1 =
* Bug fixed: Style settings is not applied when replace WordPress layout by CVPro layout
* Update: Restructure Taxonomy filter (remove "Not In" list, add operator[In, Not in, And])
* Improvement: Update style for WooCommerce (Add to cart button)

= 1.3.1 =
* Update: Completely new documentation with lot of update
* New Feature: Customizable Load more button (text of button, Font settings [color, font family, font style, font size])

= 1.3.0.2 =
* New Feature: Able to load only content of post in Lightbox

= 1.3.0.1 =
* Update: Small update for responsive layout in smartphones

= 1.3.0 =
* New Feature: Able to show Custom fields and control its style (font, color)
* New Feature: Auto extract Youtube, Vimeo, Dailymotion, Soundcloud from posts if thumbnail is not found and there is no image in post content
* Improvement: Control style of "Read more" button, Filter options completely (font, color, background color)
* Improvement: Always display an even number of items per row in smaller device (to remove gap/space in rows)

= 1.2.6 =
* Update: Important update about caching mechanism
* Update: Update translation file

= 1.2.5 =
* Improvement: Add option to load refined Bootstrap style (which removed font-size, color properties of Bootstrap for Heading, Link...)
* Update: Able to use 2 columns format in Pinterest layout
* Update: Force to resize image to selected custom sizes
* New Feature: Able to control what user role can manage (add, edit, delete) View
* New Feature: Duplicate a View

= 1.2.4.4 =
* Bug fixed: Images are not displayed in same dimensions

= 1.2.4.3 =
* Bug fixed: Thumbnail is not shown up in Timeline layout

= 1.2.4.2 =
* Update: Add option to decide whether or not to insert icon before meta fields
* Improvement: Show notices if Free plugin is not installed and activated

= 1.2.4.1 =
* Improvement: Adjust some styles for Shuffle Filter options, output generated by replacing WordPress layout by CVPro layout
* Update: Update documentation

= 1.2.4 =
* Improvement: A faster solution for overwriting output of WordPress template file
* Improvement: Better meta fields display (add icons, remove prefix text, remove '/' separator)
* Improvement: Add options to customize margin of View, color of fields. Move Font settings to "Style Settings" tab
* Improvement: Add option to get manual excerpt if it exists
* Improvement: Add option to hide sticky posts from output
* Improvement: Add option to customize border radius for rounded thumbnail
* Improvement: Add option to whether or not to open first item at page load (for Collapsible list)
* Improvement: Add constraint checking for Shuffle Filter (with Pagination and View type)

= 1.2.3 =
* Fix Colorbox style conflict: Add option to unload Colorbox assets in frontend
* Add Shuffle Filter feature
* Add "None" option to "Open item in"
* Update mobile, tablet breakpoints (show as many items as possible in mobile, tablet)
* Update: Enable to set offset value is greater than limit value

= 1.2.2 =
* Right to Left support

= 1.2.1 =
* Add new feature: Completely replace Taxonomy archive page by a configurable View

= 1.2.0 =
* Add Alignment option for Pagination
* Add options to quickly filter Terms (Start with, End with character)
* Add option to only display taxonomies which their terms are checked to filter posts (for case you only want to display Category or Tag)
* Fix Woocommerce order & orderby bug
* Optimize filters system

= 1.1.1 =
* Fix bug of width of item in Pinterest layout in mobile

= 1.1 =
* Activate/Deactivate request
* WooCommerce support: Quick filter products, show Price & Add to cart
* Update text of Preview button after sort fields/meta fields

= 1.0.5 =
* Fix offset bug for pagination

= 1.0.4 =
* Fix bug (remove warning when deactivate Free package)
* Fix minimum value bug of Offset option

= 1.0.3 =
* Fix bug (doesn't work with Free package in some cases)

= 1.0.2 =
* Add "Offset" option
* Do action only if Free plugin is installed

= 1.0.1 =
* Fix notice when update Free version

= 1.0.0 =
* Initial release
* Fix bug (doesn't work with Free package from wordpress.org)
* Update Timeline layout