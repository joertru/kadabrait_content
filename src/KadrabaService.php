<?php

namespace Drupal\kadabrait_content;
use \Drupal\node\Entity\Node;

/**
 * Class KadrabaService.
 */
class KadrabaService implements KadabraInterface {

  /**
   * Constructs a new KadrabaService object.
   */
  public function __construct() {

  }

  public function listnodeuserlogged( $num_nodes ){

    $user = \Drupal::currentUser();
    $nids = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('uid', $user->id())
            //->condition('type', 'article')
            ->sort('created', 'DESC')
            ->range(0, $num_nodes)
            ->execute();
    $nodes = Node::loadMultiple($nids);
    return $nodes;
  }

}
