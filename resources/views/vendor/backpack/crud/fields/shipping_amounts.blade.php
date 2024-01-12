<?php 
    $amounts = $field['value'] ?? false;
    $zones = \Modules\Fnxshop\Models\Zone::all();
    $amount_weight = $entry->amount_weight ?? [];
?>
@include('crud::fields.inc.wrapper_start')
@if(isset($entry) && $entry->has_weight)
@foreach($zones as $zone)
<div class="checkbox">
    <input type="checkbox" {{isset($amounts[$zone->id]['active']) ? 'checked':'' }} name="{{ $field['name'] }}[{{$zone->id}}][active]">
    <label for="">{{__('shop.ships_to')}} {{$zone->name}} </label>
</div>
@if(isset($amounts[$zone->id]['active']))
<table class="table table-bordered table-stripped">
    <thead>
        <th>{{__('shop.max_weight')}}</th>

        <th>{{__('shop.cost')}}</th>
    </thead>
    <tbody>
    @foreach($amount_weight as $wp=>$aw)

    <tr>
        <td>
            {{$aw['max_weight']}}
        </td>
        <td>
            <input class="form-control text-right text-end" type="number"  name="{{ $field['name'] }}[{{$zone->id}}][amounts][{{$wp}}]" step="0.01" value="{{$amounts[$zone->id]['amounts'][$wp] ?? 0}}">
        </td>
    </tr>

    @endforeach
    </tbody>
</table>
@endif
<hr>

@endforeach

@else



<table class="table table-bordered table-stripped">
    <thead>
        <th> {{__('shop.zone')}}</th>
        <th>{{__('shop.ships_to')}}</th>
        <th>{{__('shop.cost')}}</th>
    </thead>
    <tbody>
    @foreach($zones as $zone)

    <tr>
        <td>{{$zone->name}}</td>
        <td>
            <div class="checkbox">
                <input type="checkbox" {{isset($amounts[$zone->id]['active']) ? 'checked':'' }} name="{{ $field['name'] }}[{{$zone->id}}][active]">
            </div>
        </td>
        <td>
            <input class="form-control text-right text-end" type="number"  name="{{ $field['name'] }}[{{$zone->id}}][amount]" step="0.01" value="{{$amounts[$zone->id]['amount'] ?? 0}}">
        </td>
    </tr>
    @endforeach

    </tbody>
</table>


@endif
{{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')
