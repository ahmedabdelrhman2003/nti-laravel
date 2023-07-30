@if (session()->has('success'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success ">{{ session()->get('success') }}</div>
        </div>
    </div>
@elseif (session()->has('faild'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger ">erorr</div>
        </div>
    </div>
@endif
