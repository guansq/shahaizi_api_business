
function getCategory (id)
{
    /**
 * Created by songh on 2017/6/1 0001.
 */
var API_HOST1 = "http://shop.api.antiwearvalve.com";
var API_DETAIL = API_HOST1 + "/category/index.html";//详情页


var $bannerList=$("#banner_list");
var $carousel=$("#carousel_pic");


var $specificName=$("#specific_name");
var $cateName=$("#cate_name");
var $content=$("#content");
var detailParams= {"cid": id,"gid":1};
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: API_DETAIL,
        data: detailParams
    }).done(function (res)
    {
        if (res.status == 1)
        {
            var data = res.result;
            $specificName.html(data.specific_name);
            $cateName.html(data.cate_name);
            $content.html(data.attr_content);
            var bannerList = data.thumb_img;

            $carousel.append(' ' +
                '<div class="swiper-container"> ' +
                '<div class="swiper-wrapper" id="carousel"> ' +
                '</div> ' +
                '<div class="swiper-pagination"></div> ' +
                '</div>');

            for (var i=0;i<bannerList.length;i++) {
                var dat = bannerList[i];
                $("#carousel").append("<div class='swiper-slide'><img src='"+dat+"' alt=''/></div>")

            }

            var mySwiper = new Swiper('.swiper-container',
                {
                    pagination: '.swiper-pagination',
                    loop:true,
                    grabCursor: true,
                    paginationClickable: true,
                    autoplay: 1000,
                    spaceBetween: 30,
                    centeredSlides: true,
                    autoplayDisableOnInteraction: false
                })
            return false;
        }
        return false;
    });
}
