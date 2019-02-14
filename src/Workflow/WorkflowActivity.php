<?php
namespace Workflow;

class WorkflowActivity
{
    private $context;

    public function __construct(WorkflowContext $context)
    {
        $this->context = $context;
    }

    public function validate()
    {
        return;
    }

    public function shouldExecute()
    {
        return true;
    }

    public function execute()
    {
        return;
    }

    public function __invoke()
    {
        $this->validate();
        $this->execute();
    }
}