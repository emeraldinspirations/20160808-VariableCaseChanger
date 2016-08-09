<?php

interface iVariableType {
  
  /**
                                                                          |
   * This function returns a boolian value indicating if the supplied
   *  Variable Name can be of this type.  Since each Variable Type can't
   *  know all possible other types, it is possible there would be
   *  colisions.  The main class would then throw an Ambigouous Variable
   *  Type exception.
   */
  public static function canBeType($vVariableName);
  public static function fromVariableName($vVariableName);
  public static function fromWordArray(array $vWordArray);
  public function toVariableName();
  public function toWordArray();
  
}
