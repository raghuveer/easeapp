# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [3.1.0] - 2018-05-14
### Removed
- "Cryptographic Libraries", Old Versions Support is removed, due to non-compatibility of Libsodium, with old PHP Versions.


## [3.0.0] - 2018-05-14
### Added
- "PHP v7.2", is fully supported.
- "RBAC related DB Tables", added in this release.
- "Virtual Cron Management", related DB Table is added in this release.
- "Comprehensive Encryption Support", based on Libsodium, that includes latest Symmetric / Asymmetric Encryption libraries support, in the framework.
- "PHPMailer", v6.02 is added in this release.
- "UUID", Class is added in this release.
- "DBManager", Class, by Mr.Pradeep Ganapathy (Pradeep Ganapathy <bu.pradeep@gmail.com>) is added in this release.
- "Halite", Class, by Mr.Pradeep Ganapathy (Pradeep Ganapathy <bu.pradeep@gmail.com>) is added in this release.
- "Logger", Class, by Mr.Pradeep Ganapathy (Pradeep Ganapathy <bu.pradeep@gmail.com>) is added in this release.


### Removed
- "PHPmailer"  v5.27 is removed.
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