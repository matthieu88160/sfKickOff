<?php
namespace Vesperia\TrainingBundle\Util\Provider;

use Symfony\Component\EventDispatcher\GenericEvent;
use Vesperia\TrainingBundle\Util\RangeGenerator;

class ListProvider
{
    private $generator;
    
    private $range;
    
    public function __construct(RangeGenerator $generator, $min, $max)
    {
        $this->generator = $generator;
        $this->range = [
            'min' => $min,
            'max' => $max
        ];
    }

    public function provide(GenericEvent $event)
    {
        $event->setArgument(
            'list',
            $this->generator
                ->generate($this->range['min'], $this->range['max'])
        );
    }
}

