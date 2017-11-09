<?php
namespace Vesperia\TrainingBundle\Util;

class RangeGenerator
{
    public function generate($min,$max)
    {   
        return range($min,$max);
    }
}

