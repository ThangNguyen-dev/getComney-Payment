<?php
const TRANSACTION_METHOD_STANDARD = 0;
const TRANSACTION_METHOD_FAST = 1;
const COST_TRANSACTION_HCM_HN_STANDARD = 30000;
const COST_TRANSACTION_HCM_HN_FAST = 33000;
const COST_INTERNAL_HN_HCM = 22000;
const COST_INTERNAL_AREA = 30000;
const COST_HCM_HN_MIDDLE_STANDARD = 30000;
const COST_HN_MIDDLE_STANDARD = 37000;
const COST_HCM_MIDDLE_NORTH_STANDARD_IN = 32000;
const COST_HN_MIDDLE_SOUTHERN_STANDARD_IN = 40000;
const COST_HCM_MIDDLE_NORTH_FAST = 32000;
const COST_HN_MIDDLE_SOUTHERN_FAST = 40000;

/**
 * Cac tinh giam gia mien trung
 */
const arrayInProviceHCMtoMiddle = array("Hòa Bình", "Hưng Yên", "Hải Dương", "Hải Phòng", "Hà Nam", "Thái Bình", "Nam Định", "Ninh Bình");

/**
 * cac tinh phia nam
 */
const arrayPriviceSouthern = ["Cà Mau"];

/**
 * Cac tinh phia Bac
 */
const arrayPriviceNouth = ["Bắc Giang"];

/**Cac tinh mien trung */
const arrayPriviceMiddle = ["Phú Yên", "Đà Nẵng"];
