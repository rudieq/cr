@extends('layouts.app')

@section('content')
	<div class="container">
		@if(count($data) > 0)
			<table class="table table-striped border">
			  <thead>
			    <tr>
			      <th scope="col">{{__('Id')}}</th>
			      <th scope="col">{{__('Name')}}</th>
			      <th scope="col" colspan="2">{{__('Comment')}}</th>
			    </tr>
			  </thead>
			  <tbody>
					@foreach($data as $item)
					    <tr @if($item->edit) class= "text-primary" @endif>
					      <th scope="row">{{$item->id}}</th>
					      <td>{{$item->name}}</td>
					      <td>{{$item->comment}}</td>
					      <td><a class="btn btn-outline-secondary btn-sm" href="{{route($editRoute, $item->id)}}" role="button">Edit</a></td>
					    </tr>
					@endforeach
			  </tbody>
			</table>
			{{$data->appends(request()->input())->links()}}
		@else
			<p>{{__('No data')}}</p>
		@endif
	</div>
@endsection
