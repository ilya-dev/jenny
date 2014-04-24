<?php namespace Jenny\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Jenny\Jenny;

class REPL extends Command {

    /**
     * The instance of Jenny
     *
     * @var \Jenny\Jenny
     */
    protected $jenny;

    /**
     * The Output instance
     *
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * The DialogHelper instance
     *
     * @var \Symfony\Component\Console\Helper\DialogHelper
     */
    protected $dialog;

    /**
     * The constructor
     *
     * @param  \Jenny\Jenny $jenny
     * @return REPL
     */
    public function __construct(Jenny $jenny = null)
    {
        parent::__construct();

        $this->jenny = $jenny ?: new Jenny;
    }

    /**
     * Configure the command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('repl');

        $this->setDescription('Play around with the interpreter');
    }

    /**
     * Execute the command
     *
     * @param  \Symfony\Component\Console\Input\InputInterface   $input
     * @param  \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->dialog = $this->getHelperSet()->get('dialog');

        while(($command = $this->askForCommand()) !== 'quit')
        {
            $output->writeln('<info># => '.$this->jenny->run($command).'</info>');
        }
    }

    /**
     * Ask the user for a command
     *
     * @var string
     */
    protected function askForCommand()
    {
        return $this->dialog->ask($this->output, '>>> ');
    }

}

