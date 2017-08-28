/**
 * 计数器JS文件
 */

// var newsIds = {};
// $(".news_count").each(function(i){
//     newsIds[i] = $(this).attr("news-id");
// });
//
// //调试
// //console.log(newsIds);
//
// url = "/index.php?c=index&a=getCount";
//
// $.post(url, newsIds, function(result){
//     if(result.status  == 1) {
//         counts = result.data;
//         $.each(counts, function(news_id,count){
//             $(".node-"+news_id).html(count);
//         });
//     }
// }, "JSON");

var test;
var data = {};
$('.news_count').each(function (i) {
    // console.log($(this).attr('news-id'));
    data[i] = $(this).attr('news-id');
});

console.log(data);

var url = './index.php?a=index&a=getCount';

$.post(url, data, function (result) {
    // console.log(result);


    if (result.status == 0) {
        dialog.error(result.message);
    } else if (result.status == 1) {
        // console.log(result.data);

        count = result.data;
        console.log(count);
        $.each(count, function (k, v) {

            // console.log(k+'---'+v);

            $('.node-' + k).html(v);

        })
    }
}, 'json');