# Stream Functions

[![Latest Stable Version](https://poser.pugx.org/quorum/stream-functions/version)](https://packagist.org/packages/quorum/stream-functions)
[![License](https://poser.pugx.org/quorum/stream-functions/license)](https://packagist.org/packages/quorum/stream-functions)
[![CI](https://github.com/QuorumCollection/StreamFunctions/workflows/CI/badge.svg?)](https://github.com/QuorumCollection/StreamFunctions/actions?query=workflow%3ACI)


Useful functions for manipulating PHP streams (resources)

## Requirements

- **php**: ^7.1|^8.0

## Installing

Install the latest version with:

```bash
composer require 'quorum/stream-functions'
```

## Stream Functions

### `Quorum\Streams\faccept( $stream, string ...$accept ) : ?string`

faccept peeks the given stream for the given string returning it if it is found * or null if it is not.

If the string is found, the cursor remains advanced to the end of the string.

If the string is not found, the cursor is reset to its original position.

### `Quorum\Streams\fpeek( $stream, int $length = 1 ) : string`

fpeek peeks the given stream for the given length returning as found.

The cursor is reset to its original position.

### `Quorum\Streams\funtil( $stream, string $until ) : string`

funtil reads the given stream until the given string is found or eof is reached