<?php

namespace vektah\annotations;

use vektah\parser_combinator\language\php\annotation\DoctrineAnnotation;
use vektah\parser_combinator\language\php\annotation\PhpAnnotationParser;

class AnnotatedClass {
    /** @var string */
    private $filename;

    /** @var string */
    private $namespace;

    /** @var mixed[] a list of annotation objects for this class */
    private $annotations;

    /**
     * @param $filename
     * @return PhpFile
     */
    private static function get_php_file($filename) {
        return new PhpFile(file_get_contents($filename));
    }

    public function __construct($class_name = null)
    {
        $reflection_class = new \ReflectionClass($class_name);

        $parser = new PhpAnnotationParser();

        $ast = $parser->parseString($reflection_class->getDocComment());

        $file = self::get_php_file($reflection_class->getFileName());

        $this->filename = $reflection_class->getFileName();
        $this->namespace = $file->get_namespace();

        foreach ($ast as $annotation_node) {
            if ($annotation_node instanceof DoctrineAnnotation) {
                $name = $file->resolve_name($annotation_node->name);

                if (!class_exists($name)) {
                    throw new \InvalidArgumentException("$name does not exist");
                }
                $annotation = new $name();

                foreach ($annotation_node->arguments as $key => $argument) {
                    $annotation->$key = $argument;
                }

                $this->annotations[] = $annotation;
            }
        }
    }
} 