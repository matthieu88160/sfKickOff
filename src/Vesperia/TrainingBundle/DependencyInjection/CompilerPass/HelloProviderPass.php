<?php
namespace Vesperia\TrainingBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vesperia\TrainingBundle\Util\HelloWorldProvider;
use Symfony\Component\DependencyInjection\Reference;

class HelloProviderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $provider = $container->getDefinition('vesperia.hello_provider');

        $taggedServices = $container->findTaggedServiceIds('hello_provider_listener');
        foreach ($taggedServices as $serviceId => $tags) {
            $provider->addMethodCall(
                'addListener',
                [
                    HelloWorldProvider::EVENT_PROVIDE_ARGUMENT,
                    [
                        new Reference($serviceId),
                        'provide'
                    ]
                ]
            );
        }
    }
}

