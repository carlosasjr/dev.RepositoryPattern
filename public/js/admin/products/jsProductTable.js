/*==================== PAGINATION =========================*/
$(window).on('hashchange',function(){
    page = window.location.hash.replace('#','');
    getProducts(page);
});

$(document).on('click','.pagination a', function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    location.hash = page;
});


$(document).on('click','#btnSearch', function(e){
    e.preventDefault();

    var dataForm = {
        id:  $('#id').val(),
        category_id: $("#category_id option:selected").val(),
        name: $('#name').val(),
        url: $('#url').val(),
        description: $('#description').val()
    };


    $.ajax({
        url: '/admin/products/search',
        data : dataForm

    }).done(function(data){
        $('#tabela').html(data);
        $('#search-true').css('display', 'block');
    });


});


function getProducts(page){
    var dataForm = {
        id:  $('#id').val(),
        category_id: $("#category_id option:selected").val(),
        name: $('#name').val(),
        url: $('#url').val(),
        description: $('#description').val()
    };

    $.ajax({
        url: '/admin/products?page=' + page,
        data : dataForm
    }).done(function(data){
        $('#tabela').html(data);
    });
}
