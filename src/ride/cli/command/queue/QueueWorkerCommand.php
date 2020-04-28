<?php

namespace ride\cli\command\queue;

use ride\cli\command\AbstractCommand;

use ride\library\queue\worker\QueueWorker;
use ride\library\queue\QueueManager;

/**
 * Command to run a queue worker
 */
class QueueWorkerCommand extends AbstractCommand {

    /**
     * Constructs a new queue worker command
     */
    protected function initialize() {
        $this->setDescription('Runs a queue worker');

        $this->addArgument('queue', 'Name of the queue', false);
        $this->addArgument('sleep', 'Time in seconds between polling for jobs', false);
        $this->addArgument('maxJobs', 'Maximum number of jobs to invoke', false);
    }

    /**
     * Executes the command
     * @param \ride\library\queue\worker\QueueWorker $queueWorker
     * @param \ride\library\queue\QueueManager $queueManager
     * @param string $queue Name of the queue
     * @param integer $sleep Time in seconds to sleep between polling for jobs
     * @param integer $maxJobs Maximum number of jobs to invoke
     */
    public function invoke(
        QueueWorker $queueWorker,
        QueueManager $queueManager,
        $queue = 'default',
        $sleep = 0,
        $maxJobs = 0
    ) {
        $queueWorker->work($queueManager, $queue, $sleep, $maxJobs);
    }

}
