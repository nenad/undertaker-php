undertaker
===

This repository hosts the PHP counterpart of the [undertaker](https://github.com/nenad/undertaker).

## What is this?

This package provides a way of pre-loading all PHP files in a given directory. This, combined
with the [undertaker](https://github.com/nenad/undertaker) extension will show you which functions/methods
are not used in your application as it runs.

## How safe it is?

Not at all. If your PHP files have side effects when loaded with `require_once`, I have some bad
news for you.

## Example

Look at the `preloader.php` file in the root directory of the package for example.
