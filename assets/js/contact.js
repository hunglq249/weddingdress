function submit_shared(){
    for (var i = 0; i < document.querySelectorAll('div.form-row.required').length; i++) {
        let type = document.querySelectorAll('div.form-row.required')[i].querySelector('label').getAttribute('for');
        if(type == 'radio' || type == 'checkbox'){
            if(document.querySelectorAll('div.form-row.required')[i].querySelectorAll('input:checked').length == 0){
                for (var j = 0; j < document.querySelectorAll('div.form-row.required')[i].querySelectorAll('input').length; j++) {
                    document.querySelectorAll('div.form-row.required')[i].querySelectorAll('input')[j].classList.add("is-invalid");
                }
                document.querySelectorAll('div.form-row.required')[i].setAttribute('oninput','check_checked(this)');
                document.querySelectorAll('div.form-row.required')[i].querySelector('.row.invalid-feedback').style.display = 'inline-block';
            }
        }else if(type == 'textarea'){
            if(document.querySelectorAll('div.form-row.required')[i].querySelector('textarea').value == ''){
                document.querySelectorAll('div.form-row.required')[i].querySelector('textarea').classList.add("is-invalid");
                document.querySelectorAll('div.form-row.required')[i].setAttribute('oninput','check_textarea(this)');
            }
        }else if(type == 'date'){
            if(document.querySelectorAll('div.form-row.required')[i].querySelector('input').value == ''){
                document.querySelectorAll('div.form-row.required')[i].querySelector('input').classList.add("is-invalid");
                document.querySelectorAll('div.form-row.required')[i].querySelector('input').setAttribute('onchange','check_date(this)');
            }
        }else if(type == 'text'){
            if(document.querySelectorAll('div.form-row.required')[i].querySelector('input').value == ''){
                document.querySelectorAll('div.form-row.required')[i].querySelector('input').classList.add("is-invalid");
                document.querySelectorAll('div.form-row.required')[i].setAttribute('oninput','check_text(this)');
            }
        }
    }
    if(document.querySelectorAll('.is-invalid').length > 0){
        document.querySelector('.is-invalid').focus();
        return false;
    }
    let data = new FormData(document.querySelector('form.form-horizontal'));
    data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
    var url = 'http://localhost/weddingdress/contact/send';
    fetch(url,{method: "POST",body: data}
    ).then(
        response => {
            document.getElementById('encypted_ppbtn_all').innerHTML = `<div class="modal" role="dialog" style="display: block; opacity: 0.7;background: gray;">
                <div class="modal-dialog" style="color:#fff; text-align:center; padding-top:300px;">
                    <i class="fa fa-2x fa-spinner fa-spin" aria-hidden="true"></i>
                </div>
            </div>`;
            return response.json();
        }
    ).then(
        html => {
            alert(html.message);
            document.getElementById('encypted_ppbtn_all').innerHTML = '';
            location.reload();
        }

    );
}
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
function check_checked(ev){
    if(ev.querySelectorAll('input:checked').length == 0){
        for (var i = 0; i < ev.querySelectorAll('input').length; i++) {
            ev.querySelectorAll('input')[i].classList.add("is-invalid");
        }
        ev.closest('div.form-row.required').querySelector('.row.invalid-feedback').style.display = 'inline-block';
    }else{
        for (var i = 0; i < ev.querySelectorAll('input').length; i++) {
            ev.querySelectorAll('input')[i].classList.remove("is-invalid");
        }
        ev.closest('div.form-row.required').querySelector('.row.invalid-feedback').style.display = 'none';
    }
}
function check_textarea(ev){
    if(ev.querySelector('textarea').value == ''){
        ev.querySelector('textarea').classList.add("is-invalid");
    }else{
        ev.querySelector('textarea').classList.remove("is-invalid");
    }
}
function check_text(ev){
    if(ev.querySelector('input').value == ''){
        ev.querySelector('input').classList.add("is-invalid");
    }else{
        ev.querySelector('input').classList.remove("is-invalid");
    }
}
function check_date(ev){
    if(ev.value == ''){
        ev.classList.add("is-invalid");
    }else{
        ev.classList.remove("is-invalid");
    }
}