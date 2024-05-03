<?php

namespace App\Model;


class StatsTrendModel extends \App\Model\BaseModel
{
    protected $tableName = 'td_stats_trend';
    protected $fields    = 'id,create_time,update_time,`event_id`,`attacks`,`dangerous_attacks`,`possession`,`off_target`,`on_target`,`corners`,`goals`,`yellowcards`,`redcards`,`substitutions`';
    // 验证规则
    protected $validate_rules = array(
        'event_id'          => 'required|notEmpty',
        'attacks'           => 'required|notEmpty',
        'dangerous_attacks' => 'required|notEmpty',
        'possession'        => 'required|notEmpty',
        'off_target'        => 'required|notEmpty',
        'on_target'         => 'required|notEmpty',
        'corners'           => 'required|notEmpty',
        'goals'             => 'required|notEmpty',
        'yellowcards'       => 'required|notEmpty',
        'redcards'          => 'required|notEmpty',
        'substitutions'     => 'required|notEmpty',
    );

    // 验证错误消息提示
    protected $validate_messages = array(
        'event_id'          => 'event_id必须',
        'attacks'           => 'attacks必须',
        'dangerous_attacks' => 'dangerous_attacks必须',
        'possession'        => 'possession必须',
        'off_target'        => 'off_target必须',
        'on_target'         => 'on_target必须',
        'corners'           => 'corners必须',
        'goals'             => 'goals必须',
        'yellowcards'       => 'yellowcards必须',
        'redcards'          => 'redcards必须',
        'substitutions'     => 'substitutions必须',
    );

    // 验证字段的别名
    protected $validate_alias = array(
        'event_id'          => 'event_id',
        'attacks'           => 'attacks',
        'dangerous_attacks' => 'dangerous_attacks',
        'possession'        => 'possession',
        'off_target'        => 'off_target',
        'on_target'         => 'on_target',
        'corners'           => 'corners',
        'goals'             => 'goals',
        'yellowcards'       => 'yellowcards',
        'redcards'          => 'redcards',
        'substitutions'     => 'substitutions',
    );
    protected $validate_type  = array(
        'add'  =>
            array(
                0  => 'event_id',
                1  => 'attacks',
                2  => 'dangerous_attacks',
                3  => 'possession',
                4  => 'off_target',
                5  => 'on_target',
                6  => 'corners',
                7  => 'goals',
                8  => 'yellowcards',
                9  => 'redcards',
                10 => 'substitutions',
            ),
        'edit' =>
            array(
                0  => 'event_id',
                1  => 'attacks',
                2  => 'dangerous_attacks',
                3  => 'possession',
                4  => 'off_target',
                5  => 'on_target',
                6  => 'corners',
                7  => 'goals',
                8  => 'yellowcards',
                9  => 'redcards',
                10 => 'substitutions',
            ),
    );
    /**
     * @param $value
     * @param $data
     *
     * @return mixed `attacks` json NOT NULL,
    `dangerous_attacks` json NOT NULL,
    `possession` json NOT NULL,
    `off_target` json NOT NULL,
    `on_target` json NOT NULL,
    `corners` json NOT NULL,
    `goals` json NOT NULL,
    `yellowcards` json NOT NULL,
    `redcards` json NOT NULL,
    `substitutions` json NOT NULL,
     */

    protected function getGoalsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getAttacksAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getDangerousAttacksAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getPossessionAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getOffTargetAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getOnTargetAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getCornersAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getYellowcardsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getRedcardsAttr($value, $data)
    {
        return json_decode($value,1);
    }
    protected function getSubstitutionsAttr($value, $data)
    {
        return json_decode($value,1);
    }

    protected function setGoalsAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setAttacksAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setDangerousAttacksAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setPossessionAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setOffTargetAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setOnTargetAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setCornersAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setYellowcardsAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setRedcardsAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
    protected function setSubstitutionsAttr($value, $data)
    {
        return is_array($value) ? json_encode($value,JSON_UNESCAPED_UNICODE) : $value;
    }
}