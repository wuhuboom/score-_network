<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemDetailGetTicketTimeRule {

    /**
        时间规则生效模式（"IN":"包含","EX":"排除）
     **/
    public $rule_apply_mode;

    /**
        时分维度的规则（10:00~12:00）
     **/
    public $hour_min_rules;

    /**
        星期维度的规则（周一到周日分别是：1~7）
     **/
    public $week_rules;

    /**
        日维度的规则:某天到某天
     **/
    public $date_rules;


    public function getRuleApplyMode() : string{
        return $this->rule_apply_mode;
    }

    public function setRuleApplyMode(string $ruleApplyMode){
        $this->rule_apply_mode = $ruleApplyMode;
    }

    public function getHourMinRules() : array{
        return $this->hour_min_rules;
    }

    public function setHourMinRules(array $hourMinRules){
        $this->hour_min_rules = $hourMinRules;
    }

    public function getWeekRules() : array{
        return $this->week_rules;
    }

    public function setWeekRules(array $weekRules){
        $this->week_rules = $weekRules;
    }

    public function getDateRules() : array{
        return $this->date_rules;
    }

    public function setDateRules(array $dateRules){
        $this->date_rules = $dateRules;
    }


}

