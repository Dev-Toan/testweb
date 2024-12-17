<div id="slide">
    @foreach ($slides as $item)
        <div class="wImage">
            <a href="#" title="Sale" target="_blank" class="image cover">
            <img src="{{ asset('frontend/images/lazy1.jpg') }}" data-src="{{ pare_url_file($item->sd_image) }}" class="lazy" alt="{{ $item->sd_name }}" />
            </a>
        </div>
    @endforeach
    </div>
