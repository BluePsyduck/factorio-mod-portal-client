# Changelog

## 1.4.1 - 2021-05-19

### Added

- Support for Guzzle client 7.x.

## 1.4.0 - 2021-04-01

### Added

- Support for new ~ dependency modifier as of [Factorio 1.1.28](https://forums.factorio.com/viewtopic.php?f=3&t=97273).

## 1.3.1 - 2021-02-18

### Added

- Support for PHP 8.0.

## 1.3.0 - 2020-11-01

### Added

- Classes `Version` and `Dependency` actually parsing the values returned from the API for further processing.
- Class `ModUtils` helping with common tasks related to mods.

## 1.2.0 - 2020-01-08

### Removed

- Dependency to zendframework/zend-servicemanager to avoid naming conflict with the rename of Zend to Laminas.

## 1.1.0 - 2019-09-19

### Changed

- Dependency `jms/serializer` to require version 3.2+.

## 1.0.0 - 2019-09-16

- Initial release of the Factorio Mod Portal client.
