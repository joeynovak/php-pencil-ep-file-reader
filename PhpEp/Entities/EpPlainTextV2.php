<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpPlainTextV2 extends EpEntity{

    var $isLabel = false;
    var $label = '';
    public function __construct(){
        parent::__construct("PlainTextV2");
    }

    public function load($entityQp, EpEntityContainer $container = null){
        parent::load($entityQp, $container);
        if($entityQp->attr('p:sc') == 'Label'){
            $this->isLabel = true;
        }
        $this->label = $this->getProperty($entityQp, 'label');
    }

    public function getCakeResources(array $settings = array()){
        return array(
            'view_code' =>
            $this->getViewCode(),
            'elements' => array()
        );
    }

    public function getViewCode(){
        if($this->isLabel){
            return "<label>$this->label</label>";
        } else {
            return "<p>$this->label</p>";
        }
    }
}