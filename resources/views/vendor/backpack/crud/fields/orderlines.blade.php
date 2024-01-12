<?php 
    $lines = $field['value'] ?? [];
?>
<div class="col-12">
    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>
                    {{__('shop.item')}}
                </th>
         
                <th>
                    {{__('shop.quantity')}}
                </th>
                <th>
                    {{__('shop.unit_price')}}
                </th>
                <th>
                    {{__('shop.taxes')}}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($lines as $line)
                <tr>
                    <td>
                        <input type="text"  name="name[{{$line->id}}]" value="{{$line->name}}" class="form-control">                        

                    </td>
                    <td>
                        <input type="number" step="1" min="0"  name="quantity[{{$line->id}}]" value="{{$line->quantity}}" class="form-control">                        
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0"  name="unit_price[{{$line->id}}]" value="{{$line->unit_price}}" class="form-control">                        
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0"  name="unit_taxes[{{$line->id}}]" value="{{$line->taxes}}" class="form-control">                        
                    </td>
                </tr>
            @endforeach
            <tr>
                    <td>
                        <input type="text" placeholder="{{__('shop.new_line_name')}}" name="new_name" class="form-control">                        
                    </td>
                    <td>
                        <input type="number" step="1" min="1"  name="new_quantity" class="form-control">                        
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0"  name="new_unit_price" class="form-control">                        
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0"  name="new_unit_taxes"  class="form-control">                        
                    </td>
                </tr>
        </tbody>
    </table>
</div>
