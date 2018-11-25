/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 66);
/******/ })
/************************************************************************/
/******/ ({

/***/ 66:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(67);


/***/ }),

/***/ 67:
/***/ (function(module, exports) {

$(document).ready(function () {
    toggleActiveMenuTab();
    toggleActiveContentTab();

    callOnScroll();

    $(window).on('resize', function () {
        $('#h-menu-tab').width($('#mt').innerWidth());
    });

    $('#example').DataTable({
        "language": {
            "sProcessing": "Sedang proses...",
            "sLengthMenu": "Tampilan _MENU_ entri",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "sInfo": "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Tampilan 0 hingga 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sSearch": "Cari:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Awal",
                "sPrevious": "Balik",
                "sNext": "Lanjut",
                "sLast": "Akhir"
            }
        },
        responsive: true,
        autoWidth: true,
        lengthChange: true,
        stateSave: true,
        fixedHeader: true
    });

    // $(document).loadModal();
    $(document).ajaxPagination();
    // $(document).activateCKEditor();
    $('.the-summernote').summernote({
        height: 150,
        callbacks: {
            onChange: function onChange(contents, $editable) {
                var imgs = $('.note-editable').find("img");
                $.each(imgs, function (index, img) {
                    $(img).addClass("img-fluid");
                });
            }
        }
    });
    $('.the-summernote-text').summernote({
        toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']]],
        height: 150
    });
    activateOptGenerator();
    $('.select2').select2({ theme: "bootstrap4" });
    $(document).ajaxSelect2("form-create-project #regency_id", "/location");
    // showMoreLess(100, 'Selengkapnya', 'Sebagian', '.update-list-item');
});

$(document).on('click', '#password-create', function (e) {
    e.preventDefault();
    $('#form-account').ajaxCrudNonModal(['#mr']);
});

$(document).on('click', '#password-change', function (e) {
    e.preventDefault();
    $('#form-account-change').ajaxCrudNonModal(['#mr']);
});

$(document).on('click', '#profile-edit', function (e) {
    e.preventDefault();
    $('#form-profile').ajaxCrudNonModal(['#mr', '#mt'], '/dashboard/setting/profile');
});

$(document).on('click', '#upload-receipt', function (e) {
    e.preventDefault();
    $('#form-receipt').ajaxCrudNonModal(['#mr'], '/dashboard/negeri/donations');
});

$(document).on('click', '#upload-verification', function (e) {
    e.preventDefault();
    $('#form-verification').ajaxCrudNonModal(['#mr'], '/dashboard/sudut/projects');
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

$(document).on('click', '#cv-edit', function (e) {
    e.preventDefault();
    $('#form-cv').ajaxCrudNonModal(['#mr']);
});

$(document).on('click', '#create-history', function (e) {
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-create-history').ajaxCrudNonModal(['#mr'], redirectTo);
});

$(document).on('click', '#update-history', function (e) {
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-update-history').ajaxCrudNonModal(['#mr'], redirectTo);
});

$(document).on('click', '#create-project', function (e) {
    e.preventDefault();
    $('#form-create-project').ajaxCrudNonModal(['#mr'], "/dashboard/sudut/projects");
});

$(document).on('click', '#edit-project', function (e) {
    e.preventDefault();
    $('#form-edit-project').ajaxCrudNonModal(['#mr'], "/dashboard/sudut/projects");
});

$(document).on('click', '#create-withdrawal', function (e) {
    e.preventDefault();
    var redirectTo = $(this).attr('data-redirectAfter');
    $('#form-create-withdrawal').ajaxCrudNonModal(['#mr'], redirectTo);
});

projecToCredit = $('#form-create-withdrawal').find('#project_id');
projecToCredit.on('change', function (e) {
    // var project = encodeURIComponent(window.btoa(projecToCredit.val)),
    var url = projecToCredit.attr('data-saldo') + "?project=" + projecToCredit.val();
    $.get(url, function (data) {
        var reverse = data.saldo.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        var info = $('#form-create-withdrawal').find('#info-saldo');

        if (info.hasClass('hidden')) {
            info.removeClass('hidden');
        }
        info.text('Saldo proyek ' + data.name + ' saat ini : Rp ' + ribuan);
    });
});

$(document).pjax('a[data-pjax=menu]', '#mc');
$('#mc').on('pjax:complete', function () {
    toggleActiveMenuTab();
    toggleActiveContentTab();
});

$(document).pjax('a[data-pjax=main-content]', '#mr');
$('#mr').on('pjax:complete', function () {
    toggleActiveContentTab();
});

$('#mc, #mr').on('pjax:complete', function () {
    $('.select2').select2({ theme: "bootstrap4", tags: true });
    $('#example').DataTable();
    activateOptGenerator();
    $('.the-summernote').summernote({
        height: 150,
        callbacks: {
            onChange: function onChange(contents, $editable) {
                var imgs = $('.note-editable').find("img");
                $.each(imgs, function (index, img) {
                    $(img).addClass("img-fluid");
                });
            }
        }
    });
    $('.the-summernote-text').summernote({
        toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']]],
        height: 150
    });
    // $(document).ajaxSelect2("project_location", "/location");
    $(document).ajaxSelect2("regency_id", "/location");
    projecToCredit = $('#form-create-withdrawal').find('#project_id');
});

function toggleActiveMenuTab() {
    var path = document.location.pathname,
        menu = path.split("/");
    $('#h-menu a').each(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
    });
    $('#m-' + menu[2]).addClass('active');
}

function toggleActiveContentTab() {
    var path = document.location.pathname,
        menu = path.split("/");
    $('#' + menu[2] + '-menu a').not('#m-' + menu[2] + '-' + menu[3]).each(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
    });
    $('#m-' + menu[2] + '-' + menu[3]).addClass('active');

    $('#mh-menu a').each(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
    });
    $('#mobile-' + menu[2] + '-' + menu[3]).addClass('active');
}

function activateOptGenerator() {
    generateOption('#province_id', '#regency_id', 'regencies', 'Kabupaten/Kota');
    generateOption('#regency_id', '#district_id', 'districts', 'Kecamatan');
}

function callOnScroll() {
    $(window).scroll(function () {
        if (window.innerWidth >= 768 && window.innerWidth < window.innerHeight || window.innerWidth >= 992 && window.innerWidth > window.innerHeight) {
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
    });
}

/***/ })

/******/ });