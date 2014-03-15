<?php

namespace vektah\annotations;

/**
 * @FooAnnotation()
 */
class TokenStreamTest extends \PHPUnit_Framework_TestCase {

	public function test_next() {
		$stream = new TokenStream(['a', 'b', 'c']);

		$this->assertEquals('a', $stream->peek());
		$this->assertEquals('a', $stream->next());

		$this->assertEquals('b', $stream->peek());
		$this->assertEquals('b', $stream->next());

		$this->assertEquals('c', $stream->peek());
		$this->assertEquals('c', $stream->next());

		$this->assertEquals(null, $stream->peek());
		$this->assertEquals(null, $stream->next());
		$this->assertEquals(null, $stream->next());

		$stream->rewind();
		$this->assertEquals('a', $stream->peek());
		$this->assertEquals('a', $stream->next());
	}
}
