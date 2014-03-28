<?php namespace Jenny\Lexer;

class Analyzer {

    /**
     * Determine whether the given character is a white space or not
     *
     * @param  string  $character
     * @return boolean
     */
    public function isWhiteSpace($character)
    {
        return $this->match($character, '/\s/');
    }

    /**
     * Determine whether the given character is a number or not
     *
     * @param  string  $character
     * @return boolean
     */
    public function isNumber($character)
    {
        return $this->match($character, '/[0-9\.]/');
    }

    /**
     * Determine whether the given character is an operator or not
     *
     * @param  string  $character
     * @return boolean
     */
    public function isOperator($character)
    {
        return $this->match($character, '/[\/\-*+^%()=]/');
    }

    /**
     * Determine whether the given character is an indentifier or not
     *
     * @param  string  $character
     * @return boolean
     */
    public function isIndentifier($character)
    {
        return $this->match($character, '/[a-z]/i');
    }

    /**
     * Determine whether the given regex matches the given string
     *
     * @param  string  $string
     * @param  string  $regex
     * @return boolean
     */
    protected function match($string, $regex)
    {
        return (boolean)preg_match($regex, $string);
    }

}

