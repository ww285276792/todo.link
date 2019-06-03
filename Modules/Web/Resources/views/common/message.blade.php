@if(Session::has('success'))
    <div class="ui mini icon positive message">
        <i class="close icon"></i>
        <i class="checkmark icon"></i>
        <div class="content">
            <p>{{Session::get('success')}}</p>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(show, 5000);
        function show() {
            $('.message .close').click();
        }
    </script>
@endif

@if(Session::has('error'))
    <div class="ui mini icon error positive message">
        <i class="close icon"></i>
        <i class="times icon"></i>
        <div class="content">
            <p>{{Session::get('error')}}</p>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(show, 5000);
        function show() {
            $('.message .close').click();
        }
    </script>
@endif
