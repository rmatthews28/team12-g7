/**
 * Created by CameronCampbell on 13/01/2017.
 */
$(document).ready(function(){


    $(function() {
        activeProduct();
    });



    function activeProduct() {

        $('.collection_title').first().addClass('active');
        $('.collection_wrapper').first().attr('id', 'active');

        $('.collection_title').click(function(){
            var $this = $(this),
                $siblings = $this.parent().children(),
                position = $siblings.index($this);

            $('.collection_wrapper').removeAttr('id', 'active').eq(position).attr('id', 'active');
            $('.collection_title').removeClass('active').eq(position).addClass('active');
        });

    }

});
