$( document ).ready(function(){

    $(function() {
        activeHistory();
    });


    function activeHistory() {
        $('.collection_title').first().addClass('active_btn');
        $('.collection_wrapper').first().addClass('active');

        $('.collection_title').click(function(){
            var $this = $(this),
                $siblings = $this.parent().children(),
                position = $siblings.index($this);

            $('.collection_wrapper').removeClass('active').eq(position).addClass('active');
            $('.collection_title').removeClass('active_btn').eq(position).addClass('active');
        });

    }



});

