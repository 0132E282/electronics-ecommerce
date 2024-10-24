<select class=" select2 border form-control  ">
    <option value="">Cọn danh mục cha</option>
    {!! $renderOptionsHtml !!}
</select>
@pushOnce('body-js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endPushOnce
