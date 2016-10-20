<?php

namespace Phulp\Server;

use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\EventLoop\Factory;
use Phulp\Output;

class Server
{
    private $options = [
        'address' => 'localhost',
        'port' => '8000',
        'router' => null,
        'path' => null
    ];

    private $loop = null;

    private $process = null;

    public function __construct(array $options, LoopInterface $loop = null)
    {
        $this->options = $options = array_merge($this->options, $options);
        $this->loop = $this->loop ?: Factory::create();

        $process = sprintf(
            'php -S %s:%s %s',
            $this->options['address'],
            $this->options['port'],
            $this->options['router']
        );

        $this->process = $process = new Process($process, $this->options['path']);

        $output = sprintf(
            'phulp-server: The server will be started in http://%s:%s',
            $options['address'],
            $options['port']
        );
        Output::out(Output::colorize($output, 'blue'));

        $this->loop->addTimer(0.001, function($timer) use ($process) {
            $process->start($timer->getLoop());

            $output = function($data) {
                if (! empty($data)) {
                    $data = trim($data);
                    Output::out(Output::colorize('phulp-server: ' . $data, 'yellow'));
                }
            };

            $process->stdout->on('data', $output);
            $process->stderr->on('data', $output);
        });

        $this->process->on('exit', function ($exitCode, $termSignal) {
            Output::colorize('phulp-server: Server terminated', 'blue');
        });
    }

    public function fireRun()
    {
        $this->loop->run();
    }

    public function __destruct()
    {
        if ($this->process->isRunning()) {
            $this->process->terminate();
        }
    }
}
