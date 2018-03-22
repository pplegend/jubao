<form method="post" action="{{$action}}" class="navbar-form navbar-left" role="search" id="frontsearchform">
    {{ csrf_field() }}
    <div class="form-inline">
        <input type="text" class="form-control" id="context" name="context"  placeholder="{{$placeholder}}" />
        <a id="woyaojubao" class="btn btn-default" href="{{ route('pz_jubao.show') }}">我要举报</a>
        <button type="submit" class="btn btn-default">查找</button>
    </div>

</form>