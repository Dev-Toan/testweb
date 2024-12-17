@if (isset($attributes))
    @foreach ($attributes as $key => $value)
        <div class="form-group col-sm-3">
            <h4 style="border-bottom: 1px solid #dedede;padding-bottom:10px">{{ $key }}</h4>
            @foreach ($value as $item)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="attribute[]" value="{{ $item['id'] }}" {{ in_array($item['id'],$attributeOld) ? 'checked' : '' }}> {{ $item['atb_name'] }}
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
@endif