<?php
namespace Vesperia\TrainingBundle\Util;

use Vesperia\TrainingBundle\Util\RangeGenerator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;

class HelloWorldProvider extends EventDispatcher
{
    const EVENT_PROVIDE_ARGUMENT = 'provinding_arguments';
    
    public function provideArguments()
    {
        $providingEvent = new GenericEvent();
        $this->dispatch(
            self::EVENT_PROVIDE_ARGUMENT,
            $providingEvent
        );
        
        return $providingEvent->getArguments();
    }
}

