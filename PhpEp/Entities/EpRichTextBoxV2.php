<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpRichTextBoxV2 extends EpEntity{

    public function __construct(){
        parent::__construct("RichTextBoxV2");
    }

    public function load($entityQp, EpEntityContainer $container = null){
        parent::load($entityQp, $container);
    }

    public function getCakeResources(array $settings = array()){
        return array(
            'view_code' =>
            "<div>$this->text</div>",
            'elements' => array()
        );
    }
}