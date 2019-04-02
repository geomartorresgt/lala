@extends('admin.layouts.app')

@section('content-editor')
	<iframe src="{{ url('editor') }}" style="width: 100%; height: 100vh" allowfullscreen="allowfullscreen">></iframe>
@endsection

@push('js')
	
@endpush