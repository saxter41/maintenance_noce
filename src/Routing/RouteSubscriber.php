<?php

namespace Drupal\maintenance_node\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('system.site_maintenance_mode')) {
      $route->setDefault('_form', 'Drupal\maintenance_node\Form\MaintenanceNodeForm');
    }
  }

}
