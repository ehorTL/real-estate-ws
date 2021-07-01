<?php

namespace App\Services;
use App\Services\QueryHelper;

class EntityMapper{

    public static function mapBoolToInt($entity){
        if (!is_null($entity->has_commision)){
            $entity->has_commision = QueryHelper::boolToInt($entity->has_commision);
        }
        if (!is_null($entity->realized)){
            $entity->realized = QueryHelper::boolToInt($entity->realized);
        }
        if (!is_null($entity->show_in_slider)){
            $entity->show_in_slider = QueryHelper::boolToInt($entity->show_in_slider);
        }
        if (!is_null($entity->archieved)){
            $entity->archieved = QueryHelper::boolToInt($entity->archieved);
        }

        return $entity;
    }

    public static function mapBoolToIntArray($entityArray){
        foreach($entityArray as $entity){
            self::mapBoolToInt($entity);
        }
        
        return $entityArray;
    }
}