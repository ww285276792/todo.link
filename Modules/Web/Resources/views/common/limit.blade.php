<div class="two wide column">
    <select id="limit" class="ui fluid dropdown">
        <option value="15" {{Request::get('limit')==15? "selected":""}}>15 条</option>
        <option value="25" {{Request::get('limit')==25? "selected":""}}>25 条</option>
        <option value="50" {{Request::get('limit')==50? "selected":""}}>50 条</option>
    </select>
</div>

<script>
    $("#limit").change(function () {
        var limit = $(this).val();
        window.location.href = '{{$url}}' + "?limit=" + limit;
    });
</script>
