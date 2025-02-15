<input type="{{$type}}" name="{{$name}}" value="{{old($name)}}" placeholder="{{$placeholder}}"
    {{$attributes->merge(['class'=>'form-control mb-2'])}}>
<x-validation-error field="{{$name}}"/>
