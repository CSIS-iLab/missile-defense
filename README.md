# Missile Threat

The website for the Missile Threat Project study by CSIS iDeas Lab. It is based off of the TwentyTwenty WordPress theme and gulp, Sass, Autoprefixer, PostCSS, imagemin, and Browsersync to speed-up development.

## Table of Contents

- [Quick-Start Instructions](#quick-start-instructions)
- [Usage](#usage)
  - [Local Development](#local-development)
  - [CI/CD](#build-for-production)
  - [See More Commands](#see-more-commands)
- [Contributing](#contributing)
  - [Branching](#branching)
  - [Commit Messages](#commit-messages)
  - [CSS](#css)
  - [Editor Notes](#editor-notes)
  - [File Structure](#file-structure)

## Quick-start Instructions

### If setting up the project for the first time:

1. Follow the instructions in the "Install Local" and "Connect Local to WP Engine" sections in this [blog post](https://wpengine.com/support/local/).
2. Follow the instructions in the "pull to Local from WP Engine" section to pull the "CSISMag Staging" Environment to your local machine
3. Navigate to the directory where Local created the site: eg `cd /Users/[YOUR NAME]/Local Sites/csismag/app/public`
4. Initiate git & add remote origin. This will connect your local directory to the Git Repo and create a local `main` branch synced with the remote `main` branch.

```shell
$ git init
$ git remote add origin git@github.com:CSIS-iLab/missile-defense.git
$ git fetch origin
$ git checkout origin/main -ft
```

#### Notes

If you pulled the site down from WPEngine, then you might need to make the following adjustments:

- Make sure that you put Jetpack into [dev mode](https://jetpack.com/support/development-mode/). You can do this by adding `define( 'JETPACK_DEV_DEBUG', true );` to `wp-config.php`.
- If images are not loading but are in `wp-content/uploads`, check to see if they're being loaded in over Jetpack's CDN. If they are, you can turn off that setting in the Jetpack settings dashboard in the admin panel.

### If project is already set up:

To begin development, navigate to the theme directory and start npm.

```shell
$ cd wp-content/themes/missile-defense
$ npm install
$ npm start
```

### CI/CD

GitHub Actions will automatically run when pull requests are submitted. If successful:

- Pull requests into `development` will be deployed to the [WP Engine Development Environment](https://csismtdev.wpengine.com/). The Development environment should be used to demo new features to programs. Once approved, a pull request should be submitted to `main`.

- Pull requests in `main` will be deployed to the [WP Engine Staging Environment](http://csismtstaging.wpengine.com/). The Staging environment should be used as a launchpad to add new features to Production.

### See More Commands

This will display all available commands, such as running eslint or imagemin independently.

```shell
$ npm run
```

## Contributing

### Branching

When modifying the code base, always make a new branch. Unless it's necessary to do otherwise, all branches should be created off of `main`.

Branches should use the following naming conventions:

| Branch type               | Name                                                      | Example                     |
| ------------------------- | --------------------------------------------------------- | --------------------------- |
| New Feature               | `feature/<short description of feature>`                  | `feature/header-navigation` |
| Bug Fixes                 | `bug/<short description of bug>`                          | `bug/mobile-navigation`     |
| Documentation             | `docs/<short description of documentation being updated>` | `docs/readme`               |
| Code clean-up/refactoring | `refactor/<short description>`                            | `refactor/apply-linting`    |
| Content Updates           | `content/<short description of content>`                  | `content/add-new-posts`     |

### Commit Messages

Write clear and concise commit messages describing the changes you are making and why. If there are any issues associated with the commit, include the issue # in the commit title.

### CSS

- This project uses the [BEM](http://getbem.com/introduction/) naming convention.
- This project uses [Stylelint](https://stylelint.io) to maintain a consistent code style. Errors are flagged in the console during development and can be automatically fixed by running `npm run stylelint-fix`.

### Editor Notes

- Add `js-resize` to iFrames to have their height be dynamically calculated on their content.

### File Structure

`/assets`
Tracks SCSS, JS, images, and static assets.

`/assets/_js`
There are two subfolders: `custom` and `vendor`. All files in each subfolder is bundled together by WPGulp, returning two minified JS files: `js/custom.min.js` and `js/vendor.min.js`. If you want to bundle additional files, you will need to modify the Gulp workflow.

`/assets/_scss`
The site's styles are stored here. `style.scss` is compiled to `style.css` in the project's root; all other `.scss` files are compiled and moved to `css/**/*.min.css` (eg. `_scss/pages/home.scss` => `css/pages/home.min.css`).

- `/abstracts`: Variables, mixins, functions, and placeholders that are used throughout the project.
- `/base`: Utility classes, typography, and other base styles (like containers) can be kept here.
- `/blocks`: Styles for any theme-specific blocks can be kept here.
- `/components`: Styles for reusable components. If the components are used globally, they should be imported in `style.scss`.
- `/layout`: Styles related to the site layout, such as header, footer, and navigation.
- `/pages`: Styles for standalone pages should be kept here, and should not be partials (no `_` at the beginning of the file name). They will be compiled to `css/pages/*.min.css` and included in `functions.php`.
- `/vendors`: Styles for third-party vendors should be kept here.

`/assets/static`
Any static assets that do not need to be compiled, bundled, optimized, etc. An example would be logo or icon SVGs.

`/classes`
Pulled from the TwentyTwenty theme, these classes help control various functions used on the site.

`/inc`
The includes folder contains functions that will add or change functionality on the site. They are usually included via `functions.php`. The `template_tags.php` file contains functions that are used throughout the site to display components, such as post meta information like the date, authors, etc. `template_functions.php` is used to apply filters to existing WP functionality, like modifying the body classes or modifying the excerpt function.

`/template-parts`
These files are used inside [The Loop](https://codex.wordpress.org/The_Loop) to render blocks of content.

`/templates`
Optional. For post types that can have [different templates](https://developer.wordpress.org/themes/template-files-section/page-template-files/), store those template files here.

`functions.php`
New functionality added to the theme should be added by modifying this file. Assets like JS & CSS are enqueued to the site through this file.

`wpgulp.config.js`
These settings control the workflow in `gulpfile.babel.js`.

## Copyright / License Info

Copyright © 2020 CSIS iDeas Lab under the [MIT License](https://github.com/CSIS-iLab/missile-defense/blob/main/LICENSE).
