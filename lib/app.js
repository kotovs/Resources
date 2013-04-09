jQuery.noConflict();
(function($) {
  $(function() {

   // map the classes for each item into a new array
    classes = $("#list li").map(function(){
        return $(this).attr("rel").split(' ');
    });

    // create list of distinct items only
    var classList = distinctList(classes);



    var wv=document.body.parentNode.clientWidth;
    if(wv < 800){

        // generate the list of filter links
        var tagList = '<select class="tags" id="tag-list"></select>';
        tagItem = '<option value="all" selected="selected" >All</option >';

        // loop through the list of classes & add link
        $.each(classList, function(index,value){
            var valu = value.replace("-", " ");
            tagItem += '<option value="'+valu+'">'+valu+'</option >';
        });
        // add the filter links before the list of items
        $("#list").before($(tagList).append(tagItem));

    }

    $("#tag-list").change(function() {

        $(this).val();

        // allows filter categories using multiple words
        var getText = $(this).val().replace(" ", "-");
        if(getText == 'All'){
            $("#list li").fadeIn(800);
        } else{
            $("#list li").fadeOut(800);
            $("#list li").filter('[rel="' + getText + '"]').fadeIn(800);
        }
    });


    if(wv > 800){

        // generate the list of filter links
        var tagList = '<ul class="tags" id="tag-list"></ul>';
        tagItem = '<li><a href="#" class="active">All</a></li>';

        // loop through the list of classes & add link
        $.each(classList, function(index,value){
            var valu = value.replace("-", " ");
            tagItem += '<li><a href="#">'+valu+'</a></li>';
        });

        // add the filter links before the list of items
        $("#list").before($(tagList).append(tagItem));

    }

        // filter the demo list when the filter links are clicked
        $(document).on('click','#tag-list li a',function(e){

            // allows filter categories using multiple words
            var getText = $(this).text().replace(" ", "-");
            if(getText == 'All'){
                $("#list li").fadeIn(800);
            } else{
                $("#list li").fadeOut(1000);
                $("#list li").filter('[rel="' + getText + '"]').fadeIn(1000);
            }

            // add class "active" to current filter item
            $('#tag-list li a').removeClass('active');
            $(this).addClass('active');

            // prevent the page scrolling to the top of the screen
            e.preventDefault();
        });

    // Function to create a distinct list from array
    function distinctList(inputArray){
        var i;
        var length = inputArray.length;
        var outputArray = [];
        var temp = {};
        for (i = 0; i < length; i++) {
            temp[inputArray[i]] = 0;
        }
        for (i in temp) {
            outputArray.push(i);
        }
        return outputArray;
    }


    //On mouse over those thumbnail
    $('.item').hover(function() {
        //Display the caption
        $(this).find('div.caption').animate({left: 0},300);
    },
    function() {
        //Hide the caption
        $(this).find('div.caption').animate({left: 500},300);
    });

  });
})(jQuery);