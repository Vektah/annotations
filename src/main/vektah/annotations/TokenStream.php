<?php
/**
 * Created by IntelliJ IDEA.
 * User: adam
 * Date: 15/03/14
 * Time: 4:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace vektah\annotations;


class TokenStream {
	private $tokens;
	private $count;
	private $pos = 0;

	public function __construct(array $tokens) {
		$this->tokens = $tokens;
		$this->count = count($tokens);
	}

	public function peek() {
		if ($this->pos >= $this->count) {
			return null;
		}
		return $this->tokens[$this->pos];
	}

	public function next() {
		if ($this->pos >= $this->count) {
			return null;
		}
		return $this->tokens[$this->pos++];
	}

	public function rewind() {
		$this->pos = 0;
	}
}
