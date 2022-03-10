<div class="post   col-sm-12  rounded">
    <form action="{{ route('create_user_brand', [ 'locale' => app()->getLocale()]) }}" method="post">
        @csrf
        <input type="hidden" name="vendor_id" value="{{ $vendor->id }}" id="">
        <div class="row">
            <div class="col-md-12 form-group">
                <input type="name" name="name" class="form-control" placeholder="Enter Name" id="">
            </div>
            <div class="col-md-12 form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter email" id="">
            </div>
            <div class="col-md-12 form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter password" id="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info">submit</button>
        </div>
        </div>
   
    </form>
</div>