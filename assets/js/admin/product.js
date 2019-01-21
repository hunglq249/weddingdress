switch(window.location.origin){
    case 'http://diamondtour.vn':
        var HOSTNAME = 'http://diamondtour.vn/';
        break;
    default:
        var HOSTNAME = 'http://localhost/weddingdress/';
}
document.querySelector('[name="image_shared"]').parentElement.querySelector('label').innerHTML = 'Ảnh đại diện cho sản phẩm';
if(document.querySelectorAll('[id="realDPX-min"]').length > 0){
    for (var m = 0; m < document.querySelectorAll('[id="realDPX-min"]').length; m++) {
        var $min = document.querySelectorAll('[id="realDPX-min"]')[m];
        $min.DatePickerX.init({
            mondayFirst: true,
            format: 'dd/mm/yyyy',
            minDate    : new Date(1900, 8, 13),
            maxDate    : new Date(9999, 8, 13),
        });
    }
}
{
    "use strict";
    tinymce.init({
        selector: ".tinymce-area",
        theme: "modern",
        block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3',
        height: 300,
        relative_urls: false,
        remove_script_host: false,
        // forced_root_block : false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: "Bold text", inline: "b"},
            {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
            {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
            {title: "Example 1", inline: "span", classes: "example1"},
            {title: "Example 2", inline: "span", classes: "example2"},
            {title: "Table styles"},
            {title: "Table row 1", selector: "tr", classes: "tablerow1"}
        ],
        external_filemanager_path: HOSTNAME + "filemanager/",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": HOSTNAME + "filemanager/plugin.min.js"}
    });
}
function to_slug(str,space="-"){
    str = str.toLowerCase();

    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');

    str = str.replace(/([^0-9a-z-\s])/g, '');

    str = str.replace(/(\s+)/g, space);

    str = str.replace(/^-+/g, '');

    str = str.replace(/-+$/g, '');

    // return
    return str;
}
function title_change(ev){
    document.querySelector('[name="slug_shared"]').value = to_slug(ev.value);
    if(ev.value.trim() != ''){
        document.querySelector('[name="slug_shared"]').closest('.required').querySelector('span.help-block').classList.add("hidden");
        document.querySelector('[name="slug_shared"]').closest('.required').classList.remove("has-error");
    }else{
        document.querySelector('[name="slug_shared"]').closest('.required').classList.add("has-error");
        document.querySelector('[name="slug_shared"]').closest('.required').querySelector('span.help-block').classList.remove("hidden");
    }
}
function check_validate_default(ev){
    let [html, count, id_parent] = ['', 0, ''];
    for (var i = 0; i < document.querySelectorAll('div.form-group.required').length; i++) {
        let type = document.querySelectorAll('div.form-group.required')[i].querySelector('label').getAttribute('for');
        if(type == 'radio' || type == 'checkbox'){
            if(document.querySelectorAll('div.form-group.required')[i].querySelectorAll('input:checked').length == 0){
                document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                document.querySelectorAll('div.form-group.required')[i].setAttribute('oninput',`check_validate(this,'${type}')`);
                document.querySelectorAll('div.form-group.required')[i].querySelector('span').classList.remove("hidden");
            }
        }else if(type == 'textarea'){
            if(document.querySelectorAll('div.form-group.required')[i].querySelector('textarea').value == ''){
                document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                document.querySelectorAll('div.form-group.required')[i].setAttribute('oninput',`check_validate(this,'${type}')`);
                document.querySelectorAll('div.form-group.required')[i].querySelector('span').classList.remove("hidden");
            }
        }else if(type == 'select'){
            if(document.querySelectorAll('div.form-group.required')[i].querySelector('select').value == ''){
                document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                document.querySelectorAll('div.form-group.required ')[i].querySelector('select').setAttribute('onchange',`check_validate(this,'${type}')`);
                document.querySelectorAll('div.form-group.required')[i].querySelector('span').classList.remove("hidden");
            }
        }else if(type == 'date'){
            if(document.querySelectorAll('div.form-group.required')[i].querySelector('input').value == ''){
                document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                document.querySelectorAll('div.form-group.required')[i].querySelector('input').setAttribute('onchange',`check_validate(this,'${type}')`);
                document.querySelectorAll('div.form-group.required')[i].querySelector('span.help-block').classList.remove("hidden");
            }
        }else if(type == 'text'){
            if(document.querySelectorAll('div.form-group.required')[i].querySelector('input').value == ''){
                document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                document.querySelectorAll('div.form-group.required')[i].setAttribute('oninput',`check_validate(this,'${type}')`);
                document.querySelectorAll('div.form-group.required')[i].querySelector('span.help-block').classList.remove("hidden");
            }
        }
    }
    //check title required if is require => focus
    if(document.querySelectorAll(`.form-horizontal .has-error`).length > 0){
        let [type, tag] = [document.querySelectorAll('div.form-group.has-error')[0].querySelector('label').getAttribute('for'), ''];
        if(type == 'radio' || type == 'checkbox' || type == 'date' || type == 'text'){
            tag = 'input';
        }else{
            tag = type;
        }
        id_tab = document.querySelectorAll('.form-horizontal .has-error')[0].closest('[class^="tab-pane"]').id;
        if(id_tab != 'home' && id_tab != 'add-product'){
            id_parent = document.querySelectorAll('.form-horizontal .has-error')[0].closest('[class^="tab-pane"]').id;
            document.querySelector(`.form-horizontal .nav.nav-justified li.active a`).setAttribute("aria-expanded","false");
            document.querySelector(`.form-horizontal .nav.nav-justified li.active`).classList.remove("active");
            document.querySelector(`.form-horizontal .tab-content.language .tab-pane.active`).setAttribute("class","tab-pane fade");
            document.querySelector(`.form-horizontal .has-error`).closest('[class^="tab-pane"]').setAttribute("class","tab-pane fade active in");
            document.querySelector(`.form-horizontal a[href="#${id_parent}"]`).setAttribute("aria-expanded","true");
            document.querySelector(`.form-horizontal a[href="#${id_parent}"]`).parentElement.classList.add("active");
            document.querySelectorAll(`.form-horizontal .has-error ${tag}`)[0].focus();
        }else{
            document.querySelectorAll(`.form-horizontal .has-error ${tag}`)[0].focus();
        }
        return false;
    }else{
        document.getElementById('home').setAttribute('class','tab-pane fade');
        document.getElementById('add-product').setAttribute('class','tab-pane fade');
        document.querySelector(`#${ev.getAttribute('aria-controls')}`).setAttribute('class','tab-pane fade in active');
        document.querySelectorAll('.nav-product')[0].setAttribute('style','display:block');
        document.querySelectorAll('.nav-product')[1].setAttribute('style','display:block');
        ev.closest('.nav-product').setAttribute('style','display:none');
    }
}
function submit_shared(ev){
    let data = new FormData(document.querySelector('form.form-horizontal'));
    data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
    for (var i = 0; i < document.querySelectorAll('textarea.tinymce-area').length; i++) {
        data.append(document.querySelectorAll('textarea.tinymce-area')[i].id, tinymce.get(document.querySelectorAll('textarea.tinymce-area')[i].id).getContent({format:'html'}));
    }
    data.append('showpromotion', document.querySelector('#showpromotion').checked ? 'true' : 'false');
    data.append('showpromotion_rent', document.querySelector('#showpromotion_rent').checked ? 'true' : 'false');
    data.append('sale', document.querySelector('[name="sale"]').checked ? 'true' : 'false');
    data.append('rent', document.querySelector('[name="rent"]').checked ? 'true' : 'false');
    data.append('rent_sale', document.querySelector('[name="rent_sale"]').checked ? 'true' : 'false');
    data.append('hot', document.querySelector('[name="hot"]').checked ? '1' : '0');
        
    var url = window.location.href;
    $.ajax({
        method: "post",
        url: url,
        data: data,
        contentType: false,
        processData: false,
        beforeSend: function(){
            document.getElementById('encypted_ppbtn_all').innerHTML = `<div class="modal" role="dialog" style="display: block; opacity: 0.5">
                <div class="modal-dialog" style="color:#fff; text-align:center; padding-top:300px;">
                    <i class="fa fa-2x fa-spinner fa-spin" aria-hidden="true"></i>
                </div>
            </div>`;
        },
        success: function(response){
            if(response.status == "200"){
                alert(response.message);
                if(window.location.pathname.indexOf("/product/edit/") != '-1'){
                    document.getElementById('csrf_sitecom_token').value = response.reponse.csrf_hash;
                }else{
                    window.location.href=HOSTNAME+"admin/product";
                }
            }else{
                alert(response.message);
                document.getElementById('csrf_sitecom_token').value = response.reponse.csrf_hash;
            }
            document.getElementById('encypted_ppbtn_all').innerHTML = '';
        },
        error: function(jqXHR, exception){
            document.getElementById('csrf_sitecom_token').value = jqXHR.responseJSON.reponse.csrf_hash;
            document.getElementById('encypted_ppbtn_all').innerHTML = '';
            alert(jqXHR.responseJSON.message);
        }
    });
    // fetch(url,{method: "POST",body: data}
    // ).then( response => {
    //     return response.json();
    // }).then(
    //     html => {
    //         if(html.status == "200"){
    //             alert(html.message);
    //             if(window.location.pathname.indexOf("/product/edit/") != '-1'){
    //                 document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
    //             }else{
    //                 window.location.href=HOSTNAME+"admin/product";
    //             }
    //         }else{
    //             alert(html.message);
    //             document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
    //         }
    //         document.getElementById('encypted_ppbtn_all').innerHTML = '';
    //     }

    // );

}
function check_validate(ev,type){
    if(type == 'text'){
        value = (ev.querySelector('input').value == '') ? true : false;
    }else if(type == 'radio' || type == 'checkbox'){
        value = (ev.querySelectorAll('input:checked').length == 0) ? true : false;
    }else if(type == 'date'){
        value = (ev.value == '') ? true : false;
    }else if(type == 'file'){
        value = (ev.querySelectorAll('input').files.length == 0 && ev.previousElementSibling.querySelector('.no_image') != null) ? true : false;
    }else if(type == 'select'){
        value = (ev.value == '') ? true : false;
    }else{
        value = (ev.querySelector(type).value != '') ? true : false;
    }
    if(value){
        ev.closest('.required').classList.add("has-error");
        ev.closest('.required').querySelector('span.help-block').classList.remove("hidden");
    }else{
        ev.closest('.required').querySelector('span.help-block').classList.add("hidden");
        ev.closest('.required').classList.remove("has-error");
    }
}

function isNumberKey(evt) {
   var charCode = (evt.which) ? evt.which : event.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57) || charCode == 190 || charCode == 196)
      return false;
   return true;
}
function check_sale(evt,ev) {
   var charCode = (evt.which) ? evt.which : event.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57) || charCode == 190 || charCode == 196){
      return false;
   }else{
        if(Number(ev.value.slice(0,ev.selectionStart)+evt.key+ev.value.slice(ev.selectionStart,ev.value.length)) > Number(ev.closest('[id^="demo"]').querySelector('.price_color').value) && ev.name=='promotion_color[]'){
            alert('Giá khuyễn mãi phải nhỏ hơn giá sản phẩm');
            return false;
        }
   }
   return true;
}
function check_sale(ev){
    if(ev.checked){
        document.querySelector('#sale').style.display = 'block';
    }else{
        document.querySelector('#sale').style.display = 'none';
        $('#sale input[type="checkbox"]').prop('checked',false);
        $('#sale input').val('');
    }
}
function check_rent(ev){
    if(ev.checked){
        document.querySelector('#rent').style.display = 'block';
    }else{
        document.querySelector('#rent').style.display = 'none';
        document.querySelector('#rent_sale').style.display = 'none';
        $('#rent input[type="checkbox"]').prop('checked',false);
        $('#rent input').val('');
        $('#datepicker').datepicker('setDate', null);
    }
}
function check_rent_sale(ev){
    if(ev.checked){
        document.querySelector('#rent_sale').style.display = 'block';
    }else{
        document.querySelector('#rent_sale').style.display = 'none';
        $('#rent_sale input[type="checkbox"]').prop('checked',false);
        $('#rent_sale input').val('');
    }
}
if(document.querySelector('#select_templates').value == '1'){
    $('.showdate').css('display','none');
    document.querySelector('[name="kich_thuoc_cho_san_pham"]').parentElement.style.display = 'none';
    document.querySelector('[name="kich_thuoc_cho_san_pham"]').value = '';
    $('#hot input[type="checkbox"]').prop('checked',false);
    document.querySelector('[name="hot"]').parentElement.style.display = 'none';
}else{
    $('.showdate').css('display','block');
}
if(window.location.pathname.indexOf("/product/create") != '-1'){
    if(document.querySelector('#select_templates').value == '1'){
        document.querySelector('[name="parent_id_shared"]').innerHTML = document.querySelector('#type_accessories').value;
    }else{
        document.querySelector('[name="parent_id_shared"]').innerHTML = document.querySelector('#type_dress').value;
    }
}else{
    document.querySelector(`[name="parent_id_shared"] option[value="${document.querySelector('#product_category_id_selected').value}"]`).setAttribute('selected','');
}
function check_type_product(ev){
    document.querySelector('#collection_id option').setAttribute('selected','');
    if(ev.value == '1'){
        $('.showdate').css('display','none')
        $('#datepicker').val('');
        $('#datepicker').datepicker('setDate', null);
        document.querySelector('[name="parent_id_shared"]').innerHTML = document.querySelector('#type_accessories').value;
        document.querySelector('[name="kich_thuoc_cho_san_pham"]').parentElement.style.display = 'none';
        document.querySelector('[name="kich_thuoc_cho_san_pham"]').value = '';
        $('#hot input[type="checkbox"]').prop('checked',false);
        document.querySelector('[name="hot"]').parentElement.style.display = 'none';
    }else{
        $('.showdate').css('display','block');
        document.querySelector('[name="parent_id_shared"]').innerHTML = document.querySelector('#type_dress').value;
        document.querySelector('[name="kich_thuoc_cho_san_pham"]').parentElement.style.display = 'block';
        document.querySelector('[name="hot"]').parentElement.style.display = 'block';
    }
}