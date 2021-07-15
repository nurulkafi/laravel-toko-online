$(function () {
    //Hapus Kategori
    $('.hapusClick').on('click',function () {
        const id = $(this).data('id');
        $('.yesHapusClick').on('click',function () {
            $(this).attr('href',"categories/delete/"+id);
        });
    })
    //Hapus Produk
    $('.hapusClickP').on('click',function () {
        const id = $(this).data('id');
        $('.yesHapusClickP').on('click',function () {
            $(this).attr('href',"product/delete/"+id);
        });
    })
})
