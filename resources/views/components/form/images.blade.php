@props(['buttonName' => 'Attach File'])

<div {{ $attributes->class(['input-image']) }} style="cursor: pointer;">
    <input type="file" class="d-none" accept="image/*">
    <div class="mb-2 render-images">
        {{ $slot }}
    </div>
    @if ($buttonName)
        <button type="button" class="btn btn-primary btn-md w-100"> {{ $buttonName }}</button>
    @endif

</div>
@pushOnce('body-js')
    <script type="module">
        $(".input-image").click(function(e) {
            e.currentTarget.querySelector('input[type="file"]').click();
        });
        $(document).ready(function() {
            $(".input-image input[type='file']").change(function(e) {
                const reader = new FileReader();
                const input = this;
                const renderImage = $(this).siblings('.render-images');
                reader.onload = function(e) {
                    if (input.getAttribute('multiple') === true) {
                        renderImage.addClass('row col-4');
                        renderImage.html(`<img class="rounded float-start" src="${reader.result}"/>`);
                    } else {
                        renderImage.html(`<img class="img-thumbnail img-fluid" src="${reader.result}"/>`);
                    }
                };
                Array.from(input.files).forEach(function(file) {
                    reader.readAsDataURL(file);
                })
            });
        });
    </script>
@endpushOnce
