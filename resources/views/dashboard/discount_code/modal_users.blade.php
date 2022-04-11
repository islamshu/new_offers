<table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7" id="kt_datatable">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>{{ __('name') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('phone') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($promo as $item)
            <tr>
                <td>{{ @$item->client->name }}</td>
                <td>{{ @$item->client->email }}</td>
                <td>{{ @$item->client->phone }}</td>


            </tr>
        @endforeach

    </tbody>
</table>
