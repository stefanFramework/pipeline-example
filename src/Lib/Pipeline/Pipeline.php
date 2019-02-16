<?php

namespace Lib\Pipeline;


use Lib\Pipeline\Exceptions\PipelineException;

class Pipeline
{
    private $name;

    /** @var array */
    private $steps;

    /** @var PipelineContext */
    private $context;

    public function __construct($name, PipelineContext $context, array $steps)
    {
        $this->name = $name;
        $this->context = $context;
        $this->steps = $steps;
    }

    /**
     * @throws PipelineException
     */
    public function __invoke()
    {
        try {
            foreach ($this->steps as $step) {
                $this->executeStep($step);
            }
        } catch (\Exception $ex) {
            throw new PipelineException($ex->getMessage(), 0, $ex);
        }
    }

    /**
     * @param $stepName
     */
    private function executeStep($stepName)
    {
        $pieplineStep = $this->generatePipelineStep($stepName);

        if (!$pieplineStep->shouldExecute()) {
            return;
        }

        $pieplineStep();
    }

    /**
     * @param $stepName
     * @return PipelineStep
     */
    private function generatePipelineStep($stepName)
    {
        return new $stepName($this->context);
    }
}