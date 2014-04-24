<?php namespace Jenny\Lexer;

class Analyzer {

    /**
     * Determine whether the character is a white space.
     *
     * @param string $character
     * @return boolean
     */
    public function isWhiteSpace($character)
    {
        return $this->match($character, '/\s/');
    }

    /**
     * Determine whether the character is a number.
     *
     * @param string $character
     * @return boolean
     */
    public function isNumber($character)
    {
        return $this->match($character, '/[0-9\.]/');
    }

    /**
     * Determine whether the character is an operator.
     *
     * @param string $character
     * @return boolean
     */
    public function isOperator($character)
    {
        return $this->match($character, '/[\/\-*+^%()=]/');
    }

    /**
     * Determine whether the character is an indentifier.
     *
     * @param string $character
     * @return boolean
     */
    public function isIndentifier($character)
    {
        return $this->match($character, '/[a-z]/i');
    }

    /**
     * Determine whether the regex matches the given string.
     *
     * @param string $string
     * @param string $regex
     * @return boolean
     */
    protected function match($string, $regex)
    {
        return (boolean) \preg_match($regex, $string);
    }

}

