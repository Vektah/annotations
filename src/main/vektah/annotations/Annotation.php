<?php

namespace vektah\annotations;

use vektah\parser_combinator\language\php\annotation\PhpAnnotationParser;

class Annotation {
	/**
	 * @param $filename
	 * @return PhpFile
	 */
	private static function get_php_file($filename) {
		return new PhpFile($filename);
	}

	public static function get_annotated_class($class_name) {
		$reflection_class = new \ReflectionClass($class_name);

		$parser = new PhpAnnotationParser();

		$ast = $parser->parseString($reflection_class->getDocComment());

		var_dump($ast);

		$file = self::get_php_file($reflection_class->getFileName());

		var_dump($file);
	}
}
