<?php

namespace Quorum\test;

use PHPUnit\Framework\TestCase;
use function Quorum\Streams\faccept;

class StreamsTest extends TestCase {

	public function test_faccept() : void {
		$stream = fopen('php://memory', 'r+');
		fwrite($stream, 'test-of-this');
		rewind($stream);

		$this->assertNull(faccept($stream, 'no-match'));
		$this->assertSame('test', faccept($stream, 'test'));
		$this->assertNull(faccept($stream, 'test'));
		$this->assertSame('-of', faccept($stream, '-of'));

		$this->assertSame('-t', faccept($stream, '-a', '-b', '-t'));
		$this->assertSame('h', fread($stream, 1));
	}

	public function test_faccept_BOM() : void {
		$stream = fopen(__DIR__ . '/data/utf8-bom.csv', 'r');
		$this->assertSame("\xEF\xBB\xBF", faccept($stream, "\xEF\xBB\xBF"));
		$line = fgetcsv($stream);
		$this->assertSame(['a', 'b', 'c'], $line);
	}

	public function test_fpeek() : void {
		$stream = fopen('php://memory', 'r+');
		fwrite($stream, 'test');
		rewind($stream);

		$this->assertEquals('test', \Quorum\Streams\fpeek($stream, 4));
		$this->assertEquals('test', \Quorum\Streams\fpeek($stream, 4));
	}

}
