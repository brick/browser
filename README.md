Brick\Browser
=============

<img src="https://raw.githubusercontent.com/brick/brick/master/logo.png" alt="" align="left" height="64">

A PHP browser implementation for automated testing.

[![Build Status](https://secure.travis-ci.org/brick/browser.svg?branch=master)](http://travis-ci.org/brick/browser)
[![Coverage Status](https://coveralls.io/repos/brick/browser/badge.svg?branch=master)](https://coveralls.io/r/brick/browser?branch=master)
[![Latest Stable Version](https://poser.pugx.org/brick/browser/v/stable)](https://packagist.org/packages/brick/browser)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](http://opensource.org/licenses/MIT)

Introduction
------------

With an API inspired by [Selenium](http://www.seleniumhq.org/), this PHP browser implementation allows fast automated testing of a PHP application.
It lack many features of a real browser: it doesn't load external resources, and doesn't execute JavaScript.
However, it allows your tests to browse from page to page by clicking elements and submitting forms, and check the result (URL, status code, page contents).
If you don't need all the features of a real browser, this is a much faster alternative to Selenium.

Installation
------------

This library is installable via [Composer](https://getcomposer.org/):

```bash
composer require brick/browser
```

Requirements
------------

This library requires PHP 7.1 or later.
