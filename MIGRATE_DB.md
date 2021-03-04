# Database Migration using Migrate DB Pro

Use the below instructions to sync your local environment databaes with the database from our WPEngine Development environment.

## Installation

If you don't have it on your local and remote environments, add and activate the [Migrate DB Pro](https://deliciousbrains.com/wp-migrate-db-pro/) plugin. Login to access the license key.

The documentation below pertains to this specific project, but additional documentation is available on [their website](https://deliciousbrains.com/wp-migrate-db-pro/doc/quick-start-guide/).

## Workflow

When making changes in the WP Admin dashboard, you must make them on the WPEngine Development environment. This plugin allows other devs to pull down those changes to their local environments, ensuring you're testing and working off the same copy of the database.

## To Pull from Development

Pulls Database from: https://csismtdev.wpengine.com/

**Warning:** Pulling the database from the WPEngine Development environment will overwrite any changes you have made to the database locally. Be very sure you don't have anything on your local machine you do not want to lose before pulling.

1. On your local install, go to Tools --> Migrate DB Pro --> Migrate
2. Click "Pull" to replace this site's db with remote DB
3. From the Development Dashboard, go to Tools --> Migrate DB Pro --> Settings, and copy the the "Connection Info" and paste it into the local "Connection Info" box.

- **Note:** If prompted to reset the connection information, you do so on your **local** environment only. Do not update it on the WPEngine Development environment without checking with the team first.

4. It should update the Find & Replace values automatically. If it doesn't, follow this pattern (change as needed):

- Find: `//csismtdev.wpengine.com` replace with `//missile-threat.local`
- Find: `/nas/content/live/csismtdev` replace with `/Users/jschrag/Local Sites/missile-threat/app/public`

5. You can optionally change the pull settings (eg. only pull specific table rows)
6. Save the migration profile for easier transfers in the future.
