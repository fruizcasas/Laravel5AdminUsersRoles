@if (\App\Profile::loginProfile()->ckeditor=="TinyMCE")
    <script src="{{asset('/js/editor/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            schema: "html5",
            allowedContent:'div b strong i em a[href|title] ul ol li p[style] br span[style] img[width|height|alt|src]',
            language: '{{App::getLocale()}}',
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>

@elseif (\App\Profile::loginProfile()->ckeditor=="none")

@else
    <script src="{{asset('/js/editor/ckeditor/'.(\App\Profile::loginProfile()->ckeditor?:'basic').'/ckeditor.js')}}"></script>
    <script type="text/javascript">
        @foreach ($fields as $field)
        CKEDITOR.replace('{{$field}}',{
            language: '{{App::getLocale()}}',
            autoGrow_maxHeight: 600
        });
        @endforeach
    </script>
@endif