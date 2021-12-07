
<?php
function fromHN($toPlace, $weight)
{
    $cost = 0;
    if ($toPlace['city'] == "Hồ Chí Minh" || $toPlace['city'] == "Đà Nẵng") {
        $cost += fromHCMtoHNandDN($weight, $toPlace);
    } elseif ($toPlace['city'] == "Hà Nội") {
        $cost += internalHCM($weight, $toPlace);
    } elseif (in_array($toPlace['city'], arrayPriviceNouth)) {
        $cost += fromHCMtoSounthern($weight, $toPlace);
    } elseif (in_array($toPlace['city'], arrayPriviceSouthern)) {
        $cost += fromHCMtoNorth($weight, $toPlace);
    }
    return number_format($cost, 2, ',', '.');
}

/**
 * Transaction Ha Noi to Nam
 */
function fromHNtoSouthern($weight, $toPlace, $transactionMethod = "0")
{
    $standardCost = 0;
    $overrightCost = 5000;
    if ($transactionMethod == 2) {
        if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
            $standardCost  = 35000;
        } else {
            $standardCost  = 50000;
        }
    } else {
        if (in_array($toPlace['city'], arrayInProviceHCMtoMiddle)) {
            if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
                $standardCost  = 30000;
            } else {
                $standardCost  = 37000;
            }
        } else {
            if (substr_compare($toPlace['district'], "Huyen", 0) == 2) {
                $standardCost  = 32000;
            } else {
                $standardCost  = 40000;
            }
        }
    }

    return caculator(0.5, 0.5, $weight, $standardCost, $overrightCost);
}
?>