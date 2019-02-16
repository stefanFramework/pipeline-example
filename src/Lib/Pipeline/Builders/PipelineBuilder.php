<?php
namespace Lib\Pipeline\Builders;


use Lib\Pipeline\Pipeline;
use Lib\Pipeline\PipelineContext;

class PipelineBuilder
{
    public static function build($name, PipelineContext $context, array $steps)
    {
        return new Pipeline($name, $context, $steps);
    }
}