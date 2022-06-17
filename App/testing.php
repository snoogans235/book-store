<?php
require_once('Classes/Controller.php');
require_once('Classes/Model.php');

$Controller = new Controller();

//test searching for single item to be returned with no field specified to search against
$SingleList = $Controller->SearchData('', "20th Centry Fox");
if (count($SingleList) !== 1 ){
    echo 'Single List No Key Failed! -- Incorrect number of results returned ('.count($SingleList).')';
    exit();
}

if ( $SingleList[0]['identifier'] !== '9878vdu' ){
    echo 'Single List No Key Failed! -- Incorrect result returned (isbn='.$SingleList[0]['identifier'].')';
    exit();
}

//test searching for multiple items to be returned with no field specified to search against
$MultiList = $Controller->SearchData('', "O'Reilly Media");
if ( count($MultiList) !== 4 ){
    echo 'MultiList List No Key Failed! -- Incorrect number of results returned ('.count($MultiList).')';
    exit();
}

$acceptedIds = ['987654321', '0123456789', '1123456789', '2223456789012'];
foreach($MultiList as $ml){
    $pos = array_search($ml['identifier'], $acceptedIds);
    if ( $pos === false ){
        echo 'MultiList List No Key Failed! -- Incorrect value returned ('.count($ml['identifier']).')';
        exit();
    }

    unset($acceptedIds[$pos]);
}
if ( count($acceptedIds) > 0 ){
    echo 'MultiList List No Key Failed! -- Expected results not returned  ('.implode(', ',$acceptedIds).')';
    exit();
}

$SingleKey = $Controller->SearchData('author', "O'reilly Media");

if ( count($SingleKey) !== 1 ){
    echo 'Single List With Key Failed! -- Incorrect number of results returned ('.count($SingleKey).')';
    exit();
}

if ( $SingleKey[0]['identifier'] !== '987654321' ){
    echo 'Single List With Key Failed! -- Incorrect result returned (isbn='.$SingleKey[0]['isbn'].')';
    exit();

}

$MultiKey = $Controller->SearchData('PuBlisHer', "O'reilly Media");

$acceptedIds = ['0123456789', '1123456789', '2223456789012'];
foreach($MultiKey as $ml){
    $pos = array_search($ml['identifier'], $acceptedIds);
    if ( $pos === false ){
        echo 'MultiList List With Key Failed! -- Incorrect value returned ('.count($ml['identifier']).')';
        exit();
    }

    unset($acceptedIds[$pos]);
}
if ( count($acceptedIds) > 0 ){
    echo 'MultiList List No Key Failed! -- Expected results not returned  ('.implode(', ',$acceptedIds).')';
    exit();
}

$EmptyResults = $Controller->SearchData('', 'empty test');

if ( count($EmptyResults) !== 0 ){
    echo 'Empty List Failed! -- Incorrect number of results returned ('.count($EmptyResults).')';
    exit();
}

echo 'Testing Success!';