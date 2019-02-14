<?php
namespace Workflow;


use Workflow\Exceptions\WorkflowException;

class Workflow
{
    private $name;

    /** @var array */
    private $activities;

    /** @var WorkflowContext */
    private $context;

    public function __construct($name, WorkflowContext $context, array $activities)
    {
        $this->name = $name;
        $this->context = $context;
        $this->activities = $activities;
    }

    /**
     * @throws WorkflowException
     */
    public function __invoke()
    {
        try {
            foreach ($this->activities as $activity) {
                $this->executeActivity($activity);
            }
        } catch (\Exception $ex) {
            throw new WorkflowException($ex->getMessage(), 0, $ex);
        }
    }

    /**
     * @param $activityName
     */
    private function executeActivity($activityName)
    {
        $activity = $this->generateActivity($activityName);

        if (!$activity->shouldExecute()) {
            return;
        }

        $activity();
    }

    /**
     * @param $activityName
     * @return WorkflowActivity
     */
    private function generateActivity($activityName)
    {
        return new $activityName($this->context);
    }
}