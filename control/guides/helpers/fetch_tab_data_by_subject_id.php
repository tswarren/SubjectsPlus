<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 3/24/16
 * Time: 12:19 PM
 */
require_once("../../includes/autoloader.php");
require_once("../../includes/config.php");
require_once("../../includes/functions.php");

use SubjectsPlus\Control\Querier;
use SubjectsPlus\Control\Guide\TabData;

header("Content-Type: application/json");
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$db = new Querier();
$subject_id = scrubData($_GET['subject_id'], 'integer');

$objTabData = new TabData($db);
$objTabData->fetchTabDataBySubjectId($subject_id);
echo $objTabData->toJSON();