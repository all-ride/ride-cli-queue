<?php

namespace ride\cli\command\queue;

use ride\cli\command\AbstractCommand;

use ride\library\queue\QueueManager;

/**
 * Command to check the queue status
 */
class QueueStatusCommand extends AbstractCommand {

    /**
     * Initializes a new queue status command
     * @return null
     */
    protected function initialize() {
    	$this->setDescription('Gets the status of a queue or a job');

        $this->addArgument('queue', 'Name of the queue', false);
        $this->addArgument('job', 'Id of the job', false);
    }

    /**
     * Invokes the command
     * @param \ride\library\queue\QueueManager $queueManager Instance of the
     * queue manager
     * @param string $queue Name of the queue
     * @param string $job Id of the job
	 * @return null
     */
    public function invoke(QueueManager $queueManager, $queue = null, $job = null) {
        if ($job) {
            $queueJobStatus = $queueManager->getQueueJobStatus($job);
            if ($queueJobStatus) {
                $queueJob = $queueJobStatus->getQueueJob();

                $this->output->writeLine(get_class($queueJob) . ' [' . $queueJobStatus->getStatus() . '] ' . $queueJobStatus->getSlot() . '/' . $queueJobStatus->getSlots());
                $this->output->writeLine($queueJobStatus->getDescription());
            } else {
                $this->output->writeLine('Job #' . $job . ' does not exist.');
            }
        } elseif ($queue) {
            $queueJobStatuses = $queueManager->getQueueJobStatuses($queue);
            foreach ($queueJobStatuses as $queueJobStatus) {
                $queueJob = $queueJobStatus->getQueueJob();

                $this->output->writeLine('- ' . $queueJob->getJobId() . ': ' . get_class($queueJob) . ' [' . $queueJobStatus->getStatus() . ']');
            }
        } else {
            $status = $queueManager->getQueueStatus();
            foreach ($status as $queue => $slots) {
                $this->output->writeLine('- ' . $queue . ': ' . $slots . " slot(s) used");
            }
        }
    }

}
