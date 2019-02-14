<?php
namespace Workflow\Builders;


use Workflow\Workflow;
use Workflow\WorkflowContext;

class WorkflowBuilder
{
    public static function build($name, WorkflowContext $context, array $activities) {
        return new Workflow($name, $context, $activities);
    }
}