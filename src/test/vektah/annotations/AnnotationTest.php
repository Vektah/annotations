<?php

namespace vektah\annotations;

/**
 * @FooAnnotation()
 */
class AnnotationTest extends \PHPUnit_Framework_TestCase {

	public function test_basic() {
		Annotation::get_annotated_class(AnnotationTest::class);
	}
}
