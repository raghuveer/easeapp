# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
- "Many Security Wrappers / Conventions" for reasonable application security.
- "Minimalistic Code", as this is gist of last few years of code consolidation (from 2014 minimum, even though, the early attempts date back to 2009 and before).