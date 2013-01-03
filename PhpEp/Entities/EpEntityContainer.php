<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/1/13
 * Time: 6:09 PM
 * To change this template use File | Settings | File Templates.
 */
require_once("EpEntity.php");
class EpEntityContainer extends EpEntity{

    public function __construct(){

    }

    protected function loadEntities($entityQp) {
        $entities = array();

        $this->getEntityXmlElements($entityQp);

        foreach ($entityQp as $entityInfo) {
            $def = $entityInfo->attr("p:def");
            $type = $entityInfo->attr("p:type");

            $entity = null;

            if ($type == "Group") {
                $entity = Ep::loadGroup($entityInfo, $this);
            } else if ($type == "Shape") {
                if ($def != '') {
                    $entity_type = array_pop(explode(":", $def));
                    $entity = Ep::loadEntity($entity_type, $entityInfo, $this);
                } else {
                    throw new Exception("No Def Found For Shape...");
                }
            }

            if ($entity != null) {
                $entities[] = $entity;
            }
        }

        $entityQp->end();

        $entities = $this->sortEntitiesByTop($entities);

        return $entities;
    }

    protected function getEntityXmlElements($entityQp) {
        throw new Exception("getEntityXmlElements not yet implemented");
    }

    protected function sortEntitiesByTop($entities){
        $entityArray = array();
        foreach($entities as $entity){
            /** @var $entity EpEntity */
            $entityArray[$entity->top][] = $entity;
        }

        ksort($entityArray);

        $entities = array();
        foreach($entityArray as $entitiesWithSameTop){
            $entities = array_merge($entities, $entitiesWithSameTop);
        }

        return $entities;
    }
}
