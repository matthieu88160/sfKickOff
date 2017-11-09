<?php
namespace Vesperia\TrainingBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class SearchDTO
{
    /**
     * @Assert\Regex("/^[0-9]{1,3}(.[0-9]{1,3}){0,3}/")
     */
    public $ipClient;// corresponde à un pattern d'ip
    
    /**
     * @Assert\Date()
     */
    public $startDate;// corresponde à une date
    
    /**
     * @Assert\Date()
     */
    public $endDate;// corresponde à une date
    
    /**
     * @Assert\Callback()
     */
    public function isValidPeriod(ExecutionContextInterface $context, $payload)
    {
        if ($this->startDate >= $this->endDate) {
            $context->buildViolation('Invalid period')
                ->atPath('startDate')
                ->addViolation();
        }
    }
}

