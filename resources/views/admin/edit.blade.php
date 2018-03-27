@extends('admin/admin_template')
@section('content')
    <div class="col-sm-8">
        <form method="post" action="/admin/pzs/<?php echo $pz->id; ?>" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">号码*</label>
                <input type="text" class="form-control" id="title" name="title"  value="{{$pz->title}}"/>
            </div>
            <div class="form-group">
                <label for="body">详情描述*</label>
                <input type="text" id="body" name="body" class="form-control" value="{{$pz->body}}" />
            </div>
            <div class="form-group">
                <label for="file">相关图片</label>
                <input type="file" id="file" name="file[]" class="form-control" multiple />
                <small id="fileHelp" class="form-text text-muted">可以上传多张照片</small>
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>
@endsection