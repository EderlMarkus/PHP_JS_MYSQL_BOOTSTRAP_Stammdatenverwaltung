<?php
$start = strtotime("2021-10-17");
echo "<br>";
$end = strtotime("2020-11-30");
echo "<br>";
echo time();
echo "<br>";

echo secondsToDays($end - $start);

function secondsToDays($seconds)
{
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a');
}
