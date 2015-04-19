@if (\App\Profile::loginProfile()->ckeditor=="TinyMCE")
    <script src="//cdn.ckeditor.com/4.4.7/{{\App\Profile::loginProfile()->ckeditor?:'standard'}}/ckeditor.js"></script>
    <script type="text/javascript">
        @foreach ($fields as $field)
            CKEDITOR.replace('{{$field}}',{
                language: '{{App::getLocale()}}',
                autoGrow_maxHeight: 600
            });
        @endforeach
    </script>
@else
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
@endif