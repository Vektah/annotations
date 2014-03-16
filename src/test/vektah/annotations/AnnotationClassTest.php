<?php

namespace vektah\annotations;

use vektah\annotations\sample\SampleClass;

class AnnotationTest extends \PHPUnit_Framework_TestCase {

	public function test_basic() {
        $class = new AnnotatedClass(SampleClass::class);

        var_dump($class);
	}
}
