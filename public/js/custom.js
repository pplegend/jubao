

$(function(){
    $(".card").flip({
        trigger: "click",
        autoSize: true,
        forceWidth:true,
    });
    $(".woyaojubao_checkbox .phone").click(function () {
       $(".select_text").text("请输入手机/电话号码");
    });

    $(".woyaojubao_checkbox .qq").click(function () {
        $(".select_text").text("请输入QQ号");
    });
    $(".woyaojubao_checkbox .website").click(function () {
        $(".select_text").text("请输入网站地址");
    });
    $(".woyaojubao_checkbox .wechat").click(function () {
        $(".select_text").text("请输入微信号");
    });
    $(".woyaojubao_checkbox .email").click(function () {
        $(".select_text").text("请输入邮件地址");
    });
    $(".woyaojubao_checkbox .company").click(function () {
        $(".select_text").text("请输入公司名称");
    });
    $(".woyaojubao_checkbox .others").click(function () {
        $(".select_text").text("请输入简要信息");
    });

});