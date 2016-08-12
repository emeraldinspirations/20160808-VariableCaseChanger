<?php

include_once '../src/firstIterationIdentifier.class.php';

class firstIterationIdentifierTester {
  
  function test_construct() {
    
    $pSample = new firstIterationIdentifier();
    
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
      } else {
        echo 'Test '.$pFunction.'() FAILED'."\n";
      }
    }
    
    
  }
  
}

firstIterationIdentifierTester::runTests();
