<?php
//check to see if cakephp is loaded (APP_DIR) or if the QueryPath class is already defined...  If neither are true then we include the bundled version of QueryPath
if(!defined("APP_DIR") && !class_exists("QueryPath")){
    require_once("PhpEp/QueryPath/QueryPath.php");
}

require_once("PhpEp/Ep.php");

$ep = new Ep();
$objectTree = $ep->epToObjectTree(dirname(__FILE__) . '/PhpEp/Tests/two_pages.ep');

var_dump($objectTree);