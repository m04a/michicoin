<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"  xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($urls[$defloc] as $url)
        <url>
          @if($url->model_class == 'App\Models\Page' && $url->model_id==$homepage_id)  
            <loc>{{ url('') }}</loc>     
            <xhtml:link rel="alternate" hreflang="{{$defloc}}" href="{{ url('') }}" />     
            @foreach($locales as $locale)     
            @if($locale!=$defloc)
            <xhtml:link rel="alternate" hreflang="{{$locale}}" href="{{ url($locale) }}" />     
            @endif
            @endforeach
            <changefreq>weekly</changefreq>
            <priority>1</priority>
          @else
          <loc>{{ $url->full_url }}</loc>
            <xhtml:link rel="alternate" hreflang="{{$defloc}}" href="{{ $url->full_url }}" />
            @foreach($locales as $locale)     
            @if($locale!=$defloc)
            <?php 
                $alternate = $urls[$locale]->where('model_id',$url->model_id)->where('model_class',$url->model_class)->first();
            ?>
            @if($alternate)
            <xhtml:link rel="alternate" hreflang="{{$locale}}" href="{{$alternate->full_url}}" />     
            @endif
            @endif
            @endforeach
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
          @endif
        </url>
    @endforeach
</urlset>