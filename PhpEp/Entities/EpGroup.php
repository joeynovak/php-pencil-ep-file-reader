<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 12/16/12
 * Time: 12:10 AM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpGroup extends EpEntityContainer{
    public function load($entityQp, EpEntityContainer $container = null){
        parent::load($entityQp, $container, $container);
        $this->entities = $this->loadEntities($entityQp);
    }

    public function getCakeResources(array $settings = array()){
        return array(
            'view_code' => '',
            'elements' => array()
        );
    }

    protected function getEntityXmlElements($entityQp) {
        $entityQp->find("> g");
    }
}