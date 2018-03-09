<form method="post" action="/admin/phone" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group mb-2">
        <input type="text" class="form-control" id="title" name="phone" placeholder="号码" />
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="text" id="description" name="description" class="form-control" placeholder="部门" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>