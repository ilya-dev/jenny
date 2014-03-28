<?php namespace Jenny\Evaluator;

class Container {

    /**
     * The array of variables
     *
     * @var array
     */
    protected $variables = [];

    /**
     * The constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->variables = require __DIR__.'/config/variables.php';
    }

    /**
     * Get the value associated with the given key
     *
     * @param  string $key
     * @return mixed
     */
    public function get($key)
    {
        if ( ! array_key_exists($key, $this->variables)) return null;

        return $this->variables[$key];
    }

    /**
     * Add a key => value pair
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function set($key, $value)
    {
        $this->variables[strval($key)] = $value;
    }

}

