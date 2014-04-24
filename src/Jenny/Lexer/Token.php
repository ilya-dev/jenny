<?php namespace Jenny\Lexer;

class Token {

    /**
     * Represents a number
     *
     * @var string
     */
    const NUMBER = 'number';

    /**
     * Represents an indentifier
     *
     * @var string
     */
    const INDENTIFIER = 'indentifier';

    /**
     * Represents an operator
     *
     * @var string
     */
    const OPERATOR = 'operator';

    /**
     * The value of token
     *
     * @var mixed
     */
    protected $value;

    /**
     * The type of token
     *
     * @var string
     */
    protected $type;

    /**
     * The constructor
     *
     * @param  mixed  $value
     * @param  string $type
     * @return Token
     */
    public function __construct($value, $type)
    {
        $this->value = $value;

        $this->type  = $type;
    }

    /**
     * Get the token value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the token type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Compare the given type with the token type
     *
     * @param  string  $type
     * @return boolean
     */
    public function is($type)
    {
        // I intentionally used $this->getType() instead of $this->type
        // to prevent a possible accidental assignment
        return $this->getType() === $type;
    }

}

