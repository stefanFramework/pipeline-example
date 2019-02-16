<?php
namespace Lib\Pipeline;

class PipelineStep
{
    private $context;

    public function __construct(PipelineContext $context)
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