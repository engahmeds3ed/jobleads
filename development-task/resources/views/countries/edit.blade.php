@extends('admin.adminbase')

@section('content')
<div dir="ltr" class="content">
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div>{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
        @endif
        <form method="POST" action="{{route('page.update', [$item->id])}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label>
            Page Name in Arabic
                <input type="text" name="name:ar" value="{{$item->name_ar}}"  class="ar">
            </label>
            <label>
            Page name in english
                <input type="text" name="name:en" value="{{$item->name_en}}" class="en">
            </label>
            <label>
            Page content in arabic
                <textarea name="content:ar"  class="ar">{{$item->content_ar}}</textarea>
            </label>
            <label>
                page conent in english
                <textarea name="content:en" class="en">{{$item->content_en}}</textarea>
            </label>
            <label>
            Page background
                <input type="file" name="image" class="en">
                <a href="{{route('page.image', $item->id)}}" target="_blank"  class="ar">preview</a>
            </label>
            <label>
        Active?
                <input type="checkbox" name="status" value="1" @if($item->status) checked @endif>
            </label>
            <input type="submit" class="btns arbtn w-button" value="Save">
        </form>
    </div>
@endsection