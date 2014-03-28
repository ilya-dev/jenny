<?php namespace Jenny\Lexer;

class Reader {

    /**
     * The input string
     *
     * @var string
     */
    protected $input = '';

    /**
     * The array of characters
     *
     * @var array
     */
    protected $characters = [];

    /**
     * Sets the input string
     *
     * @param  string $input
     * @return void
     */
    public function setInput($input)
    {
        if ( ! is_string($input))
        {
            $type = gettype($input);

            throw new \InvalidArgumentException("Expected string but got $type");
        }

        $this->input = $input;

        $this->reset();
    }

    /**
     * Returns the input string
     *
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Advance the cursor and return the corresponding character
     *
     * @return string
     */
    public function advance()
    {
        $character = array_shift($this->characters);

        if ( ! is_string($character))
        {
            throw new Exceptions\EndOfLine;
        }

        return $character;
    }

    /**
     * Determine if the end of the input string was reached
     *
     * @return boolean
     */
    public function isEnd()
    {
        return count($this->characters) === 0;
    }

    /**
     * Reset the array of characters
     *
     * @return void
     */
    protected function reset()
    {
        $this->characters = str_split($this->input);
    }

}

