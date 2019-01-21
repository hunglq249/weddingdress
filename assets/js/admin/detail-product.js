for (var i = 0; i < document.querySelectorAll('[id^="demo"]').length; i++) {
    value = document.querySelectorAll('[id^="demo"]')[i].querySelector('.color').innerHTML;
    document.querySelectorAll(`[data-target^="#demo"] b`)[i].innerHTML = value;
}
switch(window.location.origin){
    case 'http://diamondtour.vn':
        var HOSTNAMEADMIN = 'http://diamondtour.vn/admin';
        break;
    default:
        var HOSTNAMEADMIN = 'http://localhost/weddingdress/admin';
}
html_modal = `<div class="modal" role="dialog" style="display: block; opacity: 0.5">
    <div class="modal-dialog" style="color:#fff; text-align:center; padding-top:300px;">
        <i class="fa fa-2x fa-spinner fa-spin" aria-hidden="true"></i>
    </div>
</div>`;
function remove_image(controller, id, image, k, key, column){
    if(confirm('Chắc chắn xóa ảnh này?')){
        let data = new FormData(document.querySelector('form.form-horizontal'));
        data.append('id', id);
        data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
        data.append('image', image);
        data.append('key', key);
        // data.append('k', k);
        data.append('column', column);
        var url = HOSTNAMEADMIN + '/' + controller + '/remove_image_multiple';
        fetch(url,{method: "POST",body: data}
        ).then(
            response => response.json()
        ).then(
            html => {
                if(html.status == "200"){
                    alert(html.message);
                    $(`.${column}.row_${k}`).fadeOut();
                    document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                    
                }else{
                    alert(html.message);
                    location.reload();
                }
            }

        );
    }
}
function activated_image(controller, id, image, k, key, column){
    let data = new FormData(document.querySelector('form.form-horizontal'));
    data.append('id', id);
    data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
    data.append('image', image);
    data.append('key', key);
    data.append('column', column);
    var url = HOSTNAMEADMIN + '/' + controller + '/img_activated';
    fetch(url,{method: "POST",body: data}
    ).then(
        response => {
            document.getElementById('encypted_ppbtn_all').innerHTML = html_modal;
            return response.json();
        }
    ).then(
        html => {
            document.getElementById('encypted_ppbtn_all').innerHTML = '';
            if(html.status == "200"){
                alert(html.message);
                if(document.querySelector(`#demo${key} .avata`) != null){
                    document.querySelector(`#demo${key} .avata`).style.color = 'black';
                    document.querySelector(`#demo${key} .avata`).classList.remove('avata');
                }
                if(html.reponse.update_activated == '1'){
                    document.querySelector(`#demo${key} .${column}.row_${k} .fa-check`).style.color = 'green';
                    document.querySelector(`#demo${key} .${column}.row_${k} .fa-check`).classList.add('avata');
                }
                document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
            }else{
                alert(html.message);
                location.reload();
            }
        }

    );
}