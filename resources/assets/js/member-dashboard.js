$(document).ready(function() {
    toggleActiveMenuTab();
    toggleActiveContentTab();

    callOnScroll();

    $(window).on('resize', function(){
        $('#h-menu-tab').width($('#mt').innerWidth());
    });
    
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
        height:150,
        callbacks: {
            onChange: function(contents, $editable) {
                var imgs = $('.note-editable').find("img");
                $.each(imgs, function(index, img){
                    $(img).addClass("img-fluid");
                })
            }
        }
    });
    $('.the-summernote-text').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        height: 150
    });
    activateOptGenerator();
    $('.select2').select2({theme: "bootstrap4"});
    $(document).ajaxSelect2("form-create-project #regency_id", "/location");
    // showMoreLess(100, 'Selengkapnya', 'Sebagian', '.update-list-item');
    getProjectBalance();
});

$(document).on('click', '#password-create', function(e){
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-account').ajaxCrudNonModal(['#mr'], redirectTo);
});

$(document).on('click', '#password-change', function(e){
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-account-change').ajaxCrudNonModal(['#mr'], redirectTo);
});

$(document).on('click', '#profile-edit', function(e){
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-profile').ajaxCrudNonModal(['#mr', '#mt'], redirectTo);
});

$(document).on('click', '#upload-receipt', function(e){
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-receipt').ajaxCrudNonModal(['#mr'], redirectTo);
});

$(document).on('click', '#upload-verification', function(e){
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    // var referrer = $(this).attr('data-referrer');
    // var go;
    // if(referrer!=null) {
    //     go = referrer;
    // } else {
    //     go = redirectTo;
    // }
    $('#form-verification').ajaxCrudNonModal(['#mr', '#mt'], redirectTo);
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

$(document).on('click', '#cv-edit', function(e){
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-cv').ajaxCrudNonModal(['#mr','#ml'], redirectTo);
});

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
    $('.select2').select2({theme: "bootstrap4"});
    $('#example').DataTable();
    activateOptGenerator();
    $('.the-summernote').summernote({
        height:150,
        callbacks: {
            onChange: function(contents, $editable) {
                var imgs = $('.note-editable').find("img");
                $.each(imgs, function(index, img){
                    $(img).addClass("img-fluid");
                })
            }
        }
    });
    $('.the-summernote-text').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        height: 150
    });
    // $(document).ajaxSelect2("project_location", "/location");
    activateOptGenerator()
    $(document).ajaxSelect2("form-create-project #regency_id", "/location");
    getProjectBalance();
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

function callOnScroll() {
    $(window).scroll(function(){
        if((window.innerWidth >= 768 && window.innerWidth < window.innerHeight) || (window.innerWidth >= 992 && window.innerWidth > window.innerHeight) ) {
            var tab_offset = $('.tcc').offset().top,
                tab = $('#h-menu-tab'),
                tab_width = tab.innerWidth();

            if ($(this).scrollTop() >= tab_offset) {
                tab.addClass('fixed');
                tab.width(tab_width);
                $('#mc').css('padding-top', '4rem');
            } else {
                tab.removeClass('fixed');
                $('#mc').css('padding-top', '0');
            }
        }
    })
}

function getProjectBalance() {
    projecToCredit = $('#form-create-withdrawal').find('#project_id');
    projecToCredit.on('change', function(e) {
        // var project = encodeURIComponent(window.btoa(projecToCredit.val)),
        var url = projecToCredit.attr('data-saldo') +"?project="+ projecToCredit.val();
        console.log(url);
        $.get(url, function(data) {
            var	reverse = data.saldo.toString().split('').reverse().join(''),
                ribuan 	= reverse.match(/\d{1,3}/g);
                ribuan	= ribuan.join('.').split('').reverse().join('');
            var info = $('#form-create-withdrawal').find('#info-saldo');
            
            if(info.hasClass('hidden')) {
                info.removeClass('hidden');
            }
            info.text('Saldo proyek '+data.name+' saat ini : Rp '+ribuan);
            console.log(info.text());
        });
    });
}