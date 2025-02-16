<input type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}"
    {{$attributes->merge(['class'=>'form-control mb-2'])}} value="{{old($name)}}">
<x-validation-error field="{{$name}}"/>
