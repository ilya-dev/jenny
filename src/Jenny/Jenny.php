<?php namespace Jenny;

use Jenny\Lexer\Tokenizer;
use Jenny\Lexer\Reader;
use Jenny\Lexer\Analyzer;

use Jenny\Evaluator\Evaluator;
use Jenny\Evaluator\Container;
use Jenny\Evaluator\ExpressionBuilder;

class Jenny {

    /**
     * The Tokenizer instance.
     *
     * @var Lexer\Tokenizer
     */
    protected $tokenizer;

    /**
     * The Evaluator instance.
     *
     * @var Evaluator\Evaluator
     */
    protected $evaluator;

    /**
     * The constructor.
     *
     * @param  Lexer\Tokenizer|null $tokenizer
     * @param  Evaluator\Evaluator|null $evaluator
     * @return Jenny
     */
    public function __construct(
        Tokenizer $tokenizer = null,
        Evaluator $evaluator = null
    )
    {
        $this->tokenizer = $tokenizer ?: new Tokenizer(new Reader, new Analyzer);

        $this->evaluator = $evaluator ?:
            new Evaluator($container, new ExpressionBuilder(new Container));
    }

    /**
     * Run the given line of code.
     *
     * @param string $code
     * @return string
     */
    public function run($code)
    {
        $tokens = $this->tokenizer->tokenize($code);

        return $this->evaluator->evaluateLine($tokens);
    }

}


