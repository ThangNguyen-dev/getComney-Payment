<?php
require "./getJson.php";
require_once "./fromHCM.php";
require_once "./fromHN.php";
require_once "./otherPrivince.php";
require_once "./define.php";

/**
 * @param array $fromPlace is from place
 * @param array $toPlace is to place
 * @return int cost total
 */
$fromPlace = [
    "ward" => "Phường 5",
    "district" => "Quan 3",
    "city" => "Hà Nội",
];
$toPlace = [
    "ward" => "Phường 5",
    "district" => "Quan 3",
    "city" => "Bắc Giang",
];

function getCostTotal($fromPlace, $toPlace, $weight = 0.5)
{
    $cost = 0;
    if ($fromPlace['city'] == "Hồ Chí Minh") {
        // transaction from HCM
        $cost = fromHCM($toPlace, $weight);
    } elseif ($toPlace['city'] == "Hồ Chí Minh") {
        // transaction from HCM
        $cost = fromHN($fromPlace, $weight);
    } elseif ($fromPlace['city'] == "Hà Nội") {
        // transaction from HN
        $cost = fromHN($toPlace, $weight);
    } elseif ($toPlace['city'] == "Hà Nội") {
        // transaction from HN
        $cost = fromHN($fromPlace, $weight);
    } else {
        $cost = otherProvince($fromPlace, $toPlace, $weight);
    };

    echo $cost;
}

/**
 * calulator function cost
 * @param int $standardWeight is weight standard transaction with cost standard
 * @param int $bonusWeight is weight over right standard weight with bonus cost
 * @param int $weight is weight need calculation
 * @param int $standardCost is standard cost for transaction
 * @param int $bonusCost is cost over right standard weith
 */
function caculator($standardWeight, $bonusWeight, $weight, $standardCost,  $bonusCost)
{
    $cost = $standardCost;
    if ($weight > $standardWeight) {
        $weight = $weight - $standardWeight;
        $cost += ceil($weight / $bonusWeight) * $bonusCost;
    }
    return $cost;
}
getCostTotal($fromPlace, $toPlace);
