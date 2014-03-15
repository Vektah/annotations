<?php
/**
 * Created by IntelliJ IDEA.
 * User: adam
 * Date: 15/03/14
 * Time: 5:29 PM
 * To change this template use File | Settings | File Templates.
 */

namespace vektah\annotations;

class PhpFileTest extends \PHPUnit_Framework_TestCase {
	public function test_trait_reading() {
		$file = new PhpFile(__DIR__ . '/sample/SampleTrait.php');

		$this->assertEquals('vektah\annotations\sample', $file->get_namespace());
		$this->assertEquals(['SampleAnnotation2' => 'vektah\annotations\sample\annotation2\SampleAnnotation2'], $file->get_uses());
	}

	public function test_class_reading() {
		$file = new PhpFile(__DIR__ . '/sample/SampleClass.php');

		$this->assertEquals('vektah\annotations\sample', $file->get_namespace());
		$this->assertEquals(['SampleAnnotation1' => 'vektah\annotations\sample\annotation1\SampleAnnotation1'], $file->get_uses());
	}
}
