## Multi-Logger

An easy-to-use library used to manage multiple [Monolog](https://github.com/Seldaek/monolog) channels from a single class.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

<img src="https://cdn1.onbayfront.com/bfm/brand/bfm-logo.svg" alt="Bayfront Media" width="250" />

- [Bayfront Media homepage](https://www.bayfrontmedia.com?utm_source=github&amp;utm_medium=direct)
- [Bayfront Media GitHub](https://github.com/bayfrontmedia)

## Requirements

* PHP `^8.0`

## Installation

```
composer require bayfrontmedia/multi-logger
```

## Usage

**NOTE:** All exceptions thrown by Multi-Logger extend `Bayfront\MultiLogger\Exceptions\MultiLoggerException`, so you can choose to catch exceptions as narrowly or broadly as you like. 

Multi-Logger exists in order manage multiple Monolog channels from a single class.

In some cases, you may still need to interact with the `Monolog\Logger` object directly, and Multi-Logger allows you to do that via the [getChannel](#getchannel) method.

A `Logger` instance must be passed to the constructor, and will automatically be set as the default and current channel.

**Example:**

```php
use Bayfront\MultiLogger\Log;
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;

$my_logger = new Logger('my_logger');
$my_logger->pushHandler(new FirePHPHandler());

$log = new Log($my_logger);
```

### Public methods

- [getChannels](#getchannels)
- [getDefaultChannel](#getdefaultchannel)
- [getCurrentChannel](#getcurrentchannel)
- [addChannel](#addchannel)
- [isChannel](#ischannel)
- [getChannel](#getchannel)
- [channel](#channel)

**Logging events**

- [emergency](#emergency)
- [alert](#alert)
- [critical](#critical)
- [error](#error)
- [warning](#warning)
- [notice](#notice)
- [info](#info)
- [debug](#debug)
- [log](#log)

<hr />

### getChannels

**Description:**

Return array of channel names.

**Parameters:**

- (None)

**Returns:**

- (array)

<hr />

### getDefaultChannel

**Description:**

Return name of default channel.

**Parameters:**

- (None)

**Returns:**

- (string)

<hr />

### getCurrentChannel

**Description:**

Return name of current channel.

**Parameters:**

- (None)

**Returns:**

- (string)

<hr />

### addChannel

**Description:**

Add a logger instance as a new channel with the same name.

If an existing instance exists with the same name, it will be overwritten.

**Parameters:**

- `$logger` (object): `Monolog\Logger` object

**Returns:**

- (self)

**Example:**

```
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;

$my_logger = new Logger('my_logger');
$my_logger->pushHandler(new FirePHPHandler());

$log->addChannel($my_logger);
```

<hr />

### isChannel

**Description:**

Does channel name exist?

**Parameters:**

- `$channel` (string)

**Returns:**

- (bool)

**Example:**

```
if ($log->isChannel('App')) {
    // Do something
}
```

<hr />

### getChannel

**Description:**

Returns `Logger` instance for a given channel.

**Parameters:**

- `$channel = ''` (string): Name of channel to return. If empty string, the current channel will be returned.

**Returns:**

- (object): `Monolog\Logger` object

**Throws:**

- `Bayfront\MultiLogger\Exceptions\ChannelNotFoundException`

**Example:**

```
try {

    $app_logger = $log->getChannel('App');

} catch (ChannelNotFoundException $e) {
    die($e->getMessage());
}
```

<hr />

### channel

**Description:**

Set the channel name to be used for the next logged event.

By default, all logged events will be logged to the default channel used in the constructor.

**Parameters:**

- `$channel` (string)

**Returns:**

- (self)

**Throws:**

- `Bayfront\MultiLogger\Exceptions\ChannelNotFoundException`

**Example:**

```
try {
    
    $log->channel('Dev')->info('This is an informational log message.');
    
} catch (ChannelNotFoundException $e) {
    die($e->getMessage());
}
```

<hr />

### emergency

**Description:**

System is unusable.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### alert

**Description:**

Action must be taken immediately.

Example: Entire website down, database unavailable, etc.
This should trigger the SMS alerts and wake you up.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### critical

**Description:**

Critical conditions.

Example: Application component unavailable, unexpected exception.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### error

**Description:**

Runtime errors that do not require immediate action but should typically be logged and monitored.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### warning

**Description:**

Exceptional occurrences that are not errors.

Example: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### notice

**Description:**

Normal but significant events.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### info

**Description:**

Interesting events.

Example: User logs in, SQL logs.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### debug

**Description:**

Detailed debug information.

**Parameters:**

- `$message` (string)
- `$context` (array)

**Returns:**

- (void)

<hr />

### log

**Description:**

Logs with an arbitrary level.

**Parameters:**

- `$level` (mixed)
- `$message` (string)
- `$context` (array)

**Returns:**

- (void)