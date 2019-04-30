@extends('admin.layouts.app')

@section('content-editor')
	<iframe src="{{ route('editor.iframe') }}" id="iframe_editor" style='width: 100%; height: calc(100vh - 61px)' allowfullscreen="allowfullscreen">></iframe>
@endsection

@push('js')
	{{-- <script>
		$(document).ready(function(){

			setTimeout(() => {
				var iframe = document.getElementById('iframe_editor');
				var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
				console.log('prueba');
				console.log(iframe);
				console.log(innerDoc);
				console.log(innerDoc.body);
			}, 3000);
		
		});
	</script> --}}
	
@endpush