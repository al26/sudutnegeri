$(document).ready(function() {
    toggleActiveMenuTab();
    toggleActiveContentTab();

    $('#example').DataTable(
        {
            "language": {
                "sProcessing":   "Sedang proses...",
                "sLengthMenu":   "Tampilan _MENU_ entri",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix":  "",
                "sSearch":       "Cari:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Awal",
                    "sPrevious": "Balik",
                    "sNext":     "Lanjut",
                    "sLast":     "Akhir"
                }
            },
            responsive : true,
            autoWidth : true,
            lengthChange : true,
            stateSave : true,
            fixedHeader : true
        }
    );
    
    // $(document).loadModal();
    $(document).ajaxPagination();
    // $(document).activateCKEditor();
    $('.the-summernote').summernote({
        height:150
    });
    activateOptGenerator();
    $('.select2').select2({theme: "bootstrap4"});
    $(document).ajaxSelect2("project_location", "/location");
    // showMoreLess(100, 'Selengkapnya', 'Sebagian', '.update-list-item');
});

$(document).on('click', '#password-create', function(e){
    e.preventDefault();
    $('#form-account').ajaxCrudNonModal(['#mr']);
});

$(document).on('click', '#password-change', function(e){
    e.preventDefault();
    $('#form-account-change').ajaxCrudNonModal(['#mr']);
});

$(document).on('click', '#profile-edit', function(e){
    e.preventDefault();
    $('#form-profile').ajaxCrudNonModal(['#mr', '#mt']);
});

$(document).on('click', '#upload-receipt', function(e){
    e.preventDefault();
    $('#form-receipt').ajaxCrudNonModal(['#mr']);
});

$(document).on('click', '#upload-verification', function(e){
    e.preventDefault();
    $('#form-verification').ajaxCrudNonModal(['#mr']);
});

// $(document).on('click', '#activity-create-history', function(e) {
//     e.preventDefault();
//     var redirectTo = $(this).attr('data-redirectAfter');
//     $('#form-activity-create-history').ajaxCrudNonModal(['#mr'], redirectTo);
// });

// $(document).on('click', '#activity-update-history', function(e) {
//     e.preventDefault();
//     var redirectTo = $(this).attr('data-redirectAfter');
//     $('#form-activity-update-history').ajaxCrudNonModal(['#mr'], redirectTo);
// });

$(document).on('click', '#create-history', function(e) {
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-create-history').ajaxCrudNonModal(['#mr'], redirectTo);
});

$(document).on('click', '#update-history', function(e) {
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-update-history').ajaxCrudNonModal(['#mr'], redirectTo);
});

$(document).on('click', '#create-project', function(e){
    e.preventDefault();
    $('#form-create-project').ajaxCrudNonModal(['#mr'], "/dashboard/sudut/projects");
});

$(document).on('click', '#edit-project', function(e){
    e.preventDefault();
    $('#form-edit-project').ajaxCrudNonModal(['#mr'], "/dashboard/sudut/projects");
});

$(document).on('click', '#create-withdrawal', function(e) {
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-create-withdrawal').ajaxCrudNonModal(['#mr'], redirectTo);
});

var projecToCredit = $('#form-create-withdrawal').find('#project_id');
$(document).on('change', projecToCredit, function(e){
    // var project = encodeURIComponent(window.btoa(projecToCredit.val)),
    var url = projecToCredit.attr('data-saldo') +"?project="+ projecToCredit.val();
    console.log(url);
    $.get(url, function(data) {
        var	reverse = data.saldo.toString().split('').reverse().join(''),
            ribuan 	= reverse.match(/\d{1,3}/g);
            ribuan	= ribuan.join('.').split('').reverse().join('');
        var info = $('#form-create-withdrawal').find('#info-saldo');
        info.toggleClass('hidden');
        info.text('Saldo proyek '+data.name+' saat ini : Rp '+ribuan);
    });
});

$(document).pjax('a[data-pjax=menu]', '#mc');
$('#mc').on('pjax:complete', function() {
    toggleActiveMenuTab();
    toggleActiveContentTab();
});

$(document).pjax('a[data-pjax=main-content]', '#mr');
$('#mr').on('pjax:complete', function() {
    toggleActiveContentTab();
});

$('#mc, #mr').on('pjax:complete', function() {
    $('.select2').select2({theme: "bootstrap4",tags: true,});
    $('#example').DataTable();
    activateOptGenerator();
    $('.the-summernote').summernote({
        height:150
    });
    $(document).ajaxSelect2("project_location", "/location");
});

function toggleActiveMenuTab() {
    var path = document.location.pathname,
        menu = path.split("/");
    $('#h-menu a').each(function() {
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
    });
    $('#m-'+menu[2]).addClass('active');
}

function toggleActiveContentTab() {
    var path = document.location.pathname,
        menu = path.split("/");
    $('#'+menu[2]+'-menu a').not('#m-'+menu[2]+'-'+menu[3]).each(function() {
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
    });
    $('#m-'+menu[2]+'-'+menu[3]).addClass('active');

    $('#mh-menu a').each(function() {
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
    });
    $('#mobile-'+menu[2]+'-'+menu[3]).addClass('active');
}

function activateOptGenerator(){
    generateOption('#province_id', '#regency_id', 'regencies', 'Kabupaten/Kota');
    generateOption('#regency_id', '#district_id', 'districts', 'Kecamatan');
}