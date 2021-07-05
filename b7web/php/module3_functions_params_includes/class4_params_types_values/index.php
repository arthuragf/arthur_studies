<?php
/** Arthur Faria 04/07/2021
 * Function that receives specific type, just to test if
 * PHP will resolve type mismatch
 */
function sumIntegers(int $nNumber1, int $nNumber2) {
    return $nNumber1 + $nNumber2;
}

echo sumIntegers('2',3);