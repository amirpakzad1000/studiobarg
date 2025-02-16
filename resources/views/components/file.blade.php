<div class="custom-file mb-2">
    <input type="file" name="{{$name}}" {{$attributes->merge(['class'=>'custom-file-input'])}}>
    <label class="custom-file-label">{{ $placeholder }}</label>
</div>
<!-- نمایش تصویر قبلی در صورت وجود -->
@if ($value)
    <div class="mb-2 mt-2">
        <img class="img-thumbnail" src="{{ $value }}" alt="Current Image" width="100">
    </div>
@else
    هیچ عکسی انتخاب نشده
@endif
<x-validation-error field="{{$name}}"/>
