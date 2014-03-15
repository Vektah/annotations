<?php

namespace vektah\annotations\sample;

use vektah\annotations\sample\annotation2\SampleAnnotation2;

class SampleTrait {
	/**
	 * @SampleAnnotation2(2)
	 */
	public function do_stuff() {
		return 3;
	}
}
