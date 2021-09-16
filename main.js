


//URLからを取得する
function loadParam(fileUrl){
    $(document).ready(function (){
        $.ajax({
            url: fileUrl,
            type: 'GET',
        })
        .done(function (data){
            console.log(data);
        })
        .fail(function (e) {
            console.log(e)
        })
    });
}

function allRecord(fileurl) {
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: fileurl,
            success: function (data) {
                document.getElementById(id).innerHTML = data;
            }, error: function (e) {
                console.log(e);
            }
        });
    });
}

function sendParam(parson, mode){
    loadParam("./api.php?parson="+parson+"&btn=" + mode);
    update();
}

function putHtml(adult, child, add, adultSum, childSum, addSum){
    $(document).ready(function () {
        try {
            console.log(adult);
            document.getElementById("adult").innerHTML = adult;
            document.getElementById("child").innerHTML = child;
            document.getElementById("add").innerHTML = add;
            document.getElementById("adultSum").innerHTML = adultSum;
            document.getElementById("childSum").innerHTML = childSum;
            document.getElementById("addSum").innerHTML = addSum;
        } catch (ex) {}
    });
}

//値を更新する
function update(){
    $(document).ready(function () {
        $.getJSON("./info.json", function(data){
            putHtml(data.adult, data.child, data.add, data.adultSum, data.childSum, data.addSum);
        })//getJSON:指定のURLからJSONデータを受け取る関数
    })
}

function adultIncrease(){
    sendParam("adult", "increase");
    blurFunc();
}

function adultDecrease(){
    sendParam("adult", "decrease");
}

function childIncrease(){
    sendParam("child", "increase");
    blurFunc();
}

function childDecrease(){
    sendParam("child", "decrease");
    blurFunc();
}

function addIncrease(){
    sendParam("add", "increase");
    blurFunc();
}

function addDecrease(){
    sendParam("add", "decrease");
    blurFunc();
}

function allClear(){
    sendParam("clear", "clear");
    blurFunc();
}

function record(){
    sendParam("record", "record");
    record("./record.txt");
}

// フォーカスを外す
function blurFunc(){
    document.activeElement.blur();
}

//Main

// HTML読み込み完了時に実行

update();
setInterval('update()', 2 * 100);



