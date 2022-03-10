<div class="post   col-sm-12 col-md-6 col-lg-4 rounded">
    <form action="{{ route('create_user_brand' ,'en') }}" method="post">
        <input type="hidden" name="vendor_id" value="{{ $vendor->id }}" id="">
        <div class="row">
            <div class="col-md-9">
                <input type="name" name="name" class="form-control" placeholder="Enter Name" id="">
            </div>
            <div class="col-md-9">
                <input type="email" name="email" class="form-control" placeholder="Enter email" id="">
            </div>
            <div class="col-md-9">
                <input type="password" name="password" class="form-control" placeholder="Enter password" id="">
            </div>
            <input type="submit" value="submit" class="btn btn-info">
        </div>
    </form>
</div>