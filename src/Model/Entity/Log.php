<?php
namespace App\Model\Entity;
use Cake\Utility\Security;
use Cake\ORM\Entity;
use Cake\Core\Configure;

/**
 * Log Entity
 *
 * @property int $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $id_number
 * @property string $id_type
 * @property string $note
 * @property string $assigned_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $cleared
 */
class Log extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'firstname' => true,
        'lastname' => true,
        'id_number' => true,
        'id_type' => true,
        'note' => true,
        'assigned_by' => true,
        'created' => true,
        'cleared' => true
    ];
  
  
    
}
