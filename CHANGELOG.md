# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## v3.1.1 - 2025-09-09

### What's Changed

* Add payment endpoints and DTOs for payment processing by @lloricode in https://github.com/lloricode/paymaya-sdk-php/pull/27

**Full Changelog**: https://github.com/lloricode/paymaya-sdk-php/compare/v3.1.0...v3.1.1

## v3.1.0 - 2025-08-28

**Full Changelog**: https://github.com/lloricode/paymaya-sdk-php/compare/v3.0.0...v3.1.0

## v3.0.0 - 2025-08-25

### v3.0.0 - Major Upgrade

##### 🔍 Overview

This release introduces **PHP 8.3 support**, a **modern HTTP client (Saloon PHP)**, and an improved folder structure for better maintainability and adoption of the latest PHP features.

👉 [Upgrade Guide](https://github.com/lloricode/paymaya-sdk-php/blob/main/UPGRADING.md)


---

##### ✅ What's Changed

* Bump dependabot/fetch-metadata from 2.3.0 to 2.4.0 by @dependabot[bot] in [#21](https://github.com/lloricode/paymaya-sdk-php/pull/21)
* Bump stefanzweifel/git-auto-commit-action from 5 to 6 by @dependabot[bot] in [#22](https://github.com/lloricode/paymaya-sdk-php/pull/22)
* Bump aglipanci/laravel-pint-action from 2.5 to 2.6 by @dependabot[bot] in [#23](https://github.com/lloricode/paymaya-sdk-php/pull/23)
* Bump actions/checkout from 4 to 5 by @dependabot[bot] in [#24](https://github.com/lloricode/paymaya-sdk-php/pull/24)
* Bump actions/checkout from 4 to 5 by @dependabot[bot] in [#26](https://github.com/lloricode/paymaya-sdk-php/pull/26)
* Integrate Saloon PHP by @lloricode in [#25](https://github.com/lloricode/paymaya-sdk-php/pull/25)


---

**Full Changelog**: [v2.0.1...v3.0.0](https://github.com/lloricode/paymaya-sdk-php/compare/v2.0.1...v3.0.0)

## v2.0.1 - 2025-02-21

### What's Changed

* Drop support PHP 8.0 and 8.1
* Bump dependabot/fetch-metadata from 1.4.0 to 1.5.1 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/5
* Bump aglipanci/laravel-pint-action from 2.2.0 to 2.3.0 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/6
* Bump dependabot/fetch-metadata from 1.5.1 to 1.6.0 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/7
* Bump actions/checkout from 3 to 4 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/8
* Bump aglipanci/laravel-pint-action from 2.3.0 to 2.3.1 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/11
* Bump codecov/codecov-action from 3 to 4 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/12
* Bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/10
* Bump ramsey/composer-install from 2 to 3 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/13
* Bump dependabot/fetch-metadata from 1.6.0 to 2.0.0 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/14
* Bump aglipanci/laravel-pint-action from 2.3.1 to 2.4 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/15
* Bump dependabot/fetch-metadata from 2.0.0 to 2.1.0 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/16
* Bump dependabot/fetch-metadata from 2.1.0 to 2.2.0 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/17
* Bump dependabot/fetch-metadata from 2.2.0 to 2.3.0 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/19
* Bump codecov/codecov-action from 4 to 5 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/18
* Bump aglipanci/laravel-pint-action from 2.4 to 2.5 by @dependabot in https://github.com/lloricode/paymaya-sdk-php/pull/20

**Full Changelog**: https://github.com/lloricode/paymaya-sdk-php/compare/v2.0.0...v2.0.1

## v2.0.0 - 2023-04-28

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v2.0.0-alpha.2 - 2023-02-21

### Added

- Add timeout.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v2.0.0-alpha - 2023-02-17

### Added

- Nothing.

### Changed

- Use PHP promotion constructor
- Make date to be string

### Deprecated

- Nothing.

### Removed

- Remove spatie/data-transfer-object

### Fixed

- Nothing.

## v1.0.3 - 2023-02-16

### Added

- Nothing.

### Changed

- Add support `spatie/data-transfer-object`: ^3.8

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v1.0.2 - 2023-02-16

### Added

- Install laravel pint

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v1.0.0 - 2023-02-15

### Added

- Add --ci on pest in GitHub action
  
- Install rector
  

### Changed

- Use phpstan

### Deprecated

- Nothing.

### Removed

- Remove psalm

### Fixed

- Nothing.

## v0.5.0-alpha4 - 2022-04-18

### Added

- Nothing.

### Changed

- Add return type for jsonSerialize().

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.5.0-alpha3 - 2021-08-13

### Added

- Add composer-runtime-api:^2.0 in require --dev, to enforce use composer v2 in development.
  
- Add phly/keep-a-changelog in require --dev.
  

### Changed

- Fix DTO Caster..
  
- Set minimum spatie/data-transfer-object:^3.6.
  
- Update Readme, remove php 7.4.
  
- Reformat CHANGELOG file.
  

### Deprecated

- Nothing.

### Removed

- Remove todo in changelog.

### Fixed

- Nothing.

## v0.5.0-alpha2 - 2021-05-18

### Added

- Nothing.

### Changed

- Manage duplicate codes.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.5.0-alpha1 - 2021-05-18

### Added

- Add Strict in DTO.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.5.0-alpha - 2021-05-17

### Added

- Add support spatie/data-transfer-object v3.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Drop support php 7.
  
- Drop support spatie/data-transfer-object v2.
  

### Fixed

- Nothing.

## v0.4.4 - 2021-04-06

### Added

- Nothing.

### Changed

- Optimise Guzzle Client parameter with handler.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.4.3 - 2021-03-22

### Added

- Add default headers.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.4.2 - 2021-03-05

### Added

- Add delete customization.

### Changed

- Set null all customization properties if there is no return by paymaya api.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.4.1 - 2021-03-01

### Added

- Nothing.

### Changed

- Handle 404 when customization is empty.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.4.0 - 2021-02-26

### Added

- Add checkout customization.

### Changed

- Move webhook class.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.3.0 - 2021-02-23

### Added

- Add show checkout with id.
  
- Add spatie DTO (https://github.com/spatie/data-transfer-object).
  

### Changed

- Set all properties to public (to compatible also in spatie DTO).
  
- Rename all properties depends on paymaya response.
  
- Rename all classes depends on paymaya.
  

### Deprecated

- Nothing.

### Removed

- Remove all getter.
  
- Remove all ::new() functions (fix for psalm).
  

### Fixed

- Nothing.

## v0.2.2 - 2021-02-08

### Added

- Nothing.

### Changed

- Set ::new() as deprecate.
  
- Set compatible for lloriode/laravel-paymaya-sdk.
  

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.2.1 - 2021-02-05

### Added

- Increase code coverage.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.2.0 - 2021-02-05

### Added

- Add support PHP 8.

### Changed

- Use guzzle mock for testing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.1.1 - 2020-11-13

### Added

- Add support in a composer.json file.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.1.0 - 2020-10-28

### Added

- Add more attribute in webhooks.

### Changed

- Rename some methods in clients.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.0.4 - 2020-10-27

### Added

- Add webhook (create, get, update, delete, deleteAll)

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.0.3 - 2020-10-22

### Added

- Nothing.

### Changed

- Set null another some buyer attributes.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.0.2 - 2020-10-22

### Added

- Nothing.

### Changed

- Set meta data as nullable.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## v0.0.1 - 2020-10-22

### Added

- Initial release pre-release.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
