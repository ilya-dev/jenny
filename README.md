**Jenny** is a very simple interpreter for **AEL** (short for *arithmetic expression language*), which was created mostly for educational purposes.

![](http://i.imgur.com/fYUPYF0.png)

# Syntax

> Attention, please: at this very moment, **functions** are not supported. 

A number is represented as a series of digits which can be optionally followed by a decimal point and another series of digits, like so:

```
18
9.3
```

You can use `/ * + - ^ %` operators and `()` for grouping, consider the following example:

```
(2 + 3) * (15 / 3) 
(5 % 2) * -1
(6 - 2) + (9 ^ 3)
```

You also can use `-` for negation, as shown in the example above.

Note that all white spaces are completely ignored and have no meaning in AEL.

You can create variables, like so:

```
foo = 16 ^ 4
```

Now you can reference this variable:

``` 
bar = 2 * foo
```

Here is the list of predefined variables:

+ `pi`, which is equal to `3.1415926535897931`
+ `e`, which is equal to `2.7182818284590451`

So now that you are quite familiar with the syntax, let's see what we have here.`

# Installation

Grab the code from the repository and then go to the project's root directory:

```
git clone https://github.com/ilya-dev/jenny
cd jenny/
```

Now just install all the dependencies:

```
composer update
```

# Features

Now that we have Jenny successfully installed on our machine, let's see what it offers.

## REPL

A tiny REPL is available for you out-of-the-box thanks to awesome `symfony/console` component.

Just run `jenny repl` and you're ready to tinker around with the interpreter!

## Executing a file

You can also store your code in files. The extension can anything you like, but, if you can, stick with `.ael`, that's fine.

As a quick example, create `test.ael`:

```
echo "(2 ^ 5) * 2" > test.ael
```

And execute the file:

```
jenny run test.ael
```

The output should be similar to what's below:
```
>>> (2 ^ 5) * 2
# => 64
```

# License

Everything is released under the MIT license. You can do whatever you want as long as you include the original copyright and license. 

Check the `LICENSE` file for more information. 

# Status

At the moment, you can just clone this repository and play around with the interpreter.

But there is still a bunch of things to do:

+ Write more tests, test in isolation
+ Improve code quality, do some refactoring

+ Add support for functions

# Author

Jenny is created by [Ilya S](https://github.com/ilya-dev). Follow me on Twitter [@ilya_s_dev](https://twitter.com/ilya_s_dev)

