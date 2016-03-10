@if (isset($obj) && !empty($obj->image))
    <div class="fileuploader dropzone"  data-download-path="/files/{{ $obj->image }}" data-max-files="1"></div>
@else
    <div class="fileuploader dropzone" data-max-files="1"></div>
@endif
