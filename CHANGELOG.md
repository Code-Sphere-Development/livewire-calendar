# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.0] - 2026-11-18

First release as `code-sphere/livewire-calendar`, forked from
[omnia-digital/livewire-calendar](https://github.com/omnia-digital/livewire-calendar) 4.1.0.

### Added
- Laravel 13 support.
- PHP 8.5 support.
- Tests for rendering, disabled click handlers, view namespace and the scripts directive.
- GitHub Actions CI (PHP 8.3-8.5, Laravel 12/13, Livewire 3/4), Pint configuration, Dependabot.

### Changed
- Package name `code-sphere/livewire-calendar`, namespace `CodeSphere\LivewireCalendar`.
- Requires PHP ^8.3, illuminate/support ^12.0|^13.0, livewire/livewire ^3.0|^4.0.
- Code style aligned with Laravel Pint.

### Removed
- Livewire 2 compatibility (`$casts` property, `getId()` fallback).
- Support for Laravel 6-11 and PHP < 8.3.
- Travis CI, Scrutinizer and StyleCI configuration.

### Fixed
- `goToPreviousMonth()` / `goToNextMonth()` shifted `endsAt` with `NoOverflow` instead of
  recalculating it, so after passing a shorter month the grid could end before the last day of
  the month (e.g. March → February → January ended on January 28).

## Before 1.0.0

For the history of the original package see the
[omnia-digital/livewire-calendar changelog](https://github.com/omnia-digital/livewire-calendar/blob/main/CHANGELOG.md).
