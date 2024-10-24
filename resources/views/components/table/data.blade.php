@props(['rowHead' => [], 'paginator' => null])
<x-table class="data-table mb-0">
    <x-slot:head>
        <tr>
            <th scope="col">
                <input type="checkbox" class="form-check-input checkbox-table-head">
            </th>
            @foreach ($rowHead as $key => $row)
                <th scope="col">
                    @if (!empty($row['sort']))
                        <a class="text-black" href="{{ Route(Route::currentRouteName(), array_merge(request()->route()->parameters(), request()->all(), ['sort' => $row['sort'], 'direction' => request()->direction === 'asc' ? 'desc' : 'asc'])) }}">
                            {{ $row['name'] }}
                            @if (request()->direction === 'desc' && request()->sort == $row['sort'])
                                <i data-feather="arrow-up" class="noti-icon ms-1" style="width: 16px; height: 16px;"></i>
                            @else
                                <i data-feather="arrow-down" class="noti-icon ms-1" style="width: 16px; height: 16px;"></i>
                            @endif
                        </a>
                    @else
                        {{ $row['name'] }}
                    @endif
                </th>
            @endforeach
            <th scope="col"> </th>
        </tr>
    </x-slot:head>
    <x-slot:body>
        {{ $slot }}
    </x-slot:body>
</x-table>

@pushOnce('body-js')
    <script type="module">
        $(document).ready(function() {
            const dataTable = $('table.data-table');
            dataTable.find('input[type="checkbox"].checkbox-table-head').on('click', function() {
                const checked = $(this).prop('checked');
                console.log(dataTable.find('input[type="checkbox"]:not([class="checkbox-table-head"])'))
                dataTable.find('input[type="checkbox"].checkbox-table-body').each(function(item) {
                    $(this).attr('checked', checked);
                })
            })
        });
    </script>
@endpushOnce
