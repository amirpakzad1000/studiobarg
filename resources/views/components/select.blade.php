<select name="{{$name}}" {{$attributes->merge(['class'=>'form-control custom-select2 pb-3'])}}>
    {{$slot}}
</select>
<x-validation-error field="{{$name}}"/>

