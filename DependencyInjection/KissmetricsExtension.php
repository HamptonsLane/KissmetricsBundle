<?php

namespace Bundle\KissmetricsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class KissmetricsExtension extends Extension {

	protected $resources = array(
		'kissmetrics_tracker'   => 'tracker.xml',
	);

	public function trackerLoad($config, ContainerBuilder $container) {
		if (!$container->hasDefinition('kissmetrics.tracker')) {
			$loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
			$loader->load($this->resources['kissmetrics_tracker']);
		}
		if (isset($config['config'])) {
			$container->setParameter('kissmetrics.tracker.config', $config['config']);
		}
		return $container;
	}

	public function getAlias() {
		return 'kissmetrics';
	}

	public function getNamespace() {
		return 'http://www.symfony-project.org/schema/dic/kissmetrics';
	}

	public function getXsdValidationBasePath() {
		return __DIR__.'/../Resources/config/schema';
	}

}
