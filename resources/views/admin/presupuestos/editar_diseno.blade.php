@extends('admin.layouts.app')
@section('content-editor')
	<iframe src="{{ url('editor') }}" style='width: 100%; height: calc(100vh - 61px)' allowfullscreen="allowfullscreen">></iframe>
@endsection
