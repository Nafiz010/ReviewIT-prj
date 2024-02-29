$(document).ready(function(){

    $('#purchase').click(function(){

        $('#purchase_modal').modal('show');

    });

    $('#order').click(function(){
        
        var quantity = $('#quantity').val();
        
        var user_id = $('#usr_id').val();

        var item_id = $('#it_id').val();

        var coupon = $('#coupon').val();

        if(quantity == '')
        {
            alert("Please fulfil the form");
            return false;
        }
        else
        {
            $.ajax({
                url:"../inc/server.php",
                method:"POST",
                data:{item_p_id:item_id, quantity:quantity, user_id:user_id, coupon:coupon},
                success:function(data)
                {
                    $('#purchase_modal').modal('hide');
                    alert(data);
                }
            })
        }

    });

});



$(document).ready(function(){
    
    var rating_item_data = 0;

    $('#add_item_review').click(function(){

        $('#review_item_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_item_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_item_data = $(this).data('rating');

    });

    $('#save_item_review').click(function(){

        var order_id = $('#order_id').val();
        
        var user_id = $('#usr_id').val();

        var item_id = $('#it_id').val();

        var user_review = $('#user_review').val();

        if(user_name == '' || user_review == '' || order_id == '')
        {
            alert("Please fulfil the form");
            return false;
        }
        else
        {
            $.ajax({
                url:"../inc/server.php",
                method:"POST",
                data:{rating_item_data:rating_item_data, user_id:user_id, user_review:user_review, item_id:item_id, order_id:order_id},
                success:function(data)
                {
                    $('#review_item_modal').modal('hide');

                    load_rating_item_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_item_data();

    function load_rating_item_data()
    {
        var urlParams = new URLSearchParams(window.location.search);
        var item_Id = urlParams.get('id');
        $.ajax({
            url:"../inc/server.php",
            method:"POST",
            data:{reaction: 'load_data', item_id: item_Id},
            dataType:"JSON",
            success:function(data)
            {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';

                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                        html += '<div class="card-body">';

                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';
                        
                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }
})