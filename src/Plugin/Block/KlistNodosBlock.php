<?php

namespace Drupal\kadabrait_content\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'KlistNodosBlock' block.
 *
 * @Block(
 *  id = "klist_nodos_block",
 *  admin_label = @Translation("Listar 3 Nodos"),
 * )
 */
class KlistNodosBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\kadabrait_content\KadabraInterface definition.
   *
   * @var \Drupal\kadabrait_content\KadabraInterface
   */
  protected $kadabraitContentDefault;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->kadabraitContentDefault = $container->get('kadabrait_content.default');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $nodos = $this->kadabraitContentDefault->listnodeuserlogged(3);
    $rows = [];
    foreach( $nodos as $node) {
      $rows[] = [ 'title' => $node->label(), 'type' => $node->bundle() ];
    }

    
    $build = [];
    $build['#cache']['max-age'] = 0;

    $build['entradas'] = [
      '#theme' => 'listnodos',
      '#data' => $rows
    ];

    return $build;
  }

}
