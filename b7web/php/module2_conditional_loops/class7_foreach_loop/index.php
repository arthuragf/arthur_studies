<?php
/* 04/07/2021 - Arthur Faria
 * Array with the ingredients to make a cake
 */
$ingredients = [
    'ingredient1' => 'flour'
    , 'ingredient2' => 'sugar'
    , 'ingredient3' => 'eggs'
    , 'ingredient4' => 'milk'
    , 'ingredient5' => 'baking soda'
];

/* 04/07/2021 - Arthur Faria
 * Printing the ingredients with foreach just to test the
 * structure without using $k => $v
 */
echo '<h1>Ingredients:</h1>';
echo '<ul>';
foreach($ingredients as $item) {
    echo '<li>' . $item . '</li>';
}
echo '</ul>';