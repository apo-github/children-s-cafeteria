<?php

//var_dumpでデバック
//info.json {"adult":0,"child":0, "add":0}
// 文字コード設定
header('Content-Type: application/json; charset=UTF-8');
//他ドメインからのAPIアクセスを許可する
header('Access-Control-Allow-Origin: *');

function jsonLoad(){
    return file_get_contents("./info.json");
}

function jsonWrite($arr){
    $val = json_encode($arr);//json形式の文字列へ変換
    echo($val);//返す
    file_put_contents("./info.json", $val);//json書き込み
}

function record($record) {
    file_put_contents("./record.txt", date("Y-m-d-H:i:s") . "\t" . $record, FILE_APPEND);
}

function calc($parson, $btn){
    switch($btn){
        case "increase":
            $parson++;
            break;
        case "decrease":
            if($parson > 0){
                $parson--;
            }
            break;
    }
    return $parson;
}

function calcSum($parson, $btn){
    if($btn == "increase"){
        $parson++;
    }else{}
    return $parson;
}


////   Main   ////

//値取り出し
$info = json_decode(jsonLoad());//jsonを配列へデコード
$adult = $info->adult;//jsonファイルの値を取得 [取り出し元->取り出し先変数]
$child = $info->child;
$add = $info->add;

$adultSum = $info->adultSum;
$childSum = $info->childSum;
$addSum = $info->addSum;
$clear = "";


//GETパラメータ取得///////
//http://hoge.com/blog?date=20180101&page=2
//$_GET["date"];
// $_GET["page"];
////////////////////////
$parson = htmlspecialchars($_GET["parson"]);//未定義の場合はnullを返す
$btn = htmlspecialchars($_GET["btn"]);//未定義の場合はnullを返す
switch($parson){
    case "adult":
        $adult = calc($adult, $btn);
        $adultSum = calcSum($adultSum, $btn);
        break;
    case "child":
        $child = calc($child, $btn);
        $childSum = calcSum($childSum, $btn);
        break;
    case "add":
        $add = calc($add, $btn);
        $addSum = calcSum($addSum, $btn);
        break;
    case "clear":
        $adult = 0;
        $child = 0;
        $add = 0;
        $adultSum = 0;
        $childSum = 0;
        $addSum = 0;
        break;
    case "record":
        record($info);
        break;
}



// $addSum = $addSum+1;
//infoが示す先のxに$xを代入する
$info->adult = $adult;
$info->child = $child;
$info->add = $add;
$info->adultSum = $adultSum;
$info->childSum = $childSum;
$info->addSum = $addSum;

jsonWrite($info);

// // 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
// echo json_encode($arr, JSON_PRETTY_PRINT);

?>