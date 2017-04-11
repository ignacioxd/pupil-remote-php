# pupil-remote-php

[![Total Downloads](https://img.shields.io/packagist/dt/ignacioxd/pupil-remote-php.svg?style=flat-square)](https://packagist.org/packages/ignacioxd/pupil-remote-php)
[![Latest Stable Version](https://img.shields.io/packagist/v/ignacioxd/pupil-remote-php.svg?style=flat-square)](https://packagist.org/packages/ignacioxd/pupil-remote-php)
[![License](https://poser.pugx.org/ignacioxd/pupil-remote-php/license)](https://packagist.org/packages/ignacioxd/pupil-remote-php)


A simple PHP remote control client for the [Pupil eye tracker](https://pupil-labs.com/pupil/) software.

## Installation

Package is available on [Packagist](http://packagist.org/packages/ignacioxd/pupil-remote-php),
you can install it using [Composer](http://getcomposer.org).

```shell
composer require ignacioxd/pupil-remote-php
```

### Dependencies

- [ZeroMQ PHP Extension](http://zeromq.org/bindings:php)

## Basic usage

### Connecting

```php
$host = "127.0.0.1";
$port = 50020;
$remote = new \Ignacioxd\PupilRemote();
$remote->connect($host, $port); // Or leave empty for defaults
```

### Getting Pupil's timebase

```php
$pupilTime = $remote->getTimebase();
```

### Setting Pupil's timebase

```php
$remote->setTimebase(123.456);
```


### Starting calibration

```php
if( $remote->startCalibration() ) {
  echo "Calibration started";
}
```

### Stopping calibration

```php
if( $remote->stopCalibration() ) {
  echo "Calibration stopped";
}
```

### Start recording

```php
if( $remote->startRecording() ) {
  echo "Recording started";
}
```

### Stop recording

```php
if( $remote->stopRecording() ) {
  echo "Recording stopped";
}
```
