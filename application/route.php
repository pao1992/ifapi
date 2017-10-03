<?php
/**
 * 路由注册
 *
 * 以下代码为了尽量简单，没有使用路由分组
 * 实际上，使用路由分组可以简化定义
 * 并在一定程度上提高路由匹配的效率
 */

// 写完代码后对着路由表看，能否不看注释就知道这个接口的意义
use think\Route;

//Miss 404
//Miss 路由开启后，默认的普通模式也将无法访问
//Route::miss('api/v1.Miss/miss');

//Banner
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');
Route::POST('api/:version/banner', 'api/:version.Banner/addImage');
Route::PUT('api/:version/banner/:id', 'api/:version.Banner/updateOne');


//Theme
// 如果要使用分组路由，建议使用闭包的方式，数组的方式不允许有同名的key
//Route::group('api/:version/theme',[
//    '' => ['api/:version.Theme/getThemes'],
//    ':t_id/product/:p_id' => ['api/:version.Theme/addThemeProduct'],
//    ':t_id/product/:p_id' => ['api/:version.Theme/addThemeProduct']
//]);

Route::group('api/:version/theme',function(){
    Route::get('', 'api/:version.Theme/getSimpleList');
    Route::get('/:id', 'api/:version.Theme/getComplexOne');
    Route::post(':t_id/product/:p_id', 'api/:version.Theme/addThemeProduct');
    Route::delete(':t_id/product/:p_id', 'api/:version.Theme/deleteThemeProduct');
});

//Route::get('api/:version/theme', 'api/:version.Theme/getThemes');
//Route::post('api/:version/theme/:t_id/product/:p_id', 'api/:version.Theme/addThemeProduct');
//Route::delete('api/:version/theme/:t_id/product/:p_id', 'api/:version.Theme/deleteThemeProduct');

//Product
Route::post('api/:version/product', 'api/:version.Product/createOne');
Route::get('api/:version/product/:id', 'api/:version.Product/getOne',[],['id'=>'\d+']);
Route::put('api/:version/product/:id', 'api/:version.Product/updateProduct',[],['id'=>'\d+']);
Route::delete('api/:version/product/:id', 'api/:version.Product/deleteOne');
Route::get('api/:version/product/by_category/:id', 'api/:version.Product/getByCategory',[],['id'=>'\d+']);
Route::get('api/:version/product/recent', 'api/:version.Product/getRecent');
Route::get('api/:version/product/all', 'api/:version.Product/getAllProducts');

//coupon
Route::post('api/:version/coupon', 'api/:version.Coupon/createOne');
Route::get('api/:version/coupon/:id', 'api/:version.Coupon/getOne',[],['id'=>'\d+']);
Route::get('api/:version/coupon/all', 'api/:version.Coupon/getAllCoupons',[],['id'=>'\d+']);
Route::delete('api/:version/coupon/:id', 'api/:version.Coupon/deleteOne',[],['id'=>'\d+']);
Route::get('api/:version/coupon/by_user', 'api/:version.Coupon/getCouponByUser',[],['id'=>'\d+']);
Route::get('api/:version/coupon/by_date', 'api/:version.Coupon/getCouponsByDate',[],['id'=>'\d+']);
//userCoupon
Route::get('api/:version/userCoupon', 'api/:version.UserCoupon/getAllUserCoupons');
Route::delete('api/:version/userCoupon/:id', 'api/:version.UserCoupon/deleteOne',[],['id'=>'\d+']);

//user
Route::get('api/:version/user/:id', 'api/:version.User/getUserById',[],['id'=>'\d+']);
Route::get('api/:version/user', 'api/:version.User/getAllUsers');
<<<<<<< HEAD

//card


=======
Route::post('api/:version/user/by_filter', 'api/:version.User/getUserByFilter');
Route::post('api/:version/user/by_card/:id', 'api/:version.User/getUserByCard',[],['id'=>'\d+']);
>>>>>>> origin/master




//Category
Route::get('api/:version/category', 'api/:version.Category/getCategories'); 
// 正则匹配区别id和all，注意d后面的+号，没有+号将只能匹配个位数
Route::get('api/:version/category/with_products', 'api/:version.Category/getCategoryTreeWithProds');
//Route::get('api/:version/category/:id/products', 'api/:version.Category/getCategory',[], ['id'=>'\d+']);
Route::get('api/:version/category/all', 'api/:version.Category/getAllCategories');
Route::get('api/:version/category/tree', 'api/:version.Category/getCategoryTree');

//新增一个分类
Route::post('api/:version/category', 'api/:version.Category/createOne');


Route::group('api/:version/category/:id',function(){
    Route::put('', 'api/:version.Category/updateCategory');
    Route::get('', 'api/:version.Category/getCategory');
    Route::delete('', 'api/:version.Category/deleteOne');
}, ['id'=>'\d+']);





//Token
Route::post('api/:version/token/user', 'api/:version.Token/getToken');

Route::post('api/:version/token/app', 'api/:version.Token/getAppToken');
Route::post('api/:version/token/verify', 'api/:version.Token/verifyToken');

//Address
Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');
Route::get('api/:version/address', 'api/:version.Address/getUserAddress');

//Order
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail',[], ['id'=>'\d+']);
Route::put('api/:version/order/delivery', 'api/:version.Order/delivery');
Route::put('api/:version/order/:id', 'api/:version.Order/updateOne',[], ['id'=>'\d+']);

//不想把所有查询都写在一起，所以增加by_user，很好的REST与RESTFul的区别
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');
Route::get('api/:version/order/paginate', 'api/:version.Order/getSummary');

//Pay
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');
Route::post('api/:version/pay/concurrency', 'api/:version.Pay/notifyConcurrency');

//Message
Route::post('api/:version/message/delivery', 'api/:version.Message/sendDeliveryMsg');
//event
Route::get('api/:version/event', 'api/:version.Event/getEvents');
Route::post('api/:version/event', 'api/:version.Event/createOne');
Route::delete('api/:version/event/:id', 'api/:version.Event/deleteOne',[], ['id'=>'\d+']);
//system
Route::get('api/:version/system', 'api/:version.System/getSummary');
Route::put('api/:version/system', 'api/:version.System/updateOne');
Route::post('api/:version/system/logo', 'api/:version.System/updateLogo');

//card
//Route::get('api/:version/card', 'api/:version.Card/getAllCards');
//Route::get('api/:version/card/:id', 'api/:version.Card/getCardById',[], ['id'=>'\d+']);
//Route::post('api/:version/card', 'api/:version.Card/createOne');
//Route::put('api/:version/card/:id', 'api/:version.Card/updateOne',[], ['id'=>'\d+']);
//Route::delete('api/:version/card/:id', 'api/:version.Card/deleteOne',[], ['id'=>'\d+']);
//Route::post('api/:version/cardBinding', 'api/:version.Card/binding');//卡绑定用户
//Route::delete('api/:version/cardBinding', 'api/:version.Card/binding');//卡解绑用户
Route::post('api/:version/card/get_user_by_filter', 'api/:version.User/getUserByFilter');//获取该卡下的用户数据
Route::group('api/:version/card',function(){
    Route::get('', 'api/:version.Card/getAllCards');
    Route::get('/:id', 'api/:version.Card/getCardById',[], ['id'=>'\d+']);
    Route::post('', 'api/:version.Card/createOne');
    Route::delete('/:id', 'api/:version.Card/deleteOne',[], ['id'=>'\d+']);

    //卡下用户
    Route::post('/:id/bind_user/:user_id', 'api/:version.Card/bindUser',[],['id'=>'\d+','user_id'=>'\d+']);//新增关联
    Route::get('/:id/user', 'api/:version.Card/getusers',[],['id'=>'\d+']);//查询用户
});






//return [
//        ':version/banner/[:location]' => 'api/:version.Banner/getBanner'
//];

//Route::miss(function () {
//    return [
//        'msg' => 'your required resource are not found',
//        'error_code' => 10001
//    ];
//});
//文件上传
Route::post('api/:version/upload', 'api/:version.Upload/index');





