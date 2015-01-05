<?php

  /*
   *
   * Copyright Alexander Beider and Stephen P. Morse, 2008
   *
   * This file is part of the Beider-Morse Phonetic Matching (BMPM) System.

   * BMPM is free software: you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation, either version 3 of the License, or
   * (at your option) any later version.
   *
   * BMPM is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   *
   * You should have received a copy of the GNU General Public License
   * along with BMPM.  If not, see <http://www.gnu.org/licenses/>.
   *
   */

  switch (filter_input(INPUT_GET, 'type')) {
    case 'ash':
      $languages = array(
        'any', 'cyrillic', 'english', 'french', 'german', 'hebrew', 'hungarian', 'polish',
        'romanian', 'russian', 'spanish'
      );
      $any       = 1;
      $cyrillic  = 2;
      $english   = 4;
      $french    = 8;
      $german    = 16;
      $hebrew    = 32;
      $hungarian = 64;
      $polish    = 128;
      $romanian  = 256;
      $russian   = 512;
      $spanish   = 1024;
      break;
    case 'sep':
      $languages = array(
        'any', 'french', 'hebrew', 'italian', 'portuguese', 'spanish'
      );
      $any        = 1;
      $french     = 2;
      $hebrew     = 4;
      $italian    = 8;
      $portuguese = 16;
      $spanish    = 32;
      break;
    default:
    case 'gen':
       $languages = array(
        'any', 'arabic', 'cyrillic', 'czech', 'dutch', 'english', 'french', 'german', 'greek',
        'greeklatin', 'hebrew', 'hungarian', 'italian', 'polish', 'portuguese','romanian',
        'russian', 'spanish', 'turkish'
       );
      $any = 1;
      $arabic = 2;
      $cyrillic = 4;
      $czech = 8;
      $dutch = 16;
      $english = 32;
      $french = 64;
      $german = 128;
      $greek = 256;
      $greeklatin = 512;
      $hebrew = 1024;
      $hungarian = 2048;
      $italian = 4096;
      $polish = 8192;
      $portuguese = 16384;
      $romanian = 32768;
      $russian = 65536;
      $spanish = 131072;
      $turkish = 262144;
      break;
  }

  $rules = array();
  $approx = array();
  $exact = array();

  function LanguageIndex($langName, $languages) {
    for ($i=0; $i<count($languages); $i++) {
      if ($languages[$i] == $langName) {
        return $i;
      }
    }
    return 0; // name not found
  }

  function LanguageName($index, $languages) {
    if ($index < 0 || $index > count($languages)) {
      return "any"; // index out of range
    }
    return $languages[$index];
  }

  function LanguageCode($langName, $languages) {
    return pow(2, LanguageIndex($langName, $languages));
  }

  function LanguageIndexFromCode($code, $languages) {
    if ($code < 0 || $code > pow(2, count($languages)-1)) { // code out of range
      return 0;
    }
    $log = log($code, 2);
    $result = floor($log);
    if ($result != $log) { // choice was more than one language, so use "any"
      $result = LanguageIndex("any", $languages);
    }
    return $result;
  }
?>
