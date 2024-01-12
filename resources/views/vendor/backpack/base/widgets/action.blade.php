@php
	// preserve backwards compatibility with Widgets in Backpack 4.0
	$widget['wrapper']['class'] = $widget['wrapper']['class'] ?? $widget['wrapperClass'] ?? 'col-sm-6 col-md-4';
@endphp

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
	<div class="{{ $widget['class'] ?? 'card' }}">
			@if (isset($widget['header']))
				<div class="card-header">{!! $widget['header'] !!}</div>
			@endif
			<div class="card-body">
            
            <p>{!! $widget['content'] ?? '' !!}</p>
            
            @if (isset($widget['button_link']))
            <p class="lead">
                <a class="btn btn-primary" href="{{ $widget['button_link'] }}" role="button">{{ $widget['button_text'] }}</a>
            </p>
            @endif
            </div>
	</div>
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')