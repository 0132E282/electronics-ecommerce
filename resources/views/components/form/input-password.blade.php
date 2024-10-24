@props(['name' => '', 'value' => '', 'id' => '', 'placeholder' => ''])
<div {{ $attributes->class(['input-group']) }}>
    <input type="password" class="form-control input-password" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
    <span class="input-group-text px-2 btn-psswowrd">
        <i class="icon-passowrd" data-feather="eye" style="width: 20px; height: 20px;"></i>
    </span>
</div>

@pushOnce('body-js')
    <script type="module">
        $(".input-group").on('click', function(e) {
            if (e.target.closest(".btn-psswowrd")) {
                const input = $(this).find('input.input-password');
                input.attr('type', (input.attr('type') === 'password' ? 'text' : 'password'));
                $(this).find('.btn-psswowrd').html(input.attr('type') === 'password' ?
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-passowrd" style="width: 20px; height: 20px;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' :
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off icon-passowrd" style="width: 20px; height: 20px;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>'
                )
            }
        });
    </script>
@endpushOnce
