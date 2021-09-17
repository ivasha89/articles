$(document).ready(function(){
    function updateMenu(url) {
        urlSplit = url.split("/")
        
        if (urlSplit.length > 4) {
            urlSplit.splice(4,1)
        }
        url = urlSplit.join("/")
        
        const links = document.querySelectorAll('.nav-item');

        links.forEach(li => {
            let anchor = li.querySelector("a");
            if (url == anchor.href) {
                li.classList.add("active");
            } else {
                li.classList.remove("active");
            }
        });
    }

    updateMenu(window.location.href);
})

$(document).ready(function(){
    $('#comment_form').submit(function(e) {

        let postData = $(this).serializeArray();
        let formURL = $(this).attr("action");
        
        /* start ajax submission process */
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
                let card = $('#comment').clone()
                card.children('.card-header').append(data.subject)
                card.children('.card-body').append(data.body)
                let small = document.createElement('small')
                $(small).html(data.date).appendTo(card.children('.card-footer').addClass('text-right'))
                $('#comments').append(card.fadeIn())
                $('#theme').val('')
                $('#text').val('')
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $.each(jqXHR.responseJSON.errors, function(key,value) {
                    $('.comment .card-header').html('<div class="alert alert-danger">'+value+'</div');
                });
            }
        
        });
        
        e.preventDefault(); //STOP default action
        
        /* ends ajax submission process */
        
        });
})

$(document).ready(function(){
    $('.like').on('click', function() {

        let articleId = $('input[name="article_id"]').val()
        let token = $('input[name="_token"]').val()

        $.ajax({
            url: '/like',
            type: "POST",
            data: {
                like: 1,
                article_id: articleId,
                _token: token
            },
            success: function(data, textStatus, jqXHR) {
                $('.badge-light').html(data.likes)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error')
            }
        });
    })
})

$(document).ready(function(){
    
    let articleId = $('input[name="article_id"]').val()
    let token = $('input[name="_token"]').val()

    if (token != 'undefined') {
        setTimeout(() =>
            $.ajax({
            url: '/view',
            type: "POST",
            data: {
                view: 1,
                article_id: articleId,
                _token: token
            },
            success: function(data, textStatus, jqXHR) {
                $('.view').html('Views ' + data.views)
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        }), 5000);
    }
})