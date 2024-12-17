@foreach ($typeproducts as $item)
    <option value="{{ $item->id }}" >{{ $item->tp_name }}</option>
@endforeach