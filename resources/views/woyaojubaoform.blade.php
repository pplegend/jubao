<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

<form method="post" action="/woyaojubao" class="navbar-form navbar-left" role="search" id="woyaojubaoform"  enctype="multipart/form-data" >
    {{ csrf_field() }}

    <!--Checkbox butons-->
        <label for="jubaobody" style="width: 170px;text-align: left;">举报类型*</label>

        <div class="woyaojubao_checkbox btn-group" data-toggle="buttons">
            <label class="btn btn-default active form-check-label phone">
                <input class="form-check-input" type="radio" name="type" value="phone" checked>手机号
            </label>

            <label class="btn btn-default form-check-label qq">
                <input class="form-check-input " type="radio" name="type" value="QQ"> QQ 号
            </label>

            <label class="btn btn-default form-check-label website">
                <input class="form-check-input" type="radio" name="type" value="website"> 网站
            </label>

            <label class="btn btn-default form-check-label wechat">
                <input class="form-check-input" type="radio" name="type" value="wechat"> 微信
            </label>

            <label class="btn btn-default form-check-label email">
                <input class="form-check-input" type="radio" name="type" value="email"> 邮箱
            </label>
            <label class="btn btn-default form-check-label company">
                <input class="form-check-input" type="radio" name="type" value="company"> 企业
            </label>

            <label class="btn btn-default form-check-label others">
                <input class="form-check-input" type="radio" name="type" value="other"> 其它
            </label>
        </div>
        <!--Checkbox butons-->
        <div class="row top15">
            <div class="form-group">
                <label for="jubaobody" style="width: 170px;text-align: left;"><span class="select_text">请输入电话/手机号码</span>*</label>
                <input  id="title" name="title" class="form-control" />
            </div>
        </div>
    <div class="row top15">
        <div class="form-group">
            <label for="jubaobody" style="width: 170px;text-align: left;">详情描述*</label>
             <textarea  id="jubaobody" name="jubaobody" class="form-control" rows="5" cols="53"></textarea>
        </div>
    </div>
    <div class="row top15">
        <label for="file" style="width: 170px">相关图片</label>
        <input type="file" id="file" name="file[]" class="form-control" multiple />
        <br>
        <small id="fileHelp" class="form-text text-muted" style="margin-left: 170px">可以同时上传多张图片,每长图片小于2M</small>
    </div>
    <div class="row top15">
        <div class="col-xs-4"></div>
        <div class="col-xs-4"></div>

        <div class="col-xs-4"><button type="submit" class="btn btn-primary">提交</button></div>

    </div>
        {!! captcha_image_html('ExampleCaptcha') !!}
        <input type="text" id="CaptchaCode" name="CaptchaCode">
</form>