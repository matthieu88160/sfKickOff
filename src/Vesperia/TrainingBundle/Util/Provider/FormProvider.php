<?php
namespace Vesperia\TrainingBundle\Util\Provider;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\GenericEvent;
use Vesperia\TrainingBundle\DTO\SearchDTO;
use Vesperia\TrainingBundle\Form\SearchLogType;
use Symfony\Component\Form\FormInterface;
use Vesperia\TrainingBundle\Entity\Repository\ConnectionLogRepository;

class FormProvider extends EventDispatcher
{
    const EVENT_PROCESS_FORM = 'process_form';
    
    const EVENT_PREPARE_DISPLAY = 'prepare_display';
    
    private $formFactory;
    
    private $request;
    
    private $repository;

    public function __construct(
        FormFactoryInterface $formFactory,
        Request $request,
        ConnectionLogRepository $repo
    ) {
        $this->formFactory = $formFactory;
        $this->request = $request;
        $this->repository = $repo;
        
        $this->addListener(self::EVENT_PROCESS_FORM, [$this, 'instanciateDTO'], 1024);
        $this->addListener(self::EVENT_PROCESS_FORM, [$this, 'provideForm'], 512);
        $this->addListener(self::EVENT_PROCESS_FORM, [$this, 'validateForm'], 256);
        $this->addListener(self::EVENT_PROCESS_FORM, [$this, 'processForm'], 128);
        
        $this->addListener(self::EVENT_PREPARE_DISPLAY, [$this, 'prepareDisplay']);
    }

    public function provide(GenericEvent $event)
    {
        $formEvent = new GenericEvent();
        $formEvent->setArguments($event->getArguments());
        $this->dispatch(self::EVENT_PROCESS_FORM, $formEvent);
        
        $displayEvent = new GenericEvent();
        $displayEvent->setArguments($formEvent->getArguments());
        $this->dispatch(self::EVENT_PREPARE_DISPLAY, $displayEvent);
        
        $event->setArguments($displayEvent->getArguments());
    }
    
    public function instanciateDTO(GenericEvent $event)
    {
        $dto = new SearchDTO();
        $event->setArgument('DTO', $dto);
    }
    
    public function provideForm(GenericEvent $event)
    {
        $form = $this->formFactory->create(
            SearchLogType::class,
            $event->getArgument('DTO')
        );
        $event->setArgument('form', $form);
    }
    
    public function validateForm(GenericEvent $event)
    {
        $form = $event->getArgument('form');

        $form->handleRequest($this->request);
        
        if (!$form->isSubmitted() || !$form->isValid()) {
            $event->stopPropagation();
        }
    }
    
    public function processForm(GenericEvent $event)
    {
        /**
         * 
         * @var FormInterface $form
         */
        $form = $event->getArgument('form');
        $event->setArgument('logs', $this->repository->findBySearchDTO($form->getData()));
    }

    public function prepareDisplay(GenericEvent $event)
    {
        $form = $event->getArgument('form');
        $event->setArgument('form', $form->createView());
    }
}

