<?php

/**
 * determine from HCM to other area
 * @param array $to_place is add to transaction to from HCM
 * @return int cost calculator.
 */
function fromHCM($toPlace, $weight)
{
    $cost  = 0;
    if ($toPlace['city'] == "Hà Nội" || $toPlace['city'] == "Đà Nẵng") {
        $cost += fromHCMtoHNandDN($weight, $toPlace);
    } elseif ($toPlace['city'] == "Hồ Chí Minh") {
        $cost += internalHCM($weight, $toPlace);
    } else {
        $cost += fromHCMtoNorth($weight, $toPlace);
    };
    return number_format($cost, 2, ',', '.');
}

/**
 * Transaction Ho Chi Minh to Ha Noi or to Da Nang
 */
function fromHCMtoHNandDN($weight, $toPlace, $transactionMethod = "0")
{
    $standardCost = 0;
    $overrightCost = 0;
    if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
        if ($transactionMethod == 0) {
            $standardCost = 40000;
        } else {
            $standardCost = 44000;
        }
        $overrightCost = 5000;
    } else {
        if ($transactionMethod == 0) {
            $standardCost = 30000;
        } else {
            $standardCost = 33000;
        }
        $overrightCost = 10000;
    }
    return caculator(0.5, 0.5, $weight, $standardCost, $overrightCost);
}



/**
 * Transaction Ho Chi Minh to Nam
 */
function fromHCMtoNorth($weight, $toPlace, $transactionMethod = "0")
{
    $standardCost = 0;
    $overrightCost = 2500;
    if ($transactionMethod == 2) {
        if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
            $standardCost  = 50000;
        } else {
            $standardCost  = 35000;
        }
    } else {
        if (in_array($toPlace['city'], arrayInProviceHCMtoMiddle)) {
            if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
                $standardCost  = 30000;
            } else {
                $standardCost  = 37000;
            }
        } {
            if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
                $standardCost  = 40000;
            } else {
                $standardCost  = 32000;
            }
        }
    }
    return caculator(0.5, 0.5, $weight, $standardCost, $overrightCost);
}

/**
 * Transaction Internal Ho Chi Minh
 * @param int $transactionMethod is method transaction
 * @return int cost for method transaction
 */
function internalHCM($weight, $toPlace)
{
    $standardCost = 22000;

    if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
        $standardCost = 30000;
    }
    return caculator(0.5, 0.5, $weight, $standardCost, 5000);
}

function fromHCMtoSounthern($weight, $toPlace)
{
    $standardCost = 30000;
    
    if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
        $standardCost = 35000;
    }
    return caculator(0.5, 0.5, $weight, $standardCost, 2500);
}

/**
 * set cost for method transaction
 * @param int $transactionMethod is method transaction
 * @return int cost for method transaction
 */
function setCostMethodType($transactionMethod, $costStandard, $costFast)
{
    $cost = $costStandard;
    if ($transactionMethod == TRANSACTION_METHOD_FAST) {
        $cost = $costFast;
    }
    return $cost;
}
