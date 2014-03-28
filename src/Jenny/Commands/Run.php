<?php namespace Jenny\Commands;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Jenny\Jenny;

class Run extends Command {

    /**
     * The Jenny instance
     *
     * @var \Jenny\Jenny
     */
    protected $jenny;

    /**
     * The constructor
     *
     * @param  \Jenny\Jenny|null $jenny
     * @return void
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
        $this->setName('run');

        $this->setDescription('Interpret the given file');

        $this->setDefinition([
            new InputArgument('path', InputArgument::REQUIRED, 'Path to the file'),
        ]);
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
        $lines = $this->readFile($input->getArgument('path'));

        foreach ($lines as $line)
        {
            $output->write('>>> '.$line);

            $output->writeln('<info># => '.$this->jenny->run($line).'</info>');
        }
    }

    /**
     * Read the given file into an array
     *
     * @param  string $path
     * @return array
     */
    protected function readFile($path)
    {
        $path = __DIR__.'/../../../'.$path;

        if ( ! is_readable($path))
        {
            throw new \RuntimeException(
                "The file ($path) is not readable or does not exist"
            );
        }

        return file($path);
    }

}

