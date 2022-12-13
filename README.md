# Quorum Stream Functions

[![Latest Stable Version](https://poser.pugx.org/quorum/stream-functions/version)](https://packagist.org/packages/quorum/stream-functions)
[![License](https://poser.pugx.org/quorum/stream-functions/license)](https://packagist.org/packages/quorum/stream-functions)
[![CI](https://github.com/QuorumCollection/StreamFunctions/workflows/CI/badge.svg?)](https://github.com/QuorumCollection/StreamFunctions/actions?query=workflow%3ACI)


Useful functions for manipulating PHP streams (resources).

The general structure of these are inspired by a [talk given by Rob Pike](https://www.youtube.com/watch?v=HxaD_trXwRE).

## Requirements

- **php**: ^7.1|^8.0

## Installing

Install the latest version with:

```bash
composer require 'quorum/stream-functions'
```

## Stream Functions

### Function: \Quorum\Streams\faccept

```php
function faccept($stream, string ...$accept) : ?string
```

##### Parameters:

- ***resource*** `$stream` - The stream to peek, must be a seekable resource
- ***string*** `$accept` - One or more strings to accept

##### Returns:

- ***string*** | ***null*** - The accepted string or null if none were found

faccept peeks the given stream for the given string returning it if it is  
found * or null if it is not.  
  
If the string is found, the cursor remains advanced to the end of the string.  
If the string is not found, the cursor is reset to its original position.

### Function: \Quorum\Streams\fpeek

```php
function fpeek($stream [, int $length = 1]) : string
```

##### Parameters:

- ***resource*** `$stream` - The stream to peek, must be a seekable resource
- ***int*** `$length` - Up to length number of bytes read.

##### Returns:

- ***string*** - The peeked string of up to length bytes

fpeek peeks the given stream for the given length returning as found.  
  
The cursor is reset to its original position.

### Function: \Quorum\Streams\funtil

```php
function funtil($stream, string $until [, int $length = 0 [, ?string $buf = null]]) : bool
```

##### Parameters:

- ***resource*** `$stream` - The stream to read, must be a seekable resource
- ***string*** `$until` - The string to read until
- ***int*** `$length` - The maximum number of bytes to read, defaults to 0 (no limit)
- ***string*** | ***null*** `$buf` - The buffered contents by reference

##### Returns:

- ***bool***

funtil reads the given stream until the given string is found or eof is reached