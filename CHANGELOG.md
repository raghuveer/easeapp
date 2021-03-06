# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [3.6.4] - 2018-11-11
### Added
- "Expose headers in CORS function", is added in this release.

### Changed
- "Login Feature Bug Fixes", in this release.


## [3.6.3] - 2018-11-09
### Added
- "Separate Header Functions file", is added in this release.

### Changed
- "Login Feature Bug Fixes", in this release.


## [3.6.2] - 2018-11-08
### Added
- "JWT specific JWS related Algorithm field", is added in user_auth_tokens db table, in this release.


## [3.6.1] - 2018-11-05
### Added
- "PHPMailer v6.05", is added in this release.
### Removed
- "PHPMailer v6.02", ts removed in this release.
- "OPAuth", is removed in this release.


## [3.6.0] - 2018-11-05
### Added
- "JWT Auth Token Functions with HS256 algorithm", is added in this release.
- "JWT Auth Token related DB Table", is added in this release.
- "User Authentication and Info functions for REST API", is added in this release.
### Changed
- "few DB related files", are renamed.
- "Copyright notice", is updated.


## [3.4.0] - 2018-09-24
### Added
- "Separate Route Functions", file is added in this release.

### Changed
- "routing specific files", are renamed.


## [3.3.0] - 2018-06-03
### Added
- "Additional Session Backends", i.e. Single Redis Server, is supported in this release with corresponding Config options.
- "Specific Session Settings", are added, to stay in sync with PHP v7.2 and later.

### Removed
- "Specific Session Settings", are removed, to stay in sync with PHP v7.2 and later. More info can be checked, by referring in the /index.php file, for removed Session Settings, that are removed before PHP v7.2.


## [3.2.0] - 2018-05-15
### Added
- "Halite v4.41", is added in this release. Checks are included to gracefully not load Halite Library, when errors happen with Libsodium.


### Removed
- "Halite v4.01", is removed.


## [3.1.0] - 2018-05-14
### Removed
- "Cryptographic Libraries", Old Versions Support is removed, due to non-compatibility / installation issues w.r.t. Libsodium and old PHP Versions (< PHP v7.2.0) respectively.


## [3.0.0] - 2018-05-14
### Added
- "PHP v7.2", is fully supported.
- "RBAC related DB Tables", added in this release.
- "Virtual Cron Management", related DB Table is added in this release.
- "Comprehensive Encryption Support", based on Libsodium, that includes latest Symmetric / Asymmetric Encryption libraries support, in the framework.
- "Constant Time Encoding v2.0", is added in this release.
- "PHPMailer v6.02", is added in this release.
- "UUID", Class is added in this release.
- "DBManager", Class, by Mr.Pradeep Ganapathy (Pradeep Ganapathy <bu.pradeep@gmail.com>) is added in this release.
- "Halite", Class, by Mr.Pradeep Ganapathy (Pradeep Ganapathy <bu.pradeep@gmail.com>) is added in this release.
- "Logger", Class, by Mr.Pradeep Ganapathy (Pradeep Ganapathy <bu.pradeep@gmail.com>) is added in this release.


### Removed
- "PHPmailer v5.27", is removed.
- "PHPExcel" library is removed, as it is Deprecated.


## [2.0.0] - 2018-04-02
### Changed
- "Ajax Route" sub-classified to define Ajax Calls and REST Web Service Endpoints separately.
- "Separate folders" are used to hold files for Ajax Calls (ajax-pages) and REST Web Service Endpoints (rest-apis).
- "Common Folder, i.e., ajax-common" is used to hold common files.
- "Controller" is enabled to deal the above ajax route sub-classification.


## [1.0.0] - 2018-04-02
### Added
- "Basic Routing Engine", that allows Static / Dynamic Route Definition
- "Main Config", for the framework setup
- "PHP itself, used as a template engine", to avoid another template engine syntax
- "Ajax Calls / REST API Endpoints" can be defined in same Ajax Route Concept.
- "Admin / Frontend" template folders isolation.
- "Front Controller Pattern" is used.
- "Virtual Cron Manager", setup included.
- "Many Security Wrappers / Conventions" for reasonable application security.
- "Minimalistic Code", as this is gist of last few years of code consolidation (from 2014 minimum, even though, the early attempts date back to 2009 and before).
