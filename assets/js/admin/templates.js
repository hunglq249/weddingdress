switch(window.location.origin){
    case 'http://diamondtour.vn':
        var HOSTNAME = 'http://diamondtour.vn/';
        break;
    default:
        var HOSTNAME = 'http://localhost/soundon/';
}
switch(window.location.origin){
    case 'http://diamondtour.vn':
        var HOSTNAMEADMIN = 'http://diamondtour.vn/admin';
        break;
    default:
        var HOSTNAMEADMIN = 'http://localhost/soundon/admin';
}
let [lang,number_field_type] = ['vi',Number(document.getElementById('number_field_type').value)];
let [cursor, check, li, content,detail_templates,remove] = [0, 0, '', '',Object.entries(JSON.parse(document.getElementById('detail_templates').value)),new Array()];
let append_field = document.getElementById('append_field');
// thêm nhiều field

function addField(number){
    let [html, count_li] = ['',0];
    if(document.querySelectorAll('[id^="field_"]').length > number_field_type){
        let length_field = document.querySelectorAll('[id^="field_"]').length;
        for (var i = number_field_type+1; i <= length_field; i++) {
            append_field.removeChild(document.getElementById(`field_${i}`));
        }
    }
    if(number <= number_field_type){
        if(number < number_field_type){
            alert(`Số field ít nhất phải là ${number_field_type}`);
            document.getElementById('number_field').value = number_field_type;
        }
        return false;
    }
    for(i = number_field_type; i< number; i++){
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
                                    <label class="control-label" for="">Tiêu đề</label>
                                    <input type="text" name="title_${key}[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control title">
                                    <span class="help-block hidden">Bạn cần nhập trường này</span>
                                </div>
                                <div class="col-xs-12 show_textarea" style="padding:0px;">
                                    
                                </div> 
                            </div>
                        </div>
                    </div>
                `;
                count_li++;
            }
        })
        html += `<div class="form-group col-ms-12" style="padding: 0px;margin-bottom:5px;" id="field_${i+1}"  draggable="true" ondrop="drop(event)" ondragover="allowDrop(event)"> 
                    <div class="col-xs-12 drop-drag" draggable="true" ondragstart="drag(event)">
                        <div class="btn btn-primary col-ms-12" style="padding:0px; padding-top:5px; width:100%;text-align:left;">
                            <span data-toggle="collapse" data-target="#demo${i+1}" class="col-xs-10 check-collapse" style="height:35px;padding-top:2px;">
                                <span style="padding-left:10px;font-weight: 500;font-size: 1.2em;">${i+1}</span>
                                <b style="font-size: 1.1em;font-weight: 500;"></b> 
                            </span>
                            <i style="float: right;padding-right:5px;marrgin-top:-10px;" class="fa-2x fa fa-close remove" onclick="remove_field(${i+1})"></i>
                        </div>
                        <div id="demo${i+1}" class="collapse in form-group">
                            <div class="col-xs-12" style="padding: 0px;">
                                <div class="col-sm-6 col-xs-12">
                                    <label class="control-label" for="inputError">Mô tả</label>
                                    <input type="text" name="description[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control description">
                                </div>
                                <div class="col-xs-6" id="list${i+1}">
                                    <label for="" style="margin-bottom: 0px; margin-top: 7px;">Kiểu Nhập</label>
                                    <select name="type[]"  class="form-control select_type" onchange="select(this,'${i+1}')">
                                        <option value="text">Text</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="radio">Radio</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="password">Password</option>
                                        <option value="select">Select</option>
                                        <option value="date">Date</option>
                                        <option value="file">Image</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12" style="padding:0px;">
                                <div class="col-sm-6 col-xs-12">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="" value="" class="check_language" onclick="check_multiple(this)">Chỉ cho phép nhập hoặc chọn một ngôn ngữ
                                    </label>
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
    document.getElementById('append_field').insertAdjacentHTML('beforeend', html);
}

// thêm 1 field
function addOneField(){
    let [count_li , li, content, html, number] = [0, '', '', '', document.querySelectorAll('[id^="field"]').length];
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
                            <div class="col-xs-12 required" style="padding:0px;">
                                <label class="control-label" for="">Tiêu đề</label>
                                <input type="text" name="title_${key}[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control title">
                                <span class="help-block hidden">Bạn cần nhập trường này</span>
                            </div> 
                            <div class="col-xs-12 show_textarea" style="padding:0px;">
                                
                            </div> 
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
                        <span data-toggle="collapse" data-target="#demo${number+1}" class="col-xs-10 check-collapse" style="height:35px;padding-top:2px;">
                            <span style="padding-left:10px;font-weight: 500;font-size: 1.2em;">${number+1}</span>
                            <b style="font-size: 1.1em;font-weight: 500;"></b> 
                        </span>
                        <i style="float: right;padding-right:5px;marrgin-top:-10px;" class="fa-2x fa fa-close remove" onclick="remove_field(${number+1})"></i>
                    </div>
                    <div id="demo${number+1}" class="collapse in form-group">
                        <div class="col-xs-12" style="padding:0px;">
                            <div class="col-sm-6 col-xs-12">
                                <label class="control-label" for="inputError">Mô tả</label>
                                <input type="text" name="description[]" value="" placeholder="" onfocus="onfocus_text(this)" onblur="listener(this)" class="form-control description">
                            </div>
                            <div class="col-xs-6" id="list${number+1}">
                                <label for="" style="margin-bottom: 0px; margin-top: 7px;">Kiểu Nhập</label>
                                <select name="type[]"  class="form-control select_type" onchange="select(this,'${number+1}')">
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="radio">Radio</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="password">Password</option>
                                    <option value="select">Select</option>
                                    <option value="date">Date</option>
                                    <option value="file">Image</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding:0px;">
                            <div class="col-sm-6 col-xs-12">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="" value="" class="check_language" onclick="check_multiple(this)">Chỉ cho phép nhập hoặc chọn một ngôn ngữ
                                </label>
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
    if(window.location.pathname.indexOf("/templates/edit/") != '-1'){
        detail_templates.push(['key','value']);
    }
    
}
function select(value,id_data){
    let [append, choose, li, count_li, content] = ['', '', '', 0, ''];
    document.querySelector(`#field_${id_data} .check_language`).removeAttribute('disabled');
    document.querySelector(`#field_${id_data} .check_language`).checked = false;
    if (document.querySelector(`#list${id_data} option[selected="selected"]`) != null) {
        document.querySelector(`#list${id_data} option[selected="selected"]`).removeAttribute('selected');
    }
    document.querySelector(`#field_${id_data} [value="${value.value}"]`).setAttribute('selected',`selected`);
    if(value.value == 'file'){
        document.querySelector(`#field_${id_data} .check_language`).checked = true;
        document.querySelector(`#field_${id_data} .check_language`).setAttribute('disabled','disabled');
    }
    if(value.value == 'radio' || value.value == 'checkbox' || value.value == 'select'){
        document.querySelector(`#field_${id_data} .check_language`).checked = true;
        document.querySelector(`#field_${id_data} .check_language`).setAttribute('disabled','disabled');
        if(value.value == 'select'){
            choose = `<div class="checkbox form-group col-xs-12 check_multiple" style="margin-top:5px;">
                         <label>
                            <input type="checkbox" name="" value="" class="select_multiple" onclick="check_multiple(this)">Được phép chọn nhiều
                         </label>
                     </div>`;
            
        }
        JSON.parse(document.getElementById('page_languages').value, function (key, value){
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
    if(value.value == 'textarea' || value.value == 'file' || value.value == 'select'){
        let content_html = (value.value == 'textarea') ? 'Nhúng trình soạn thảo tinymce' : 'Chọn nhiều ảnh';
        if(value.value == 'select'){
            content_html = 'Được phép chọn nhiều';
        }
        choose = `
            <div class="col-ms-12 check_multiple">
                <div class="col-ms-12">
                    <label class="checkbox-inline"><input type="checkbox" onclick="check_multiple(this)">${content_html}</label>
                </div>
            </div>
        `;
    }
    document.querySelector(`#field_${id_data} .checkbox_field`).innerHTML = choose;
}
function listener(ev){
    if(Number(ev.closest('[id^="field_"]').id.replace('field_','')) > number_field_type){
        document.querySelector(`#${ev.closest('[id^="field_"]').id} > div`).setAttribute('draggable','true');
        document.querySelector(`#${ev.closest('[id^="field_"]').id}`).setAttribute('draggable','true');
        if(ev.tagName == 'INPUT'){
            ev.setAttribute('value',`${ev.value}`);
        }else{
            ev.innerHTML = ev.value;
        }
    }
    if(ev.name == `title_${lang}[]`){
        ev.closest('[id^="field_"]').querySelector('[data-target^="#demo"] b').innerHTML = `. ${ev.value}`;
    }
    
    
}
// rename all id, class 
function rename_all(id = number_field_type){
    let [field, collapse, collapseIn, onClickRemove, list, select, data] = [
        document.querySelectorAll('[id^="field_"]'),
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
                    document.querySelector(`#${selectIn[i].closest('[id^="data"]').id} [id^="number_list_${key}"]`).id = `number_list_${key}${selectIn[i].closest('[id^="data"]').id.replace("data", "")}`;
                }
            });
            
        }
    }
}

// xóa 1 field
function remove_field(id){
    append_field.removeChild(document.getElementById(`field_${id}`));
    if(document.querySelectorAll('[id^="field"]').length == 0){
        document.getElementById('number_field').value = '';
    }else{
        document.getElementById('number_field').value = document.querySelectorAll('[id^="field"]').length;
    }
    rename_all(id);
    if(window.location.pathname.indexOf("/templates/edit/") != '-1'){
        let remove_temp = detail_templates.splice(id-1, 1)[0][0];
        if(remove_temp != 'key'){
            remove.push(remove_temp);
        }
        
    }
}

function check_validate(ev){
    // slug = by_slug(document.querySelectorAll('#append_field [id^="demo"] .title'));
    let [html, count, id_field, id_parent] = ['', 0, '', ''];
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
        ev.setAttribute('data-target','#myModals');
        document.querySelector('#name_configuration').parentElement.classList.add("has-error");
        document.querySelector('#name_configuration').setAttribute('oninput','change_title(this)');
        document.querySelector(`#parent_configuration.has-error span`).classList.remove("hidden");
        document.getElementById(`name_configuration`).focus();
        return false;
    }

    //check title required if is require => focus
    if(document.querySelectorAll(`#append_field [id^="demo"] .has-error`).length == 0 && document.querySelectorAll(`#append_field [id^="field_"]`).length > 0 ){
        ev.setAttribute('data-target','#myModal');
        view_form(ev);
    }else{
        ev.setAttribute('data-target','#myModals');
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
}


// show modal form
function view_form(ev){
    ev.setAttribute('data-target','#myModal');
    let [html, html_language, show_html, title, list, description, count, tinymce_area] = ['', [], '', document.querySelectorAll(`[id^="field_"] [name="title_${lang}[]"]`), document.querySelectorAll(`[id^="list"] select`), document.querySelectorAll(`[id^="field_"] .description`), 0, ''];
    JSON.parse(document.getElementById('page_languages').value, function (key, value){
        if(key.length > 0){
            html_language[key] = '';
        }
    });
    //check all Field and show on modal
    for (var i = 0; i < title.length; i++) {
        if(document.querySelectorAll('.check_language')[i].checked){
            switch(list[i].value){
                case 'textarea':
                    if(document.querySelectorAll(`.check_multiple input`)[count].checked){
                        tinymce_area = 'tinymce-area';
                    }else{
                        tinymce_area = '';
                    }
                    count++;
                    html += `<div class="form-group col-xs-12">
                            <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                            <textarea name="content_field[]" value="" class="col-xs-12 ${tinymce_area}" rows="5"></textarea>
                        </div>`;
                    break;
                case 'radio':
                    let radio = '';
                    for (var j = 0; j < document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;').length; j++) {
                        radio += `<input type="radio" name="gioi-tinh"/><span style="margin-right:10px;padding-left:5px;">${document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;')[j].trim()}</span>`;
                    }
                    html += `<div class="form-group col-xs-12">
                            <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                            ${radio}
                        </div>`;
                    break;
                case 'checkbox':
                    let checkbox = '';
                    for (var j = 0; j < document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;').length; j++) {
                        checkbox += `<label class="checkbox-inline"><input type="checkbox" name="test"/><span>${document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;')[j].trim()}</span></label>`;
                    }
                    html += `<div class="form-group col-xs-12">
                            <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                            ${checkbox}
                        </div>`;
                    break;
                case 'select':
                    let select = '';
                    count+=1;
                    for (var j = 0; j < document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;').length; j++) {
                        select += `<option value="">${document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;')[j].trim()}</option>`;
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
                case 'file':
                    let image = '';
                    count++;
                    html += `<div class="form-group col-xs-12">
                            <label for="">${title[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}
                            <input type="${list[i].value}" class="form-control" placeholder="${description[i].value}" ${document.querySelector(`#field_${i+1} .check_multiple input`).checked ? 'multiple' : ''}/>
                        </div>`;
                    break;
                default:
                    html += `<div class="form-group col-xs-12">
                            <label for="">${title[i].value}</label>
                            <input type="${list[i].value}" class="form-control" ${(i == 1) ? 'readonly' : ''} placeholder="${description[i].value}" />
                        </div>`;
            }
        }else{
            JSON.parse(document.getElementById('page_languages').value, function (key, val){
                if(key.length > 0){
                    switch(list[i].value){
                        case 'textarea':
                            if(document.querySelectorAll(`.check_multiple input`)[count].checked){
                                tinymce_area = 'tinymce-area';
                            }else{
                                tinymce_area = '';
                            }
                            if(key == 'en'){
                                count++;
                            }
                            html_language[key] += `<div class="form-group col-xs-12" style="padding:0px;">
                                    <label for="">${document.querySelectorAll(`[id^="field_"] [name="title_${key}[]"]`)[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                                    <textarea name="content_field[]" value="" class="col-xs-12 ${tinymce_area}" rows="5"></textarea>
                                </div>`;
                            break;
                        case 'radio':
                            let radio = '';
                            for (var j = 0; j < document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;').length; j++) {
                                radio += `<input type="radio" name="gioi-tinh"/><span style="margin-right:10px;padding-left:5px;">${document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;')[j].trim()}</span>`;
                            }
                            html_language[key] += `<div class="form-group col-xs-12" style="padding:0px;">
                                    <label for="">${document.querySelectorAll(`[id^="field_"] [name="title_${key}[]"]`)[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                                    ${radio}
                                </div>`;
                            break;
                        case 'checkbox':
                            let checkbox = '';
                            for (var j = 0; j < document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;').length; j++) {
                                checkbox += `<label class="checkbox-inline"><input type="checkbox" name="test"/><span>${document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;')[j].trim()}</span></label>`;
                            }
                            html_language[key] += `<div class="form-group col-xs-12" style="padding:0px;">
                                    <label for="">${document.querySelectorAll(`[id^="field_"] [name="title_${key}[]"]`)[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}</br>
                                    ${checkbox}
                                </div>`;
                            break;
                        case 'select':
                            let select = '';
                            count+=1;
                            for (var j = 0; j < document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;').length; j++) {
                                select += `<option value="">${document.getElementById(`number_list_${lang}${i+1}`).value.split(';;;')[j].trim()}</option>`;
                            }
                            html_language[key] += `<div class="form-group col-xs-12" style="padding:0px;">
                                    <label for="">${document.querySelectorAll(`[id^="field_"] [name="title_${key}[]"]`)[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}
                                    <select name="" class="form-control" ${document.querySelector(`#field_${i+1} .select_multiple`).checked ? 'multiple' : ''}>
                                        ${select}
                                    </select>
                                </div>`;
                            break;
                        case 'date':
                            let date = '';
                            html_language[key] += `<div class="form-group col-xs-12" style="padding:0px;">
                                        <label for="">${document.querySelectorAll(`[id^="field_"] [name="title_${key}[]"]`)[i].value}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" name="date" placeholder="${description[i].value}" id="realDPX-min" type="text">
                                        </div>
                                    </div>`;
                            break;
                        case 'file':
                            let image = '';
                            if(key == 'en'){
                                count++;
                            }
                            html_language[key] += `<div class="form-group col-xs-12" style="padding:0px;">
                                    <label for="">${document.querySelectorAll(`[id^="field_"] [name="title_${key}[]"]`)[i].value}</label>${description[i].value ? ' (<i>'+ description[i].value +'</i>)' : ''}
                                    <input type="${list[i].value}" class="form-control" placeholder="${description[i].value}" ${document.querySelector(`#field_${i+1} .check_multiple input`).checked ? 'multiple' : ''}/>
                                </div>`;
                            break;
                        default:
                            html_language[key] += `<div class="form-group col-xs-12" style="padding:0px;">
                                    <label for="">${document.querySelectorAll(`[id^="field_"] [name="title_${key}[]"]`)[i].value}</label>
                                    <input type="${list[i].value}" class="form-control" ${(i == 1) ? 'readonly' : ''} placeholder="${description[i].value}" />
                                </div>`;
                    }
                }
            });
        }
        
    }
    let [obj, li, count_li, content] = [JSON.parse(document.getElementById('page_languages').value), '', 0, ''];
    JSON.parse(document.getElementById('page_languages').value, function (key, value){
        if(key.length > 0){
            li += `<li role="presentation" class="${(count_li == 0) ? 'active' : '' }">
                <a href="#${key}" aria-controls="<?php echo $key ?>" role="tab" data-toggle="tab">
                    <span class="badge">${count_li+1}</span> ${value}
                </a>
            </li>`;
            content +=`<div role="tabpanel" class="tab-pane ${(count_li == 0) ? 'active' : '' }" id="${key}">
                <div class="col-xs-12" style="padding:0px;">
                    ${html_language[key]}
                </div>
            </div>`;
            count_li++;
        }
    });
    show_html +=html;
    show_html +=`<div class="col-xs-12">
        <ul class="nav nav-pills nav-justified" role="tablist">
            ${li}
        </ul>
        <div class="tab-content">
            ${content}
        </div>
    </div>`;
    document.getElementById('modal-form').innerHTML = show_html;
    getTinymce();
    document.querySelectorAll(`[id^="field_"] .title`);
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
            }
        });
        document.querySelector(`#${ev.dataTransfer.getData("text")} .description`).setAttribute('value',`${document.querySelector(`#${ev.dataTransfer.getData("text")} .description`).value}`);
        if(document.querySelector(`#${ev.dataTransfer.getData("text")} .check_language`).checked){
            document.querySelector(`#${ev.dataTransfer.getData("text")} .check_language`).setAttribute('checked','checked');
        }
        if(document.querySelector(`#${ev.dataTransfer.getData("text")} textarea`) != null){
            JSON.parse(document.getElementById('page_languages').value, function (key, value){
                if(key.length > 0){
                    document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] textarea`).innerHTML = document.querySelector(`#${ev.dataTransfer.getData("text")} [id^=${key}] textarea`).value;
                }
            });
        }        
        if(document.querySelector(`#${ev.dataTransfer.getData("text")} .check_multiple input`) != null && document.querySelector(`#${ev.dataTransfer.getData("text")} .check_multiple input`).checked){
            document.querySelector(`#${ev.dataTransfer.getData("text")} .check_multiple input`).setAttribute('checked','checked');
        }
    }
}

// thả html and đẩy các thuốc tính phía sau xuống dưới hoặc các thuộc tính phía trước lên trên
function drop(ev) {
    ev.preventDefault();
    var before = ev.dataTransfer.getData("text");
    var after = ev.target.closest('[id^="field_"]').id;
    let HTML = document.getElementById(after).innerHTML;
    if(before != null  && before != ''){
        if(Number(after.replace("field_", "")) <= number_field_type || before.indexOf("field_") == '-1'){
            return false;
        }
        document.getElementById(after).innerHTML = document.getElementById(before).innerHTML;
        if(Number(after.replace("field_", "")) < Number(before.replace("field_", ""))){
            for (i = Number(after.replace("field_", "")); i < Number(before.replace("field_", "")); i++) {
                const LET = document.querySelectorAll('#append_field [id^="field_"]')[i].innerHTML;
                document.querySelectorAll('#append_field [id^="field_"]')[i].innerHTML = HTML;
                HTML = LET;
            }
            console.log(1);
        }else{
            for (i = Number(after.replace("field_", ""))-1; i > Number(before.replace("field_", ""))-1; i--) {
                const LET = document.querySelectorAll('#append_field [id^="field_"]')[i-1].innerHTML;
                document.querySelectorAll('#append_field [id^="field_"]')[i-1].innerHTML = HTML;
                HTML = LET;
            }
            console.log(1);
        }
        rename_all();
        if(window.location.pathname.indexOf("/templates/edit/") != '-1'){
            detail_templates.splice(Number(after.replace("field_", ""))-1, 0,detail_templates.splice(Number(before.replace("field_", ""))-1, 1)[0]);
        }
        
    }
}

//
function onfocus_text(ev){
    if(Number(ev.closest('[id^="field_"]').id.replace('field_','')) >= number_field_type){
        document.querySelector(`#${ev.closest('[id^="field_"]').id} > div`).setAttribute('draggable','false');
        document.querySelector(`#${ev.closest('[id^="field_"]').id}`).setAttribute('draggable','false');
    }
    return false;
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
    let html = `<div class="col-xs-12 content-required" style="margin-top:5px;"> 
                    <label for="">Nội dung hiện lên khi Không chọn hoặc nhập thông tin</label>
                    <input type="text" name="required_content[]" value="" placeholder="" onblur="listener(this)" class="form-control required">
               </div>`;
    if(ev.checked){
        ev.parentElement.parentElement.parentElement.insertAdjacentHTML('beforeend', html);
        ev.setAttribute('checked','checked');
    }else{
        document.querySelector(`#${ev.closest('[id^="demo"]').id} .content-required`).remove();
        ev.removeAttribute('checked');
    }
}
// check checkbox multiple
function check_multiple(ev){
    if(ev.checked){
        ev.setAttribute('checked','checked');
    }else{
        ev.removeAttribute('checked');
    }
}

function by_slug(slug_name){
    if(number_field_type == 6){
        var slug=['image_shared', 'slug_shared', 'parent_id_shared', 'title', 'description', 'content'];
    }else{
        var slug=['image_shared', 'slug_shared', 'parent_id_shared', 'title', 'description', 'content'];
    }
    
    for (var i = number_field_type; i < slug_name.length; i++) {
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
    for (var i = 0; i < document.querySelectorAll('select.select_type').length; i++) {
        document.querySelectorAll('select.select_type')[i].removeAttribute('disabled');
    }
    let data = new FormData(document.querySelector('form.form-horizontal'));
    for (var i = 0; i < by_slug(document.querySelectorAll(`#append_field [id^="demo"] .title[name="title_${lang}[]"]`)).length; i++) {
        data.append('slug[]', by_slug(document.querySelectorAll(`#append_field [id^="demo"] .title[name="title_${lang}[]"]`))[i]);
    }
    data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
    for (var i = 0; i < document.querySelectorAll('#append_field [id^="demo"] .required_check').length; i++) {
        data.append('required_check[]', document.querySelectorAll('#append_field [id^="demo"] .required_check')[i].checked);
    }
    for (var i = 0; i < document.querySelectorAll('#append_field [id^="demo"] .check_language').length; i++) {
        data.append('check_language[]', document.querySelectorAll('#append_field [id^="demo"] .check_language')[i].checked);
    }
    for (var i = 0; i < document.querySelectorAll('#append_field [id^="demo"] .check_multiple input').length; i++) {
        data.append('check_multiple[]', document.querySelectorAll('#append_field [id^="demo"] .check_multiple input')[i].checked);
    }
    if(window.location.pathname.indexOf("/templates/edit/") != '-1'){
        let detail = new Object();
        let add_field = new Object();
        let var_count = 0;
        detail_templates.map((index,key) => {
            if(typeof index[1] == 'string'){
                add_field[var_count] =  by_slug(document.querySelectorAll(`#append_field [id^="demo"] .title[name="title_${lang}[]"]`))[var_count];
                detail[by_slug(document.querySelectorAll(`#append_field [id^="demo"] .title[name="title_${lang}[]"]`))[var_count]] = var_count;
            }else{
                detail[index[0]] = index[1];
            }
            var_count++;
        });
        data.append('detail', JSON.stringify(detail));
        data.append('add_field', JSON.stringify(add_field));
        data.append('remove', JSON.stringify(remove));
    }
    var url = window.location.href;
    fetch(url,{method: "POST",body: data}
    ).then(
        response => response.json()
    ).then(
        html => {
            if(html.status == "200"){
                alert(html.message);
                if(window.location.pathname.indexOf("/templates/edit/") != '-1'){
                    document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                    detail_templates = Object.entries(JSON.parse(html.reponse.detail));
                    remove = new Array();
                    for (var i = 0; i < document.querySelectorAll('select.select_type').length; i++) {
                        document.querySelectorAll('select.select_type')[i].setAttribute('disabled','disabled');
                    }
                }else{
                    window.location.href=HOSTNAMEADMIN+"/templates";
                }
            }else{
                alert(html.message);
                if(html.reponse.csrf_hash != 'undefined'){
                    document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                }else{
                    location.reload();
                }
            }
        }

    );

}

function getTinymce(){
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