<?php

/**
 * Description of phpTrait
 *
 * @author emeraldinspirations
 */
class phpTrait {
  
  static function usesTrait($vObject, $vTrait) {
    return isset(class_uses($vObject)[$vTrait]);
  }
  
}
