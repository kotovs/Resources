if (typeof $.monstra == 'undefined') $.monstra = {};

$.monstra.resources = {

    init: function() {
        this.showImage();
    },

    showImage: function() {
        $('.image').find('a').on('click', function() {
            $('#resurcesPreview').lightbox('show').find('img').attr('src', $(this).attr('rel'));
            console.log($(this).attr('rel'));
        });
    }
};

$(document).ready(function(){
    $.monstra.resources.init();
});