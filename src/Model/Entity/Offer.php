<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Offer Entity
 *
 * @property int $id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property string $request_message
 * @property string $free_message
 * @property int $status
 * @property \Cake\I18n\FrozenTime $accepted
 * @property \Cake\I18n\FrozenTime $cancelled
 * @property \Cake\I18n\FrozenTime $called
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Offer extends Entity
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
        'from_user_id' => true,
        'to_user_id' => true,
        'request_message' => true,
        'free_message' => true,
        'status' => true,
        'accepted' => true,
        'cancelled' => true,
        'called' => true,
        'created' => true,
        'modified' => true,
        'from_user' => true,
        'to_user' => true
    ];
}
