<textarea placeholder="{{$placeholder}}" name="{{$name}}" {{$attributes->merge(['class'=>'form-control'])}}>
    {!! isset($value) ? $value : old($name) !!}</textarea>
<x-validation-error field="{{$name}}"/>
