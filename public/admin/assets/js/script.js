$(function () {
    $('.hapusClick').on('click',function () {
        const id = $(this).data('id');
        $('.yesHapusClick').on('click',function () {
            console.log('ok');
            $(this).attr('href',"categories/delete/"+id);
        });
    })
})
