<div class="custom-file mb-2">
    <input type="file" name="{{$name}}" {{$attributes->merge(['class'=>'custom-file-input'])}}>
    <label class="custom-file-label">{{ $placeholder }}</label>
</div>
<x-validation-error field="{{$name}}"/>
