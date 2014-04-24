<?php namespace Jenny\Evaluator;

use Jenny\Lexer\Token;

class ExpressionBuilder {

    /**
     * The Container instance.
     *
     * @var Container
     */
    protected $container;

    /**
     * The constructor.
     *
     * @param Container $container
     * @return ExpressionBuilder
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Transform the given array of tokens to a string.
     *
     * @param array $tokens
     * @return string
     */
    public function build(array $tokens)
    {
        $expression = '';

        foreach ($tokens as $token)
        {
            $expression .= $this->transform($token);
        }

        return $expression;
    }

    /**
     * Transform the given token to a string.
     *
     * @param \Jenny\Lexer\Token $token
     * @return string
     */
    protected function transform(Token $token)
    {
        if ($token->is(Token::INDENTIFIER))
        {
            $value = $this->container->get($token->getValue());

            if (\is_null($value))
            {
                throw new Exceptions\UndefinedVariable($token->getValue());
            }
        }
        else
        {
            $value = $token->getValue();
        }

        return \strval($value);
    }

}

