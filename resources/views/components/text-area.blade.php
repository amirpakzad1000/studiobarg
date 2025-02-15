<textarea placeholder="{{$placeholder}}" name="{{$name}}" id="" {{$attributes->merge(['class'=>'form-control'])}}
         >{!! old($name) !!}</textarea>
<x-validation-error field="{{$name}}"/>
