@if(Session::has('success'))
    <div class="ui icon positive message">
        <i class="close icon"></i>
        <i class="checkmark icon"></i>
        <div class="content">
            <p>{{Session::get('success')}}</p>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div class="ui icon error positive message">
        <i class="close icon"></i>
        <i class="times icon"></i>
        <div class="content">
            <p>{{Session::get('error')}}</p>
        </div>
    </div>
@endif
