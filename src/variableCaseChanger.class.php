<?php

/**
 * This function will accept a variable name as it's construct parameter.  It
 *  will then determine what nameing convention is used, and output the next
 *  convention, in sequence, from the list of supplied conventions.
 * 
 * The class will first determine if any known delimiter charictar is present.
 *  All delimiter charichtars are treated as equal, but the first is used as the
 *  "current", this follows the Robustness Principle: "Be conservative in what
 *  you do, be libral in what you accept from others."
 * 
 * When no known delimiter charictar is present, the class will then look for
 *  mixed case.  Each capital letter following the first charichtar is treeted
 *  as a new word.  The exception being when all charictars are capital.
 * 
 * When all charictars are capital, and no known delimiter charicters are
 *  present, then an ambiguity has been introduced.  Either there is only one
 *  word, or all the words are one letter long.  Since the later is extremely
 *  unlikely, and would probubly causes undesired and problematic results, the
 *  class assumes that it is a single word.  Unless the
 *  IGNORE_SINGLE_LETTER_SCENARIO (I) flag is supplied.
 * 
 * Once the variable name is decoded, it is outputed in either the supplied
 *  convention, or the next in the list of supplied conventions.  When no
 *  conventions are supplied the default list of conventions is used.
 * 
 * The default list of conventions is:
 *  - camelCaseA          (c)
 *  - CamelCaseB          (C)
 *  - ALL_CAPS_UNDERSCORE (U)
 *  - no_caps_underscore  (u)
 *  - ALL-CAPS-HYPHEN     (H)
 *  - no-caps-hyphen      (h)
 * 
 * For single word variable names, unless the IGNORE_SINGLE_WORD_SCENARIO (i)
 *  flag is passed, the list becomes
 *  - ALLCAPS
 *  - alllower
 *  - Camel
 */
class variableCaseChanger {
  
  const CONV_CAMEL_CASE_A                   = 'c';
  const CONV_CAMEL_CASE_B                   = 'C';
  const CONV_ALL_CAPS_UNDERSCORE            = 'U';
  const CONV_NO_CAPS_UNDERSCORE             = 'u';
  const CONV_ALL_CAPS_HYPHEN                = 'H';
  const CONV_NO_CAPS_HYPHEN                 = 'h';
  const FLAG_IGNORE_SINGLE_LETTER_SCENARIO  = 'I';
  const FLAG_IGNORE_SINGLE_WORD_SCENARIO    = 'i';

  
  static $KNOWN_DELIMITER_ARRAY             = ['_', '-'];
  
  protected $_ToggleOrderArray              = [
    CONV_CAMEL_CASE_A,
    CONV_CAMEL_CASE_B,
    CONV_ALL_CAPS_UNDERSCORE,
    CONV_NO_CAPS_UNDERSCORE,
    CONV_ALL_CAPS_HYPHEN,
    CONV_NO_CAPS_HYPHEN
  ];
  
  protected $_ignoreSingleLetterScenario    = FALSE;
  protected $_ignoreSingleWordScenario      = FALSE;
  
  
  static function setIfNotNull(&$vParam, $vValue) {
    if(!isnull($vValue)) {
      $vParam = $vValue;
    }
  }
  
  protected static function charDelimiter($vChar) {
    return in_array($vChar, self::KNOWN_DELIMITER_ARRAY);
  }
  
  static function getCharCase($vChar) {
    
    if(ctype_alpha($vChar)) {
      if(ctype_upper($vChar)) {
        return MB_CASE_UPPER;
      } else {
        return MB_CASE_LOWER;
      }
    }

    return FALSE;
  }
  
  protected static function ucaseDelimiter($vChar) {
   return self::getCharCase($vChar) == MB_CASE_UPPER; 
  }
  
  public function customExplode(callback $vDelimiterFunction, $vString) {
    $pCharArray = str_split($vString, 1);
    $pElement   = '';
    $pReturn    = '';
    
    foreach($pCharArray as $pChar) {
      if($vDelimiterFunction($pChar)) {
        
      }
    }
    
  }
  
  public function __construct(
    $vVariableName, $vToggleOrderArray = NULL,
    $vIgnoreSingleLetterScenario = FALSE, $vIgnoreSingleWordScenario = FALSE
  ) {
    
    self::setIfNull(  $this->_ToggleOrderArray,
                      $vToggleOrderArray                  );
    self::setIfNull(  $this->_ignoreSingleLetterScenario,
                      $vIgnoreSingleLetterScenario        );
    self::setIfNull(  $this->_ignoreSingleWordScenario,
                      $vIgnoreSingleWordScenario          );
    
    //array_walk
  }
  
  // OLD CODE
  static function strposArray($vHaystack, $vNeedleArray = []) {
    
    foreach($vNeedleArray as $pNeedle) {
      $pResult = strpos($vHaystack, $pNeedle);
      if($pResult !== FALSE) { return $pResult; }
    }
    
    return FALSE;
  }

  static function getAllCharCase($vString) {
    
    $pCharArray = str_split($vString, 1);
    $pCaseArray = [MB_CASE_UPPER, MB_CASE_LOWER];
    
    $pReturn = NULL;
    
    foreach($pCharArray as $pChar) {
      $pCharType = self::getCharType($pChar);
      
      if(!in_array($pCase, $pCharType)) {
        // Do Nothing
      } elseif(isnull($pReturn)) {
        $pReturn = $pCharType;
      } elseif($pReturn != $pCharType) {
        return FALSE;
      }
    }

  }
  
  static function getCharType($vChar) {
    
    if(ctype_alpha($vChar)) {
      if(ctype_upper($vChar)) {
        return MB_CASE_UPPER;
      } else {
        return MB_CASE_LOWER;
      }
    }

    return FALSE;
  }
  
}
