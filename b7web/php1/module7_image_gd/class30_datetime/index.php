<?php
$date1 = new DateTime('now', new DateTimeZone('America/Sao_paulo'));
$date2 = new DateTime('2021-06-15', new DateTimeZone('America/Sao_paulo'));
//$date->setTimezone(new DateTimeZone('America/Sao_paulo'));

//$date->add(DateInterval::createFromDateString('2 days 5 minutes'));

//$date->sub(DateInterval::createFromDateString('2 days 5 minutes'));

//echo $date->format('d/m/Y H:i:s');

if ($date2 > $date1) {
    echo 'É maior';
} else {
    echo 'É menor';
}

$diff = $date1->diff($date2);
print_r($diff);
echo $diff->format('%a dias');
