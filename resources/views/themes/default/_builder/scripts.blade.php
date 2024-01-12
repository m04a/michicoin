<script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
@if (app()->getLocale() !== 'en')
<script src="{{ asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js') }}"></script>
@endif
<script>
     $('.js-select2-icons').select2({
                theme: "bootstrap",
                templateResult: formatIcons
            });
    function formatIcons (state) {
        if (!state.id) { return state.text; }
        var $state = $('<span><i class="bi ' +  state.element.value.toLowerCase() + '"></i> ' + state.text.replace('{{$field['remove_class'] ?? ''}}','') +     '</span>');
        return $state;
    };
</script>