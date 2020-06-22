<?php

namespace App\Traits;

use ErrorException;
use Illuminate\Database\Eloquent\Relations\Relation;
use ReflectionClass;
use ReflectionMethod;

trait RelationshipsTrait
{
    protected $relationships;

    public function relationships() {

        $model = new static;

        $relationships = [];

        foreach((new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
        {
            if ($method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__) {
                continue;
            }

            try {
                $return = $method->invoke($model);

                if ($return instanceof Relation) {
                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName(),

                        'foreignKey' => (new ReflectionClass($return))->hasMethod('getForeignKey') ? $return->getForeignKey() : ((new ReflectionClass($return))->hasMethod('getForeignKeyName') ? $return->getForeignKeyName() : ''),
                    ];
                }
            } catch(ErrorException $e) {}
        }

        $this->relationships = $relationships;

        return $relationships;
    }

    public function subChildrenRelations() {
      $sub_children_relations = [];

      foreach ($this->relationships as $methode_name => $arr) {
        if ($arr['type'] == 'HasMany') {
          $arr['sub_objects'] = $this->{$methode_name};
          $sub_children_relations[$methode_name] = $arr;
        }
      }

      return $sub_children_relations;
    }
}
