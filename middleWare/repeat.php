<?php

global $Event, $Message, $Queue;

if(fromGroup() && !preg_match('/签到/', $Message) && !preg_match('/签出/', $Message)){
if($Message == "此处消息的转义尚未被插件支持")leave();

if(getData("repeat/{$Event['group_id']}-1")==''){
    $a = getData("repeat/{$Event['group_id']}-2");
    $b = getData("repeat/{$Event['group_id']}-3");
    $c = getData("repeat/{$Event['group_id']}-4");
    if($a == $Message && $b == $Message && $c != $Message){
        if(coolDown('repeat/'.$Event['group_id'])>0){
            coolDown('repeat/'.$Event['group_id'], 60);
            $Queue[]= sendBack($a);
        }
        setData("repeat/{$Event['group_id']}-1", $Message, true);
        setData("repeat/{$Event['group_id']}-2", '');
        setData("repeat/{$Event['group_id']}-4", $Message, true);
        leave();
    }else{
        setData("repeat/{$Event['group_id']}-1", $Message, true);
        setData("repeat/{$Event['group_id']}-2", '');
        setData("repeat/{$Event['group_id']}-4", '');
    }
}else if(getData("repeat/{$Event['group_id']}-2")==''){
    $a = getData("repeat/{$Event['group_id']}-1");
    $b = getData("repeat/{$Event['group_id']}-3");
    $c = getData("repeat/{$Event['group_id']}-4");
    if($a == $Message && $b == $Message && $c != $Message){
        if(coolDown('repeat/'.$Event['group_id'])>0){
            coolDown('repeat/'.$Event['group_id'], 60);
            $Queue[]= sendBack($a);
        }
        setData("repeat/{$Event['group_id']}-2", $Message, true);
        setData("repeat/{$Event['group_id']}-3", '');
        setData("repeat/{$Event['group_id']}-4", $Message, true);
        leave();
    }else{
        setData("repeat/{$Event['group_id']}-2", $Message, true);
        setData("repeat/{$Event['group_id']}-3", '');
        setData("repeat/{$Event['group_id']}-4", '');
    }
}else if(getData("repeat/{$Event['group_id']}-3")==''){
    $a = getData("repeat/{$Event['group_id']}-1");
    $b = getData("repeat/{$Event['group_id']}-2");
    $c = getData("repeat/{$Event['group_id']}-4");
    if($a == $Message && $b == $Message && $c != $Message){
        if(coolDown('repeat/'.$Event['group_id'])>0){
            coolDown('repeat/'.$Event['group_id'], 60);
            $Queue[]= sendBack($a);
        }
        setData("repeat/{$Event['group_id']}-3", $Message, true);
        setData("repeat/{$Event['group_id']}-1", '');
        setData("repeat/{$Event['group_id']}-4", $Message, true);
        leave();
    }else{
        setData("repeat/{$Event['group_id']}-3", $Message, true);
        setData("repeat/{$Event['group_id']}-1", '');
        setData("repeat/{$Event['group_id']}-4", '');
    }
}

}

?>
