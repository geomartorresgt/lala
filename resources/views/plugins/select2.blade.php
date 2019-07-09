@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2/select2-bootstrap4.min.css')}}">
<style>
    .select2-container .select2-selection--single{
        height: 34px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height: 32px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        top:3px;
    }
</style>
@endpush

@push('js')
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script>
    $(function () {
        $('select').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                placeholder: $(this).attr('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
    });
</script>
@endpush