<?php

include_once '../src/firstIterationIdentifier.class.php';

class firstIterationIdentifierTester {
  
  function test_construct() {
    
    $pSample = new firstIterationIdentifier();
    
    self::typeTest('Object creation failed', 'firstIterationIdentifier', $pSample);
    
    return TRUE;
  }
  
  static function typeTest($vIssue, $vExpected, $vActual) {
    if(!$vActual instanceof $vExpected) {
      throw new Exception(
        'ISSUE:    '.$vIssue."\n".
        'EXPECTED: '.$vExpected."\n".
        'ACTUAL:   '.gettype($vActual)
      );
    }
  }
  
  function test_isFirst() {
    $pInstance = new firstIterationIdentifier();
    
    for($x=0;$x<10;$x++) {
      $pTestValue = $pInstance->isFirst();
      if( $pTestValue !== TRUE ) {
        throw new Exception (
          'ISSUE:    Pre-Mature iteration'."\n".
          'EXPECTED: TRUE'."\n".
          'ACTUAL:   '.var_export($pTestValue, true)
        );
      }
    }
    
    $pTestValue = $pInstance->isFirst( TRUE );
    if( $pTestValue !== TRUE ) {
      throw new Exception (
        'ISSUE:    Pre-Mature isteration, when iterate set TRUE'."\n".
        'EXPECTED: TRUE'."\n".
        'ACTUAL:   '.var_export($pTestValue, true)
      );
    }
    
    for($x=0;$x<10;$x++) {
      $pTestValue = $pInstance->isFirst( 'A' );
      if( $pTestValue === TRUE ) {
        throw new Exception (
          'ISSUE:    Iteration not retained'."\n".
          'EXPECTED: FALSE'."\n".
          'ACTUAL:   '.var_export($pTestValue, true)
        );
      } elseif ( $pTestValue !== FALSE ) {
        throw new Exception (
          'ISSUE:    Future iterations override existing'."\n".
          'EXPECTED: FALSE'."\n".
          'ACTUAL:   '.var_export($pTestValue, true)
        );
      }
    }
    
    return TRUE;
  }
  
  static function runTests() {
    $pTesterClass = new firstIterationIdentifierTester();
    $pFunctions   = get_class_methods('firstIterationIdentifierTester');
    
    foreach($pFunctions as $pFunction) {
      
      if(substr($pFunction, 0, 5) != 'test_') {
        continue;
      }
      
      $pResult = FALSE;
      try {
        $pResult = $pTesterClass->{$pFunction}();
      } catch (Exception $e) {
        $pResult = $e;
      }
      
      if($pResult === TRUE) {
        echo 'Test '.$pFunction.'() PASSED'."\n";
      } elseif ($pResult instanceof Exception) {
        echo 'Test '.$pFunction.'() ERROR'."\n".$pResult->getMessage()."\n";
      } else {
        echo 'Test '.$pFunction.'() FAILED'."\n";
      }
    }
    
    
  }
  
}

firstIterationIdentifierTester::runTests();
