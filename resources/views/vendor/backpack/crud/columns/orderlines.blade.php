<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                {{__('shop.name')}}
            </th>
            <th>
                {{__('shop.quantity')}}
            </th>
            <th>
                {{__('shop.unit_price')}}
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach($entry->{$column['name']} as $line)
        <tr>
            <td>
                {{$line->name}}
            </td>
            <td>
                {{$line->quantity}}
            </td>
            <td>
                {{$line->unit_price}}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>