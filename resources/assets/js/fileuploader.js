/**
 * Created by sasik on 3/10/16.
 */

var Sasik = {
    getToken : function () {
        return $('input[name=_token]').val();
    }
};

var FileUploader = {

    classname : '.fileuploader',

    /**
     * <div class="fileuploader" data-addition-path="news"></div>
     *
     * @returns {*|jQuery}
     */
    getAdditionPath : function() {
        return $(this.classname).data('addition-path');
    },

    /**
     * <div class="fileuploader" data-max-files="1"></div>
     *
     * @returns {*|jQuery}
     */
    getMaxFiles : function() {
        return $(this.classname).data('max-files');
    },

    getDownloadPath : function (context) {
        // take this, from Dropzone context, because with 2 dropzone instance doesn't work
        return $(context)[0].element.getAttribute('data-download-path');
    },

};

var fileuploadOptions = {
    url : '/api/files/upload',
    headers: {
        'X-CSRF-TOKEN': Sasik.getToken(),
        'AdditionPath': FileUploader.getAdditionPath()
    },
    addRemoveLinks : true,
    maxFiles: FileUploader.getMaxFiles(),
    autoDiscover: false,

    init : function () {
        this.on(
            'success', function (file, response) {
                console.log('download');
                console.log(file);
                console.log(response);

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'filename[]';
                input.value = response.name;

                file.previewTemplate.appendChild(input);
                FileUploader.numberFiles++;
            }
        );

        this.on('removedfile', function(file){
            _dropzone.options.maxFiles = _dropzone.options.maxFiles + 1;
        });

        var _dropzone = this;

        var downloadPath = FileUploader.getDownloadPath(_dropzone);
        if (downloadPath) {
            //$.get(downloadPath, {_token : Sasik.getToken()}).done(function (data) {

                //$.each(data, function (key, data) {
                    var splitedPath =downloadPath.split('/');

                    var mockFile = {
                        name : splitedPath[splitedPath.length - 1],
                        filesize : downloadPath,
                        path : downloadPath
                    };
                    _dropzone.emit('addedfile', mockFile);
                    _dropzone.createThumbnailFromUrl(mockFile, downloadPath);
                    _dropzone.emit('complete', mockFile);
                    _dropzone.emit('success', mockFile, mockFile);

                    _dropzone.options.maxFiles = _dropzone.options.maxFiles - 1;
                    //_dropzone.options.thumbnail.call(_dropzone, mockFile, value);
                //});
            //});
        }
    }

};


$('.fileuploader').dropzone(fileuploadOptions);

var image = document.getElementById('image');
var cropper = new Cropper(image, {
    aspectRatio: 16 / 9,
    crop: function(e) {
        console.log(e.detail.x);
        console.log(e.detail.y);
        console.log(e.detail.width);
        console.log(e.detail.height);
        console.log(e.detail.rotate);
        console.log(e.detail.scaleX);
        console.log(e.detail.scaleY);
    }
});
