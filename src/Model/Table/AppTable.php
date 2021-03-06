<?php
namespace Address\Model\Table;

use Cake\ORM\Table;

use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * App Table class
 */
class AppTable extends Table
{

    use SoftDeleteTrait;
    
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->addBehavior('Address.Addressable');
        $this->addBehavior('Address.Associatable');
    }

    /**
     * Set the plugin's custom database connection
     *
     */
    public static function defaultConnectionName()
    {
        return 'oxenti_address';
    }

    /**
     * _setAppRelations method  sets the all the relations outside the plugin
     * @param array $config Array with the relation data
     */
    protected function _setAppRelations($config)
    {
        foreach ($config as $relationType => $relations) {
            foreach ($relations as $name => $data) {
                $this->$relationType($name, $data);
            }
        }
    }

    /**
     * _setExtraBuildRules method  sets the all the rules to relations outside the plugin
     * @param RulesChecker $rules Table rules
     * @param array $config Array with the relation data
     */
    protected function _setExtraBuildRules($rules, $config)
    {
        foreach ($config as $ruleName => $data) {
            if (isset($data['tableName'])) {
                $rules->add($rules->$ruleName($data['keys'], $data['tableName']));
            } else {
                $rules->add($rules->$ruleName($data['keys'], $data['tableName']));
            }
        }
        return $rules;
    }
}
