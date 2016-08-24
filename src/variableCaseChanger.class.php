<?php

/**
 * This function will accept a variable name as it's construct parameter.  It
 * will then determine what naming convention is used, and output the next
 * convention, in sequence, from the list of supplied conventions.
 * 
 * The class will first determine if any known delimiter character is present.
 * All delimiter characters are treated as equal, but the first is used as the
 * "current", this follows the Robustness Principle: "Be conservative in what
 * you do, be liberal in what you accept from others."
 * 
 * When no known delimiter character is present, the class will then look for
 * mixed case.  Each capital letter following the first character is treated
 * as a new word.  The exception being when all characters are capital.
 * 
 * When all characters are capital, and no known delimiter characters are
 * present, then an ambiguity has been introduced.  Either there is only one
 * word, or all the words are one letter long.  Since the later is extremely
 * unlikely, and would probably causes undesired and problematic results, the
 * class assumes that it is a single word.  Unless the
 * IGNORE_SINGLE_LETTER_SCENARIO (I) flag is supplied.
 * 
 * Once the variable name is decoded, it is outputted in either the supplied
 * convention, or the next in the list of supplied conventions.  When no
 * conventions are supplied the default list of conventions is used.
 * 
 * The default list of conventions is:
 * - camelCaseA          (c)
 * - CamelCaseB          (C)
 * - ALL_CAPS_UNDERSCORE (U)
 * - no_caps_underscore  (u)
 * - ALL-CAPS-HYPHEN     (H)
 * - no-caps-hyphen      (h)
 * 
 * For single word variable names, unless the IGNORE_SINGLE_WORD_SCENARIO (i)
 * flag is passed, the list becomes
 * - ALLCAPS
 * - alllower
 * - Camel
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
    self::CONV_CAMEL_CASE_A,
    self::CONV_CAMEL_CASE_B,
    self::CONV_ALL_CAPS_UNDERSCORE,
    self::CONV_NO_CAPS_UNDERSCORE,
    self::CONV_ALL_CAPS_HYPHEN,
    self::CONV_NO_CAPS_HYPHEN
  ];
  
  protected $_ignoreSingleLetterScenario    = FALSE;
  protected $_ignoreSingleWordScenario      = FALSE;
  protected $_FirstDeliminerChar            = NULL;
  protected $_WordArray                     = [];
  
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
  
  /**
   * http://stackoverflow.com/a/9025946
   */
  static function setRef_toEndOfArray(&$vRef, &$vArray) {
    $vRef = &$vArray[count($vArray) - 1];
  }
  
  static function fromWordArray(array $vWordArray) {
    $pReturn = new variableCaseChanger();
    $pReturn->_WordArray = $vWordArray;
    return $pReturn;
  }
  
  public function getWordArray() {
    
  }
  
  /*
  public function __construct(
    $vVariableName, $vToggleOrderArray = NULL,
    $vIgnoreSingleLetterScenario = FALSE, $vIgnoreSingleWordScenario = FALSE
  ) {
    
    $this->_ToggleOrderArray = ( isset($vToggleOrderArray) 
            ? $vToggleOrderArray 
            : $this->_ToggleOrderArray );
    
    $this->_ignoreSingleLetterScenario  = $vIgnoreSingleLetterScenario;
    $this->_ignoreSingleWordScenario    = $vIgnoreSingleWordScenario;
    
    $pCharArray   = str_split($vVariableName, 1);
    $pDelimArray  = new wordArrayBuilder();
    $pCamelArray  = new wordArrayBuilder();
    $pFirstDelim  = new firstIterationIdentifier();
    
    foreach($pCharArray as $pChar) {
      
      if(in_array(self::KNOWN_DELIMITER_ARRAY, $pChar)) {
        $pDelimArray->pushBuffer();
        $pFirstDelim->iterateValue($pChar);
      } else {
        $pDelimArray->concatenateBuffer($pChar);
      }
      
      if(self::getCharCase($pChar) == MB_CASE_UPPER) {
        $pCamelArray->pushBuffer();
      }
      $pCamelArray->concatenateBuffer($pChar);
      
    }
    
    if($pDelimArray->count() > 1) {
      $this->_WordArray           = $pDelimArray->toArray();
      $this->_FirstDeliminerChar  = $pFirstDelim->getFirstValue();
    } else {
      $this->_WordArray           = $pCamelArray;
    }

  }
  */
}
