<form method="post" action="{{$action}}" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" class="form-control" id="context" name="context"  placeholder="{{$placeholder}}" />
    </div>

    <button type="submit" class="btn btn-primary">查找</button>
</form>