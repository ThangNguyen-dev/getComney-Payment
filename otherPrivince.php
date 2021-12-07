<?php
function otherProvince($fromPlace, $toPlace, $weight)
{
    $cost = 0;
    if ($fromPlace['city'] == $toPlace['city']) {
        $cost += interProvice($toPlace, $weight);
    } elseif (
        in_array($fromPlace['city'], arrayPriviceMiddle) && in_array($toPlace['city'], arrayPriviceMiddle) ||
        in_array($fromPlace['city'], arrayPriviceSouthern) && in_array($toPlace['city'], arrayPriviceSouthern) ||
        in_array($fromPlace['city'], arrayPriviceNouth) && in_array($toPlace['city'], arrayPriviceNouth)
    ) {
        $cost += internalArea($toPlace, $weight);
    } else {
        $cost += interRegion($toPlace, $weight, $transactionMethod = TRANSACTION_METHOD_STANDARD);
    }
    return number_format($cost, 2, ',', '.');
};

function interProvice($toPlace, $weight)
{
    $standardCost = 0;
    $overrightCost = 2500;
    if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
        $standardCost  = 16500;
    } else {
        $standardCost  = 30000;
    }
    return caculator(3, 0.5, $weight, $standardCost, $overrightCost);
}

function internalArea($toPlace, $weight)
{
    $standardCost = 0;
    $overrightCost = 2500;
    if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
        $standardCost  = 35000;
    } else {
        $standardCost  = 30000;
    }
    return caculator(0.5, 0.5, $weight, $standardCost, $overrightCost);
}

function interRegion($toPlace, $weight, $transactionMethod)
{
    $standardCost = 0;
    $overrightCost = 5000;
    if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
        $standardCost  = 30000;
    } else {
        $standardCost  = 35000;
    }
    return caculator(0.5, 0.5, $weight, $standardCost, $overrightCost);
}
