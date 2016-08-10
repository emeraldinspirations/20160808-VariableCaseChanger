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
  protected $_FirstDeliminerChar            = NULL;
  protected $_WordArray                     = [];
  
  static function setIfNotNull(&$vParam, $vValue) {
    if(!isnull($vValue)) {
      $vParam = $vValue;
    }
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
  
  /**
   * http://stackoverflow.com/a/9025946
   */
  static function setRef_toEndOfArray(&$vRef, &$vArray) {
    $vRef = &$vArray[count($vArray) - 1];
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
    
    $pCharArray   = str_split($vString, 1);
    $pDelimArray  = [''];
    $pCamelArray  = [''];
    
    $pDelimLast   = '';
    $pCamelLast   = '';
    self::setRef_toEndOfArray($pDelimLast, $pDelimArray);
    self::setRef_toEndOfArray($pCamelLast, $pCamelArray);
    
    foreach($pCharArray as $pChar) {
      
      if(in_array(self::KNOWN_DELIMITER_ARRAY, $pChar)) {
        $pDelimArray[] = '';
        self::setRef_toEndOfArray($pDelimLast, $pDelimArray);
        if(isnull($this->_FirstDeliminerChar)) {
          $this->_FirstDeliminerChar = $pChar;
        }
      } else {
        $pDelimLast .= $pChar;
      }
      
      if(self::getCharCase($pChar) == MB_CASE_UPPER) {
        $pCamelArray[] = '';
        self::setRef_toEndOfArray($pCamelLast, $pCamelArray);
      }
      $pCamelLast .= $pChar;
      
    }
    
    if(count($pDelimArray) > 1) {
      // Delimited Array
    } else {
      $this->_WordArray = $pCamelArray;
    }

  }
  
}
