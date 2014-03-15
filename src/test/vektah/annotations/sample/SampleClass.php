<?php

namespace vektah\annotations\sample;

use vektah\annotations\sample\annotation1\SampleAnnotation1;

class SampleClass {
	use SampleTrait;

	/**
	 * @SampleAnnotation("Annotated")
	 * @var string
	 */
	public $property;

	/**
	 * @SampleAnnotation1(42)
	 */
	public function class_method() {
		
	}
}
