switch(window.location.origin){
    case 'http://diamondtour.vn':
        var HOSTNAME = 'http://diamondtour.vn/';
        break;
    default:
        var HOSTNAME = 'http://localhost/weddingdress/';
}
switch(window.location.origin){
    case 'http://diamondtour.vn':
        var HOSTNAMEADMIN = 'http://diamondtour.vn/admin';
        break;
    default:
        var HOSTNAMEADMIN = 'http://localhost/weddingdress/admin';
}
if(window.location.pathname.indexOf("/config_contact/edit/") != '-1'){
    var after_slug = by_slug(document.querySelectorAll('#append_field [id^="demo"] [name="title_vi[]"]'));
    for (var i = 0; i < after_slug.length; i++) {
        document.querySelectorAll('[id^=field_] [name^="title"]')[i].setAttribute('slug',after_slug[i]);
    }
}else{
    var after_slug = [];
}
let [cursor, check, slug] = [0, 0, []];
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
};
let append_field = document.getElementById('append_field');

// thêm nhiều field
function addField(number){
    html = '';
    for(i = 0; i< number; i++){
        let [count_li , li, content] = [0, '', ''];
        JSON.parse(document.getElementById('page_languages').value, function (key, value){
            if(key.length > 0){
                li += `<li role="presentation" class="${(count_li == 0) ? 'active' : '' }">
                    <a href="#${key}${i+1}" aria-controls="${key}${i+1}" role="tab" data-toggle="tab">
                        <span class="badge">${count_li+1}</span> ${value}
                    </a>
                </li>`;
                content += `
                    <div role="tabpanel" class="tab-pane fade ${(count_li == 0) ? 'active in' : '' }" id="${key}${i+1}">
                        <div class="box box-default" style="border-top:none;">
                            <div class="box-body" style="padding:0px;">
                                <div class="col-xs-12 required" style="padding:0px;">
                                    <div class="form-group col-xs-12 required" style="margin-bottom:0px;">
                                        <label class="control-label" for="">Title</label>
                                        <input type="text" name="title_${key}[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control title">
                                        <span class="help-block hidden">Bạn cần nhập trường này</span>
                                    </div> 
                                    <div class="form-group col-xs-12" style="margin-bottom:0px;">
                                        <label class="control-label" for="inputError">Mô tả</label>
                                        <input type="text" name="description_${key}[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control description">
                                    </div>
                                </div>
                                <div class="col-xs-12 required_field" style="padding:0px;"></div> 
                                <div class="col-xs-12 show_textarea" style="padding:0px;"></div>
                            </div>
                        </div>
                    </div>
                `;
                count_li++;
            }
        });
        html += `<div class="form-group col-ms-12" style="padding: 0px;margin-bottom:5px;" id="field_${i+1}"  draggable="true" ondrop="drop(event)" ondragover="allowDrop(event)"> 
                    <div class="col-xs-12 drop-drag" draggable="true" ondragstart="drag(event)">
                        <div class="btn btn-primary col-ms-12" style="padding:0px; padding-top:5px; width:100%;text-align:left">
                            <span data-toggle="collapse" data-target="#demo${i+1}" class="col-xs-10 check-collapse" style="height:35px;padding-top:2px">
                                <span style="padding-left:10px;font-weight: 500;font-size: 1.2em;">${i+1}</span>
                            <b style="font-size: 1.18em;font-weight: 500;"></b> 
                            </span>
                            <i style="float: right;padding-right:5px;marrgin-top:-10px;" class="fa-2x fa fa-close remove" onclick="remove_field(${i+1})"></i>
                        </div>
                        <div id="demo${i+1}" class="collapse in form-group">
                            <div class="col-xs-12" style="padding:0px;">
                                <div class="col-xs-6" id="list${i+1}">
                                    <label for="">Kiểu Nhập</label>
                                    <select name="type[]"  class="form-control" onchange="select(this,'${i+1}')" id="type">
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="radio">Radio</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="password">Password</option>
                                        <option value="select">Select</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-xs-12 checkbox_field"></div>
                                <div class="col-xs-12">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="" class="required_check" onclick="check_required(this)"/><span>Bắt buộc chọn hoặc nhập thông tin</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12" id="data${i+1}">
                                <div class="col-ms-12" style="margin-top:10px;padding-top:5px;border-top:2px solid green;">
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        ${li}
                                    </ul>
                                    <div class="tab-content">
                                        ${content}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
        `;
    }
    document.getElementById('append_field').innerHTML = html;
}

// thêm 1 field
function addOneField(){
    let [html, count_li , li, content, number] = ['', 0, '', '', document.querySelectorAll('[id^="field"]').length];
    JSON.parse(document.getElementById('page_languages').value, function (key, value){
        if(key.length > 0){
            li += `<li role="presentation" class="${(count_li == 0) ? 'active' : '' }">
                <a href="#${key}${number+1}" aria-controls="${key}${number+1}" role="tab" data-toggle="tab">
                    <span class="badge">${count_li+1}</span> ${value}
                </a>
            </li>`;
            content += `
                <div role="tabpanel" class="tab-pane fade ${(count_li == 0) ? 'active in' : '' }" id="${key}${number+1}">
                    <div class="box box-default" style="border-top:none;">
                        <div class="box-body" style="padding:0px;">
                            <div class="form-group col-xs-12 required" style="margin-bottom:0px;">
                                <label class="control-label" for="">Tiêu đề</label>
                                <input type="text" name="title_${key}[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control title">
                                <span class="help-block hidden">Bạn cần nhập trường này</span>
                            </div> 
                            <div class="form-group col-xs-12" style="margin-bottom:0px;">
                                <label class="control-label" for="inputError">Mô tả</label>
                                <input type="text" name="description_${key}[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control description">
                            </div>
                            <div class="col-xs-12 required_field" style="padding:0px;"></div> 
                            <div class="col-xs-12 show_textarea" style="padding:0px;"></div>
                        </div>
                    </div>
                </div>
            `;
            count_li++;
        }
    })
    html += `<div class="form-group col-ms-12" style="padding: 0px;margin-bottom:5px;" id="field_${number+1}"  draggable="true" ondrop="drop(event)" ondragover="allowDrop(event)"> 
                <div class="col-xs-12 drop-drag" draggable="true" ondragstart="drag(event)">
                    <div class="btn btn-primary col-ms-12" style="padding:0px; padding-top:5px; width:100%;text-align:left;">
                        <span data-toggle="collapse" data-target="#demo${number+1}" class="col-xs-10 check-collapse" style="height:35px;padding-top:2px">
                            <span style="padding-left:10px;font-weight: 500;font-size: 1.2em;">${number+1}</span>
                            <b style="font-size: 1.18em;font-weight: 500;"></b> 
                        </span>
                        <i style="float: right;padding-right:5px;marrgin-top:-10px;" class="fa-2x fa fa-close remove" onclick="remove_field(${number+1})"></i>
                    </div>
                    <div id="demo${number+1}" class="collapse in form-group">
                        <div class="col-xs-12" style="padding:0px;">
                            <div class="col-xs-6" id="list${number+1}">
                                <label for="">Kiểu Nhập</label>
                                <select name="type[]"  class="form-control" onchange="select(this,'${number+1}')" id="type">
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="radio">Radio</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="password">Password</option>
                                    <option value="select">Select</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-12 checkbox_field"></div>
                            <div class="col-xs-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="" class="required_check" onclick="check_required(this)"/><span>Bắt buộc chọn hoặc nhập thông tin</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-12" id="data${number+1}">
                            <div class="col-ms-12" style="margin-top:10px;padding-top:5px;border-top:2px solid green;">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    ${li}
                                </ul>
                                <div class="tab-content">
                                    ${content}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
    `;
    document.getElementById('append_field').insertAdjacentHTML('beforeend', html);
    document.getElementById('number_field').value = number+1;
    if(typeof after_slug == 'object'){
        after_slug.push("undefined");
    }
    console.log(after_slug);
}
function select(value,id_data){
    let [append, choose] = ['', ''];
    if (document.querySelector(`#list${id_data} option[selected="selected"]`) != null) {
        document.querySelector(`#list${id_data} option[selected="selected"]`).removeAttribute('selected');
    }
    document.querySelector(`#field_${id_data} [value="${value.value}"]`).setAttribute('selected',`selected`);
    if(value.value == 'radio' || value.value == 'checkbox' || value.value == 'select'){
        if(value.value == 'select'){
            choose = `
                <div class="col-ms-12 check_multiple">
                    <div class="col-ms-12">
                        <label class="checkbox-inline"><input type="checkbox" onclick="check_multiple(this)">Được phép chọn nhiều</label>
                    </div>
                </div>
            `;
        }
        JSON.parse(document.getElementById('page_languages').value, function (key, values){
            if(key.length > 0){
                document.querySelector(`#data${id_data} [id^=${key}] .show_textarea`).innerHTML = `<div class="importValue"><label for="">Nhập danh sách lựa chọn cho kiểu ${value.value} các lựa chọn cách nhau bởi ba dấu ;;; </label><textarea type="text" name="number_list_${key}[]" class="col-xs-12"  onfocus="onfocus_text(this)" onblur="listener(this)" placeholder="" id="number_list_${key}${id_data}" rows="5"></textarea></div>`;
            }
        });
    }else{
        JSON.parse(document.getElementById('page_languages').value, function (key, value){
            if(key.length > 0){
                document.querySelector(`#data${id_data} [id^=${key}] .show_textarea`).innerHTML = '';
            }
        });
    }
    document.querySelector(`#field_${id_data} .checkbox_field`).innerHTML = choose;

    
}
function listener(ev){
    document.querySelector(`#${ev.closest('[id^="field_"]').id} > div`).setAttribute('draggable','true');
    document.querySelector(`#${ev.closest('[id^="field_"]').id}`).setAttribute('draggable','true');
    if(ev.tagName == 'INPUT'){
        ev.setAttribute('value',`${ev.value}`);
    }else{
        ev.innerHTML = ev.value;
    }
    if(ev.name == 'title_vi[]'){
        ev.closest('[id^="field_"]').querySelector('[data-target^="#demo"] b').innerHTML = `. ${ev.value}`;
    }
    
}
// rename all id, class 
function rename_all(id = 1){
    let [field, collapse, collapseIn, onClickRemove, list, select, data] = [
        document.querySelectorAll('[id^="field"]'),
        document.querySelectorAll('span[data-target^="#demo"]'),
        document.querySelectorAll('[id^="demo"]'),
        document.querySelectorAll('.fa-close.remove'),
        document.querySelectorAll('[id^="list"]'),
        document.querySelectorAll('[id^="list"] select'),
        document.querySelectorAll('[id^="data"]'),

    ];
    for (i = id; i <= field.length; i++) {
        field[i-1].id = `field_${i}`;
        collapse[i-1].setAttribute('data-target',`#demo${i}`);
        document.querySelectorAll(`span[data-target="#demo${i}"] span`)[0].innerHTML = i;
        collapseIn[i-1].id = `demo${i}`;
        onClickRemove[i-1].setAttribute('onclick',`remove_field(${i})`);
        list[i-1].id = `list${i}`;
        select[i-1].setAttribute('onchange',`select(this,${i})`);
        data[i-1].id = `data${i}`;
        JSON.parse(document.getElementById('page_languages').value, function (key, value){
            if(key.length > 0){
                document.querySelector(`#${data[i-1].id} ul li a[href^="#${key}"]`).setAttribute('href',`#${key}${data[i-1].id.replace("data", "")}`);
                document.querySelector(`#${data[i-1].id} ul li a[href^="#${key}"]`).setAttribute('aria-controls',`${key}${data[i-1].id.replace("data", "")}`);
                document.querySelector(`#${data[i-1].id} [id^="${key}"]`).id = `${key}${data[i-1].id.replace("data", "")}`;
            }
        });
    }
    let selectIn = document.querySelectorAll('.importValue');
    if(selectIn.length > 0){
        for (i = 0; i < selectIn.length; i++) {
            JSON.parse(document.getElementById('page_languages').value, function (key, value){
                if(key.length > 0){
                    document.querySelectorAll(`#${selectIn[i].closest('[id^="data"]').id} [id^="number_list_${key}"]`)[0].id = `number_list_${key}${selectIn[i].closest('[id^="data"]').id.replace("data", "")}`;
                }
            });
        }
    }
}

// xóa 1 field
function remove_field(id){
    JSON.parse(document.getElementById('page_languages').value, function (key, value){
        if(key.length > 0){
            var content = tinymce.get(`content_body_${key}`).getContent({format:'html'});
            var text_replace = document.querySelector(`#field_${id} [name="title_vi[]"]`).getAttribute('slug');
            tinymce.get(`content_body_${key}`).setContent(content.replace(new RegExp(`{${text_replace}}`, 'g'),``));
        }
    });
    index = after_slug.indexOf(document.querySelector(`#field_${id} [name="title_vi[]"]`).getAttribute('slug'));
    if(index > -1){
        after_slug.splice(index, 1);
    }
    append_field.removeChild(document.getElementById(`field_${id}`));
    if(document.querySelectorAll('[id^="field"]').length == 0){
        document.getElementById('number_field').value = '';
    }else{
        document.getElementById('number_field').value = document.querySelectorAll('[id^="field"]').length;
    }
    rename_all(id);
}

function check_validate(ev){
    slug = by_slug(document.querySelectorAll('#append_field [id^="demo"] [name="title_vi[]"]'));
    let html = '';

    JSON.parse(document.getElementById('page_languages').value, function (key, value){
        if(key.length > 0){
            for (var i = 0; i < document.querySelectorAll(`#append_field [id^="demo"] [id^=${key}] .title`).length; i++) {
                if(document.querySelectorAll(`#append_field [id^="demo"] [id^=${key}] .title`)[i].value.trim() == ''){
                    aria_expanded = document.querySelector(`#field_${i+1} .check-collapse`).getAttribute('aria-expanded');
                    if(aria_expanded == null || aria_expanded == 'false'){
                        document.querySelector(`#field_${i+1} .check-collapse`).setAttribute('aria-expanded','true');
                        document.querySelector(`#field_${i+1} .check-collapse`).classList.remove("collapsed");
                        document.querySelector(`#demo${i+1}`).classList.add("in");
                        document.querySelector(`#demo${i+1}`).setAttribute('aria-expanded','true');
                    }
                    document.querySelectorAll(`#append_field [id^="demo"] [id^=${key}] .title`)[i].parentElement.classList.add("has-error");
                    document.querySelectorAll(`#append_field [id^="demo"] [id^=${key}] .title`)[i].setAttribute('oninput','change_title(this)');
                    document.querySelector(`#append_field [id^="demo${i+1}"] [id^=${key}] .has-error span`).classList.remove("hidden");
                }
            }
        }
    });

    //check value name configuration if is require => focus
    if(document.getElementById(`name_configuration`).value.trim() == ''){
        // ev.setAttribute('data-target','#myModals');
        document.querySelector('#name_configuration').parentElement.classList.add("has-error");
        document.querySelector('#name_configuration').setAttribute('oninput','change_title(this)');
        document.querySelector(`#parent_configuration.has-error span`).classList.remove("hidden");
        document.getElementById(`name_configuration`).focus();
        return false;
    }

    //check title required if is require => focus
    if(document.querySelectorAll(`#append_field [id^="demo"] .has-error`).length == 0 && document.querySelectorAll(`#append_field [id^="field_"]`).length > 0 ){
        // ev.setAttribute('data-target','#myModal');
    }else{
        // ev.setAttribute('data-target','#myModals');
        if(document.querySelectorAll('#append_field .has-error .title').length == 0){
            alert('Bạn phải tạo ít nhất 1 Field');
        }else{

            id_field = document.querySelectorAll('#append_field .has-error .title')[0].closest('[id^="field_"]').id;
            id_parent = document.querySelectorAll('#append_field .has-error')[0].closest('[class^="tab-pane"]').id;
            document.querySelector(`#${id_field} .nav.nav-justified li.active a`).setAttribute("aria-expanded","false");
            document.querySelector(`#${id_field} .nav.nav-justified li.active`).classList.remove("active");
            document.querySelector(`#${id_field} .tab-content .tab-pane.active`).setAttribute("class","tab-pane fade");
            document.querySelector(`#${id_field} .has-error`).closest('[class^="tab-pane"]').setAttribute("class","tab-pane fade active in");
            document.querySelector(`#${id_field} a[href="#${id_parent}"]`).setAttribute("aria-expanded","true");
            document.querySelector(`#${id_field} a[href="#${id_parent}"]`).parentElement.classList.add("active");
            document.querySelectorAll('#append_field .has-error .title')[0].focus();
        }
        return false;
        
    }

    //show tab
    document.getElementById('config_send_mail').setAttribute('class','tab-pane fade');
    document.getElementById('config_contact').setAttribute('class','tab-pane fade');
    document.querySelector(`#${ev.getAttribute('aria-controls')}`).setAttribute('class','tab-pane fade in active');
    document.querySelectorAll('.nav-product')[0].setAttribute('style','display:block');
    document.querySelectorAll('.nav-product')[1].setAttribute('style','display:block');
    ev.closest('.nav-product').setAttribute('style','display:none');
    for (var i = 0; i < slug.length; i++) {
        html +=`<input type="button" value="${slug[i]}" class="btn btn-primary" style="margin-bottom:10px;margin-right:5px;" onclick="click_button(this)">`; 
    }
    for (var i = 0; i < document.querySelectorAll(`.add-content-body`).length; i++) {
        document.querySelectorAll(`.add-content-body`)[i].innerHTML = '';
        document.querySelectorAll(`.add-content-body`)[i].innerHTML = html;
    }
    if(ev.getAttribute('href') == '#config_send_mail'){
       by_slug_tinymce(ev); 
    }else{
        by_slug_after(ev); 
    }


}


// show modal form
function view_form(ev){
    ev.setAttribute('data-target','#myModal');
    if(document.getElementById('to_email').value.trim() == ''){
        ev.setAttribute('data-target','#myModals');
        document.querySelector('#to_email').parentElement.classList.add("has-error");
        document.querySelector('#to_email').setAttribute('oninput','change_title(this)');
        document.querySelector(`#parent_to_mail.has-error span`).classList.remove("hidden");
        document.getElementById(`to_email`).focus();
        return false;
    }
    let [html, title, list, description] = ['', document.querySelectorAll(`[id^="field_"] [name="title_vi[]"]`), document.querySelectorAll(`[id^="list"] select`), document.querySelectorAll(`[id^="field_"] [name="description_vi[]"]`)];
    //check all Field and show on modal
    for (var i = 0; i < title.length; i++) {
        switch(list[i].value){
            case 'textarea':
                html += `<div class="form-group col-xs-12">
                        <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                        <textarea name="content_field[]" value="" class="col-xs-12" rows="5"></textarea>
                    </div>`;
                break;
            case 'radio':
                let radio = '';
                for (var j = 0; j < document.getElementById(`number_list_vi${i+1}`).value.split(';;;').length; j++) {
                    radio += `<input type="radio" name="gioi-tinh"/><span style="margin-right:10px;padding-left:5px;">${document.getElementById(`number_list_vi${i+1}`).value.split(';;;')[j].trim()}</span>`;
                }
                html += `<div class="form-group col-xs-12">
                        <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                        ${radio}
                    </div>`;
                break;
            case 'checkbox':
                let checkbox = '';
                for (var j = 0; j < document.getElementById(`number_list_vi${i+1}`).value.split(';;;').length; j++) {
                    checkbox += `<input type="checkbox" name=""/><span style="margin-right:10px;padding:0px;">${document.getElementById(`number_list_vi${i+1}`).value.split(';;;')[j].trim()}</span>`;
                }
                html += `<div class="form-group col-xs-12">
                        <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                        ${checkbox}
                    </div>`;
                break;
            case 'select':
                let select = '';
                for (var j = 0; j < document.getElementById(`number_list_vi${i+1}`).value.split(';;;').length; j++) {
                    select += `<option value="">${document.getElementById(`number_list_vi${i+1}`).value.split(';;;')[j].trim()}</option>`;
                }
                html += `<div class="form-group col-xs-12">
                        <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}
                        <select name="" class="form-control" ${document.querySelector(`#field_${i+1} .check_multiple input`).checked ? 'multiple' : ''}>
                            ${select}
                        </select>
                    </div>`;
                break;
            case 'date':
                let date = '';
                html += `<div class="form-group col-xs-12">
                            <label for="">${title[i].value}</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" name="date" placeholder="${description[i].value}" id="realDPX-min" type="text">
                            </div>
                        </div>`;
                break;
            default:
                html += `<div class="form-group col-xs-12">
                        <label for="">${title[i].value}</label>
                        <input type="${list[i].value}" class="form-control" placeholder="${description[i].value}" />
                    </div>`;
        }
        
    }
    document.getElementById('modal-form').innerHTML = html;
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
    return false;
}

// chưa tìm hiểu
function allowDrop(ev) {
    ev.preventDefault();
}
 
 // kéo html and set value khi keo
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.parentElement.id);
    if(ev.dataTransfer.getData("text") != null  && ev.dataTransfer.getData("text") != ''){
        JSON.parse(document.getElementById('page_languages').value, function (key, value){
            if(key.length > 0){
                document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] .title`).setAttribute('value',`${document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] .title`).value}`);
                document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] .description`).setAttribute('value',`${document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] .description`).value}`);
                if(document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] textarea`) != null){
                    document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] textarea`).innerHTML = document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] textarea`).value;
                }
            }
        });
    }
}

// thả html and đẩy các thuốc tính phía sau xuống dưới hoặc các thuộc tính phía trước lên trên
function drop(ev) {
    ev.preventDefault();
    var before = ev.dataTransfer.getData("text");
    var after = ev.target.closest('[id^="field_"]').id;
    let HTML = document.getElementById(after).innerHTML;
    if(before != null  && before != ''){
        if(before.indexOf("field_") == '-1'){
            return false;
        }
        document.getElementById(after).innerHTML = document.getElementById(before).innerHTML;
        if(after.replace("field_", "") < before.replace("field_", "")){
            for (i = after.replace("field_", ""); i < before.replace("field_", ""); i++) {
                const LET = document.querySelectorAll('#append_field [id^="field_"]')[i].innerHTML;
                document.querySelectorAll('#append_field [id^="field_"]')[i].innerHTML = HTML;
                HTML = LET;
            }
        }else{
            for (i = after.replace("field_", "")-1; i > before.replace("field_", "")-1; i--) {
                const LET = document.querySelectorAll('#append_field [id^="field_"]')[i-1].innerHTML;
                document.querySelectorAll('#append_field [id^="field_"]')[i-1].innerHTML = HTML;
                HTML = LET;
            }
        }
        rename_all();
        if(after_slug.length > 0){
            after_slug.splice(after.replace("field_", "")-1, 0,after_slug.splice(before.replace("field_", "")-1, 1)[0]);
        }
    }
}

//
function onfocus_text(ev){
    document.querySelector(`#${ev.closest('[id^="field_"]').id} > div`).setAttribute('draggable','false');
    document.querySelector(`#${ev.closest('[id^="field_"]').id}`).setAttribute('draggable','false');
    return false;
}

// check checkbox multiple
function check_multiple(ev){
    if(ev.checked){
        ev.setAttribute('checked','checked');
    }else{
        ev.removeAttribute('checked');
    }
}
//slug title
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
    return str;
}

//submit add event check required title
function change_title(ev){
    if(ev.value == ''){
        ev.parentElement.classList.add("has-error");
        ev.closest('.required').querySelector('span').classList.remove("hidden");
    }else{
        ev.closest('.required').querySelector('span').classList.add("hidden");
        ev.parentElement.classList.remove("has-error");
    }
}

// check checkbox required add input text required
function check_required(ev){
    if(ev.checked){
        JSON.parse(document.getElementById('page_languages').value, function (key, value){
            if(key.length > 0){
                let html = `<div class="col-xs-12 content-required" style="padding-left:0px;padding-right:30px;"> 
                                <label for="">Nội dung hiện lên khi không chọn hoặc nhập thông tin</label>
                                <input type="text" name="required_content_${key}[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control required">
                           </div>`;
                document.querySelector(`#${key}${ev.closest('[id^="field_"]').id.replace("field_", "")} .required_field`).innerHTML = html;
                ev.setAttribute('checked','checked');
            }
        });
    }else{
        JSON.parse(document.getElementById('page_languages').value, function (key, value){
            if(key.length > 0){
                document.querySelector(`#${key}${ev.closest('[id^="field_"]').id.replace("field_", "")} .required_field`).innerHTML = '';
                ev.removeAttribute('checked');
            }
        });
    }
}

function by_slug_after(ev){
    after_slug = slug;
    for (var i = 0; i < after_slug.length; i++) {
        document.querySelectorAll('[id^=field_] [name="title_vi[]"]')[i].setAttribute('slug',after_slug[i]);
    }
}
function by_slug_tinymce(ev){
    slug = by_slug(document.querySelectorAll('#append_field [id^="demo"] [name="title_vi[]"]'));
    JSON.parse(document.getElementById('page_languages').value, function (key, value){
        if(key.length > 0){
            if(after_slug.length > 0 && tinymce.get(`content_body_${key}`).getContent({format:'text'}).length > 0){
                var content = tinymce.get(`content_body_${key}`).getContent({format:'html'});
                for (var i = 0; i < after_slug.length; i++) {
                    content = content.replace(new RegExp(`{${after_slug[i]}}`, 'g'),`{${slug[i]}}`);
                }
                tinymce.get(`content_body_${key}`).setContent(content);
            }
        }
    });
}

function by_slug(slug_name){
    var slug=[];
    for (var i = 0; i < slug_name.length; i++) {
        var slug_title = to_slug(slug_name[i].value,'_');
        if(slug.indexOf(slug_title) >= 0){
            var j = 1;
            while(j < slug_name.length){
                if(slug.indexOf(`${slug_title}_${j}`) < 0){
                    slug_title = `${slug_title}_${j}`;
                    break;
                }
                j++;
            }
        }
        slug.push(slug_title.trim());
    }
    return slug;
}

//sub mit form
function submit_shared(){
    let data = new FormData(document.querySelector('form.form-horizontal'));
    data.append('config_send_mail[to_email]', document.querySelector('#to_email').value);
    data.append('config_send_mail[cc_email]', document.querySelector('#cc_email').value);
    JSON.parse(document.getElementById('page_languages').value, function (key, value){
        if(key.length > 0){
            data.append(`config_send_mail[description_email][${key}]`, document.querySelector(`#description_email_${key}`).value);
            data.append(`config_send_mail[body][${key}]`, tinymce.get(`content_body_${key}`).getContent({format:'html'}));
        }
    });
    data.append('slug', by_slug(document.querySelectorAll('#append_field [id^="demo"] [name="title_vi[]"]')));
    data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
    for (var i = 0; i < document.querySelectorAll('#append_field [id^="demo"] .required_check').length; i++) {
        data.append('required_check[]', document.querySelectorAll('#append_field [id^="demo"] .required_check')[i].checked);
    }
    for (var i = 0; i < document.querySelectorAll('#append_field [id^="demo"] .check_multiple input').length; i++) {
        data.append('check_multiple[]', document.querySelectorAll('#append_field [id^="demo"] .check_multiple input')[i].checked);
    }
    var url = window.location.href;
    fetch(url,{method: "POST",body: data}
    ).then(
        response => response.json()
    ).then(
        html => {
            if(html.status == "200"){
                alert(html.message);
                if(window.location.pathname.indexOf("/config_contact/edit/") != '-1'){
                    document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                }else{
                    window.location.href=HOSTNAMEADMIN+"/config_contact";
                }
            }else{
                alert(html.message);
                location.reload();
            }
        }

    );

}
function click_button(e){
    tinymce.get(`content_body_${e.closest('.tab-pane.fade').id}`).execCommand('mceInsertContent', false, `{${e.value}}`);
}