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
		$file = new PhpFile(file_get_contents(__DIR__ . '/sample/SampleTrait.php'));

		$this->assertEquals('vektah\annotations\sample', $file->get_namespace());
		$this->assertEquals(['SampleAnnotation2' => 'vektah\annotations\sample\annotation2\SampleAnnotation2'], $file->get_uses());
	}

	public function test_class_reading() {
		$file = new PhpFile(file_get_contents(__DIR__ . '/sample/SampleClass.php'));

		$this->assertEquals('vektah\annotations\sample', $file->get_namespace());
		$this->assertEquals(['SampleAnnotation1' => 'vektah\annotations\sample\annotation1\SampleAnnotation1'], $file->get_uses());
	}

    public function test_name_resolution_with_ns() {
        $contents = '<?php
            namespace foo\bar;

            use foo\bar\baz\FooBar;
            use qwop\otherns;
        ';
        $file = new PhpFile($contents);

        $this->assertEquals('foo\bar\baz\FooBar', $file->resolve_name('FooBar'));
        $this->assertEquals('foo\bar\Qwop', $file->resolve_name('Qwop'));
        $this->assertEquals('qwop\otherns\Bob', $file->resolve_name('otherns\Bob'));
    }



    public function test_name_resolution_without_ns() {
        $contents = '<?php
            use foo\bar\baz\FooBar;
            use qwop\otherns;
        ';
        $file = new PhpFile($contents);

        $this->assertEquals('foo\bar\baz\FooBar', $file->resolve_name('FooBar'));
        $this->assertEquals('Qwop', $file->resolve_name('Qwop'));
        $this->assertEquals('qwop\otherns\Bob', $file->resolve_name('otherns\Bob'));
    }
}
