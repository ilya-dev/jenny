<?php namespace Jenny\Evaluator;

use Jenny\Lexer\Token;

class Evaluator {

    /**
     * The Container instance
     *
     * @var \Jenny\Evaluator\Container
     */
    protected $container;

    /**
     * The ExpressionBuilder instance
     *
     * @var \Jenny\Evaluator\ExpressionBuilder
     */
    protected $builder;

    /**
     * The constructor
     *
     * @param \Jenny\Evaluator\Container              $container
     * @param \Jenny\Evaluator\ExpressionBuilder|null $builder
     * @return void
     */
    public function __construct(Container $container,
        ExpressionBuilder $builder = null)
    {
        $this->container = $container;

        // nice trick, still testable but makes it easier to create an instance
        $this->builder = $builder ?: new ExpressionBuilder($container);
    }

    /**
     * Evaluate the given array of tokens
     *
     * @param  array        $tokens
     * @return mixed|null
     */
    public function evaluateLine(array $tokens)
    {
        if ($this->containsAssignment($tokens))
        {
            return $this->handleAssignment($tokens);
        }

        return $this->buildAndEvaluate($tokens);
    }

    /**
     * Make the expression compatible with the PHP syntax
     * So it can passed to eval()
     *
     * @param  string $code
     * @return string
     */
    public function makeCompatible($code)
    {
        // 2^2 => pow(2,2)
        $code = preg_replace(
            '/(-?[0-9\.]+)\^(-?[0-9]+)/', // could be simpler
            'pow($1,$2)',
            $code
        );

        return $code;
    }

    /**
     * Determine whether the given array of tokens contains an assignment
     *
     * @param  array   $tokens
     * @return boolean
     */
    protected function containsAssignment(array $tokens)
    {
        // foo = 23 + 10
        //     ^

        if ( ! isset($tokens[1])) return false;

        $token = $tokens[1];

        return $token->is(Token::OPERATOR) and $token->getValue() == '=';
    }

    /**
     * Create a new key in the container and calculate its value
     *
     * @param  array  $tokens
     * @return string
     */
    protected function handleAssignment(array $tokens)
    {
        // foo = 23 + 10
        // ^^^

        $key = $tokens[0]->getValue();

        $value = $this->buildAndEvaluate(array_slice($tokens, 2));

        $this->container->set($key, $value);

        return "[$key] equals to $value";
    }

    /**
     * Build an expression from the given array of tokens and evaluate it
     *
     * @param  array $tokens
     * @return mixed
     */
    protected function buildAndEvaluate(array $tokens)
    {
        $expression = $this->builder->build($tokens);

        return $this->evaluate($expression);
    }

    /**
     * Evaluate the given code using built-in eval() function
     *
     * @param  string $code
     * @return mixed
     */
    protected function evaluate($code)
    {
        $code = $this->makeCompatible($code);

        return eval("return $code;");
    }

}

