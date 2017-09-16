/**
 * Created by songh on 2017/9/15 0015.
 */
var $shz_rd_pic=$("#shz_rd_pic");
var $rd_title=$("#rd_title");
var $rd_num=$("#rd_num");
var $rd_content=$("#rd_content");

var $id=GetQueryString("id");
var RouteParams={token:"",line_id:""};
$(function(){
    Index();
});

function Index() {
    RouteParams.line_id=$id;
    RouteParams.token=token;
    alert(token);
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url:" http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=lineDetail",
        data: RouteParams
    }).done(function (res) {
        if (res.status == 1) {
           var data=res.result;
            $shz_rd_pic.attr(src,data.cover_img);
            $rd_title.html(data.line_title);
            $rd_num.html(data.line_price);
            $rd_content.html(data.line_highlights);
            var $list=data.line_detail;
            for (var i in $list){
                var $lis=$list[i];
            }
        }
        return false;
    });
}

function GetQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}