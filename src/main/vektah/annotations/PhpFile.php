<?php

namespace vektah\annotations;

class PhpFile {
	private $namespace;
	private $uses;

	public function __construct($contents) {
		$tokens = new TokenStream(token_get_all($contents));

		while (list($id) = $tokens->next()) {
			if ($id === T_WHITESPACE) continue;

			if ($id === T_NAMESPACE) {
				$this->namespace = $this->read_until($tokens, ';');
			}

			// We only care about uses, skip over functions and classes
			if ($id === '{') {
				$this->skip_until($tokens, '}');
			}

			if ($id === T_USE) {
				$this->read_use($tokens);
			}
		}
	}

	private function read_use(TokenStream $tokens) {
		$name = '';
		$as = null;

		while ($token = $tokens->next()) {
			if ($token[0] === T_WHITESPACE) continue;

			if ($token[0] === ';') {
				$this->uses[end(explode('\\', $name))] = $name;
				break;
			}

			if ($token[0] === T_AS) {
				$this->uses[$this->read_until($tokens, ';')] = $name;
				break;
			}

			$name .= $token[1];
		}
	}

	private function read_until(TokenStream $tokens, $id) {
		$value = '';

		while ($token = $tokens->next()) {
			if ($token[0] === T_WHITESPACE) continue;

			if ($token[0] === $id) {
				return $value;
			}

			$value .= $token[1];
		}

		return $value;
	}

	private function skip_until(TokenSTream $tokens, $id) {
		while ($token = $tokens->next()) {
			if ($token[0] === T_WHITESPACE) continue;

			if ($token[0] === '{') {
				$this->skip_until($tokens, '}');
			}

			if ($token[0] === $id) {
				return;
			}
		}
	}

    public function resolve_name($name) {
        $parts = explode('\\', $name);
        $matching_part = $parts[0];
        $remaining = implode('\\', array_slice($parts, 1));

        if (isset($this->uses[$matching_part])) {
            if ($remaining) {
                return $this->uses[$matching_part] . '\\' . $remaining;
            } else {
                return $this->uses[$matching_part];
            }

        }

        if ($this->namespace) {
            return $this->namespace . '\\' . $name;
        }

        return $name;
    }

	public function get_namespace() {
		return $this->namespace;
	}

	public function get_uses() {
		return $this->uses;
	}
}
