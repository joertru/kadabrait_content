<?php

namespace Drupal\kadabrait_content\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class KadabraController.
 */
class KadabraController extends ControllerBase {

  /**
   * Drupal\kadabrait_content\KadabraInterface definition.
   *
   * @var \Drupal\kadabrait_content\KadabraInterface
   */
  protected $kadabraitContentDefault;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->kadabraitContentDefault = $container->get('kadabrait_content.default');
    return $instance;
  }

  /**
   * Main.
   *
   * @return string
   *   Return Hello string.
   */
  public function main() {

    $nodos = $this->kadabraitContentDefault->listnodeuserlogged(10);
    $rows = [];

    foreach( $nodos as $node) {
      $rows[] = [ $node->label(), $node->bundle() ];
    }

    $header = [
      'title' => t('Título'),
      'content' => t('Type'),
    ];

    $build['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => t('Esta tabla No tiene valores'),
    ];

    return [
      '#type' => 'markup',
      '#markup' => render($build)
    ];
  }
}
