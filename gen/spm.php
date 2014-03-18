<?php

/*
  $name = "küçük";

  $letters = "/ü[eaiouä]/";
  $rv = preg_match($letters, $name);
  echo "rv=$rv<br>";

  $letters = "/ü[ä]/";
  $rv = preg_match($letters, $name);
  echo "rv=$rv<br>";

  $letters = "/[ä]/";
  $rv = preg_match($letters, $name);
  echo "rv=$rv<br>";

  $letters = "/ä/";
  $rv = preg_match($letters, $name);
  echo "rv=$rv<br>";
*/

  $ra = true;

  if ($ra) {
    $input = "ر"; // ra
  } else {
    $input = "ذ"; // da
  }
    $inputLength = strlen($input);

    $patternPos = 0;
    $lcontextPos = 1;
    $rcontextPos = 2;
    $phoneticPos = 3;
    $languagePos = 4;
    $logicalPos = 5;

if ($ra) {
//        $rule = array("ر","","‎","r1"); // bad ra
        $rule = array("ر","","","r1"); // good ra
} else {
        $rule = array("ذ","","","d1"); // da
}
        $pattern = $rule[$patternPos];
        $patternLength = strlen($pattern);
        $lcontext = $rule[$lcontextPos];
        $rcontext = $rule[$rcontextPos];

        // check to see if next sequence in input matches the string in the rule
        if ($patternLength > $inputLength-$i || substr($input, $i, $patternLength) != $pattern) { // no match
echo "fail 1<br>";
exit;
        }

        $right = "/^$rcontext/";
        $left = "/$lcontext" . '$' . "/";

        // check that right context is satisfied
        if ($rcontext != "") {
echo "rcontext not blank<br>";
          if (!preg_match($right, substr($input, $i+$patternLength))) {
echo "fail 2<br>";
exit;
          }
        }

        // check that left context is satisfied
        if ($lcontext != "") {
          if (!preg_match($left, substr($input, 0, $i))) {
echo "fail 3<br>";
exit;
          }
        }

echo "success<br>";



?>
