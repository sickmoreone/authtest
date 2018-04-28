<?php
/**
 * Created by PhpStorm.
 * User: zidoo
 * Date: 2018/4/24
 * Time: 10:02
 */
/*
 * 版本的测试状态
 * */
function ceshistatu($a)
{
    if($a==0)
    {
        return '未测试';
    }
    else if($a==1)
    {
        return '测试中';
    }
    else if($a==2)
    {
        return '测试通过';
    }
    else if($a==3)
    {
        return '测试不通过';
    }
    else if($a==4)
    {
        return '取消测试';
    }
}
/*
 * 删除字符最后一个，
 * */
function delcomma($string)
{
    $string=substr($string,0,strlen($string)-1);
    return $string;

}