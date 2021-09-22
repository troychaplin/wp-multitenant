# Changelog

All notable changes to this project will be documented in this file. Sections include Added, Changed, Fixed, and Removed.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.2.0] - 2021-09-21

### Added

- Install script ask for custom wp table_prefix

### Changed

- Moved wp table_prefix from wp-constants.php to site-config.php install file

## [1.1.8] - 2021-08-18

### Fixed

- Fixed constant that prevented uploads from going into the site install area

## [1.1.7] - 2021-07-30

### Changed

- Updated docs
- Updated install script

## [1.1.6] - 2021-07-25

### Changed

- Updated docs

## [1.1.5] - 2021-07-23

### Changed

- Updated docs
- Added gitattributes

## [1.1.4] - Accidentally skipper

## [1.1.3] - 2021-07-21

### Changed

- Updating files for mutli domain usage
- Updated composer file
- Updated install script
- Added bedrock autoloader
- Updated wp-constants
- Updated readme
- Updated install doc

### Removed

- Removed domain from env vars

## [1.1.2] - 2019-12-28

### Fixed

- Updated incorrect symlink to drop-in files in install script

## [1.1.1] - 2019-12-27

### Fixed

- Updated incorrect symlink to htaccess file in install script

## [1.1.0] - 2019-12-27

### Added

- Added shell script for easy top level and second level site installations
- Added query monitor plugin to composer example file

### Changed

- Bumped required version of PHP to 7.2
- Changed WordPress version to use the latest version
- Updated composer example file to be in proper alpha order

## [1.0.1] - 2019-07-14

### Added

- Added additional composer commands to readme

### Changed

- Updated code to meet PSR2 standards
- Updating info in package.json
- Updated env vars in readme
- Updated composer commands in readme

### Removed

- Removed WordPress specific code from .htaccess-standard
- Removed info in readme that recommended to not use this app in prod, this is now prod ready

## [1.0.0] - 2019-07-14

### Added

- Merged release branch 1.0.0 into master
