<?php 
    $curr_page = App\Models\Page::find($entry->{$column['name']});
?>
@if($curr_page)
<span>{{$curr_page->title}}</span>
@else
<i>-</i>
@endif
