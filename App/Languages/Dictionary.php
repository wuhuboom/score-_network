<?php

namespace App\Languages;

use EasySwoole\I18N\AbstractDictionary;

// 定义一个词典。
// const 值请务必于 const 变量名一致，这样是避免用户手敲词条名称出错
class Dictionary extends AbstractDictionary
{
    const HELLO = 'HELLO';
    const GOOD_MORNING = 'GOOD_MORNING';
    const HOME = 'HOME';
    const WELCOME = '%s! Welcome to the %s!!!!';
}