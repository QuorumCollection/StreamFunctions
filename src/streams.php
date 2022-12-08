<?php

namespace Quorum\Streams;

/**
 * faccept peeks the given stream for the given string returning it if it is
 * found * or null if it is not.
 *
 * If the string is found, the cursor remains advanced to the end of the string.
 * If the string is not found, the cursor is reset to its original position.
 *
 * @param resource $stream The stream to peek, must be a seekable resource
 * @param string   ...$accept One or more strings to accept
 * @return string|null The accepted string or null if none were found
 */
function faccept( $stream, string ...$accept ) : ?string {
	if( !is_resource($stream) ) {
		throw new \InvalidArgumentException('Stream must be a resource');
	}

	foreach( $accept as $item ) {
		$length = strlen($item);
		$buf    = fread($stream, $length);
		if( $buf === $item ) {
			return $item;
		}

		fseek($stream, 0 - $length, SEEK_CUR);
	}

	return null;
}

/**
 * fpeek peeks the given stream for the given length returning as found.
 *
 * The cursor is reset to its original position.
 *
 * @param resource $stream The stream to peek, must be a seekable resource
 * @param int      $length Up to length number of bytes read.
 * @return string The peeked string of up to length bytes
 */
function fpeek( $stream, int $length = 1 ) : string {
	if( !is_resource($stream) ) {
		throw new \InvalidArgumentException('Stream must be a resource');
	}

	$buf = fread($stream, $length);
	fseek($stream, 0 - strlen($buf), SEEK_CUR);

	return $buf;
}

/**
 * funtil reads the given stream until the given string is found or eof is reached
 *
 * @param resource $stream The stream to read, must be a seekable resource
 * @param string   $until The string to read until
 * @return string
 */
// @todo look into how to correctly handle EOF here.
function funtil( $stream, string $until ) : string {
	if( !is_resource($stream) ) {
		throw new \InvalidArgumentException('Stream must be a resource');
	}

	$buf = '';
	while( !feof($stream) ) {
		$buf .= fgetc($stream);
		if( substr($buf, -strlen($until)) === $until ) {
			break;
		}
	}

	return $buf;
}
