@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('inc.messages')

            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ $url }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-4 text-md-right">
                                {{__('Id')}}
                            </div>

                            <div class="col-md-4">
                                {{$data->id}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-md-right">
                                {{__('Name')}}
                            </div>

                            <div class="col-md-4">
                                {{$data->name}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" type="text" class="form-control  @if(isset($comment)) is-invalid @endif" name="comment">{{isset($comment) ? $comment : $data->comment}}</textarea>
                                    @if(isset($comment))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                <p>{{__('Comment was changed. Do you want to overwrite comment:')}}</p>
                                                <p>{{ $data->comment }}</p>
                                            </strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <input type="hidden" id="_method" name="_method" value="PUT">

                        <input type="hidden" id="updated_at" name="updated_at" value="{{$data->updated_at}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn @if(isset($comment)) btn-danger @else btn-primary @endif">
                                    {{isset($comment) ? __('Overwrite') : __('Edit')}}
                                </button>
                                <a href="?cancel=1" class="btn btn-outline-secondary">{{__('Cancel')}}</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onunload = function(){
        // location.assign('?cancel=1');
        // return "cancel edit";
    }
</script>
@endsection
