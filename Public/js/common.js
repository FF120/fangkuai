/**
 * Created by Administrator on 2015/10/24.
 */
/**
 *  //调用方法 如
 * post('pages/statisticsJsp/excel.action', {html :prnhtml,cm1:'sdsddsd',cm2:'haha'});
 * @param URL
 * @param PARAMS
 * @returns {HTMLElement}
 */
function post(URL, PARAMS) {
    var temp = document.createElement("form");
    temp.action = URL;
    temp.method = "post";
    temp.style.display = "none";
    for (var x in PARAMS) {
        var opt = document.createElement("textarea");
        opt.name = x;
        opt.value = PARAMS[x];
        temp.appendChild(opt);
    }
    document.body.appendChild(temp);
    temp.submit();
    return temp;
}
function checkMobile(mobile){
    var re = /^1[3|4|5|8][0-9]\d{4,8}$/;
    if(!re.test(mobile)){
        return false;
    } else {
        return true;
    }
}

