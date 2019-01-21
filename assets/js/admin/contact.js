
    function submit_shared(){
        for (var i = 0; i < document.querySelectorAll('div.form-group.required').length; i++) {
            let type = document.querySelectorAll('div.form-group.required')[i].querySelector('label').getAttribute('for');
            if(type == 'radio' || type == 'checkbox'){
                if(document.querySelectorAll('div.form-group.required')[i].querySelectorAll('input:checked').length == 0){
                    document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                    document.querySelectorAll('div.form-group.required')[i].setAttribute('oninput','check_checked(this)');
                    document.querySelectorAll('div.form-group.required')[i].querySelector('span').classList.remove("hidden");
                }
            }else if(type == 'textarea'){
                if(document.querySelectorAll('div.form-group.required')[i].querySelector('textarea').value == ''){
                    document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                    document.querySelectorAll('div.form-group.required')[i].setAttribute('oninput','check_textarea(this)');
                    document.querySelectorAll('div.form-group.required')[i].querySelector('span').classList.remove("hidden");
                }
            }else if(type == 'date'){
                if(document.querySelectorAll('div.form-group.required')[i].querySelector('input').value == ''){
                    document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                    document.querySelectorAll('div.form-group.required')[i].querySelector('input').setAttribute('onchange','check_date(this)');
                    document.querySelectorAll('div.form-group.required')[i].querySelector('span.help-block').classList.remove("hidden");
                }
            }else{
                if(document.querySelectorAll('div.form-group.required')[i].querySelector('input').value == ''){
                    document.querySelectorAll('div.form-group.required')[i].classList.add("has-error");
                    document.querySelectorAll('div.form-group.required')[i].setAttribute('oninput','check_text(this)');
                    document.querySelectorAll('div.form-group.required')[i].querySelector('span.help-block').classList.remove("hidden");
                }
            }
        }
        if(document.querySelectorAll('.has-error').length > 0){
            return false;
        }
        let data = new FormData(document.querySelector('form.form-contact'));
        data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
        var url = 'http://localhost/adminMato/testcontact/send';
        fetch(url,{method: "POST",body: data}
        ).then(
            response => response.json()
        ).then(
            html => {
                if(html.status == "200"){
                    alert(html.message);
                    document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                }else{
                    alert(html.message);
                    location.reload();
                }
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
            ev.classList.add("has-error");
            ev.querySelector('span').classList.remove("hidden");
        }else{
            ev.querySelector('span').classList.add("hidden");
            ev.classList.remove("has-error");
        }
    }
    function check_textarea(ev){
        if(ev.querySelector('textarea').value == ''){
            ev.classList.add("has-error");
            ev.querySelector('span').classList.remove("hidden");
        }else{
            ev.querySelector('span').classList.add("hidden");
            ev.classList.remove("has-error");
        }
    }
    function check_text(ev){
        if(ev.querySelector('input').value == ''){
            ev.classList.add("has-error");
            ev.querySelector('span.help-block').classList.remove("hidden");
        }else{
            ev.querySelector('span.help-block').classList.add("hidden");
            ev.classList.remove("has-error");
        }
    }
    function check_date(ev){
        if(ev.value == ''){
            ev.closest('.required').classList.add("has-error");
            ev.closest('.required').querySelector('span.help-block').classList.remove("hidden");
        }else{
            ev.closest('.required').querySelector('span.help-block').classList.add("hidden");
            ev.closest('.required').classList.remove("has-error");
        }
    }