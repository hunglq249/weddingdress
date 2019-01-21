

<input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" placeholder="" class="form-control hidden" id="csrf_sitecom_token">
<input type="text" name="page_languages" value='<?php echo json_encode($page_languages); ?>' placeholder="" class="form-control hidden" id="page_languages">
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Thêm mới
        <small>
            Bài Viết
        </small>
    </h1>
</section>
<div id="encypted_ppbtn_all"></div>
<!-- Main content -->
<section class="content"  onload="onload_a()">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-body">
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal'));
                    ?>
                    <div class="col-xs-12">
                        <h4 class="box-title">Thông tin cơ bản</h4>
                    </div>
                    <div class="row">
                        <span><?php echo $this->session->flashdata('message'); ?></span>
                    </div>
                    <?php
                        $a_language = '';
                        $multiple_language = array('vi' => '', 'en' => '');
                        foreach (json_decode($detail['data'],true) as $key => $value) {
                            $required = '';
                            $required_span = '';
                            $required_focus = '';
                            if(isset($value['required'])){
                                $required = 'required';
                                $required_span = '<span class="help-block hidden">' .$value['required']. '</span>';
                                $required_focus = 'required_focus';
                            }
                            if($value['check_language'] == 'true'){
                                switch ($value['type']) {
                                    case 'textarea':
                                        $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br><textarea name="' . $key . '" value="" class="col-xs-12 ' . (isset($value['check_multiple']) ? 'tinymce-area' : '') . '" rows="5" id="' .$key. '"></textarea>' .$required_span. '</div>';
                                        break;
                                    
                                    case 'radio':
                                        $radio = '';
                                        foreach ($value['choice']['vi'] as $k => $val) {
                                           $radio .= '<input type="radio" name="' . $key . '" value="' . $k . '" /><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                        }
                                        $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $radio.$required_span .'</div>';
                                        break;
                                    
                                    case 'checkbox':
                                        $checkbox = '';
                                        foreach ($value['choice']['vi'] as $k => $val) {
                                           $checkbox .= '<input type="checkbox" name="' . $key . '[]" value="' . $k . '" /><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                        }
                                        $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $checkbox.$required_span .'</div>';
                                        break;
                                    
                                    case 'select':
                                        $select = '<option value="">Click để chọn</option>';
                                        foreach ($value['choice']['vi'] as $k => $val) {
                                            $select .= '<option value="' . $k . '">' . $val . '</option>';
                                        }
                                        if($key == 'parent_id_shared'){
                                            $select = '<option value="">Click để chọn</option>';
                                            build_new_category($post_category,0,'',$select);
                                        }
                                        $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<select name="' .$key.(isset($value['check_multiple']) ? '[]' : ''). '" class="form-control" ' . (isset($value['check_multiple']) ? 'multiple' : '') . '>' . $select . '</select>' .$required_span. '</div>';
                                        break;
                                    
                                    case 'date':
                                        $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" name="' . $key . '" placeholder="' .  $value['description'] . '" id="realDPX-min" type="text"></div>' .$required_span. '</div>';
                                        break;
                                    case 'file':
                                        $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<input type="' . $value['type'] .'" name="' . $key.(isset($value['check_multiple']) ? '[]' : ''). '" class="form-control" placeholder="' .  $value['description'] . '"  ' . (isset($value['check_multiple']) ? 'multiple' : '') . '/>' .$required_span. '</div>';
                                        break;
                                    default:
                                        $a_language .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title']['vi'] . '</label><input type="' . $value['type'] .'" name="' . $key . '" class="form-control" placeholder="' .  $value['description'] . '" ' . (($key == 'slug_shared') ? 'readonly' : '') . '/>' .$required_span. '</div>';
                                        break;
                                }
                            }else{
                                foreach ($page_languages as $k => $vals){
                                    switch ($value['type']) {
                                        case 'textarea':
                                            $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br><textarea name="' . $key.'_'.$k . '" value="" class="col-xs-12 ' . (isset($value['check_multiple']) ? 'tinymce-area' : '') . '" rows="5"></textarea>' .$required_span. '</div>';
                                            break;
                                        
                                        case 'radio':
                                            $radio = '';
                                            foreach ($value['choice'] as $ks => $val) {
                                               $radio .= '<input type="radio" name="' . $key.'_'.$k . '" value="' . $k . '" /><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                            }
                                            $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $radio.$required_span .'</div>';
                                            break;
                                        
                                        case 'checkbox':
                                            $checkbox = '';
                                            foreach ($value['choice'] as $ks => $val) {
                                               $checkbox .= '<input type="checkbox" name="' . $key.'_'.$k . '" value="' . $k . '" /><span style="margin-right:10px;padding-left:5px;">' . $val . '</span>';
                                            }
                                            $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '</br>' . $checkbox.$required_span .'</div>';
                                            break;
                                        
                                        case 'select':
                                            $select = '';
                                            foreach ($value['choice'] as $ks => $val) {
                                                $select .= '<option value="' . $k . '">' . $val . '</option>';
                                            }
                                            $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<select name="' . $key.'_'.$k . '" class="form-control" ' . (isset($value['check_multiple']) ? 'multiple' : '') . '>' . $select . '</select>' .$required_span. '</div>';
                                            break;
                                        
                                        case 'date':
                                            $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" name="' . $key.'_'.$k . '" placeholder="' .  $value['description'] . '" id="realDPX-min" type="text"></div>' .$required_span. '</div>';
                                            break;
                                        case 'file':
                                            $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label>' . ($value['description'] ? ' (<i>' .  $value['description'] . '</i>)' : '') . '<input type="' . $value['type'] .'" name="' . $key.'_'.$k . '" class="form-control" placeholder="' .  $value['description'] . '"  ' . (isset($value['check_multiple']) ? 'multiple' : '') . '/>' .$required_span. '</div>';
                                            break;
                                        default:
                                            $by_slug = '';
                                            if($k == 'vi' && $key == 'title'){
                                                $by_slug = 'onchange="title_change(this)"';
                                            }
                                            $multiple_language[$k] .= '<div class="form-group col-xs-12 ' .$required. '" ><label for="' . $value['type'] . '">' . $value['title'][$k] . '</label><input type="' . $value['type'] .'" '. $by_slug .' name="' . $key.'_'.$k . '" class="form-control" placeholder="' .  $value['description'] . '" ' . (($key == 'slug_shared') ? 'readonly' : '') . '/>' .$required_span. '</div>';
                                            break;
                                    }
                                }
                            }
                        }
                    ?>
                    <?php echo $a_language; ?>
                    <div class="col-xs-12 form-group">
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <?php $i = 0; ?>
                            <?php foreach ($page_languages as $k => $val): ?>
                                <?php $activated = ($i == 0) ? 'active' : ''; ?>
                                <li role="presentation" class="<?php echo $activated ?>">
                                    <a href="#<?php echo $k ?>" aria-controls="<?php echo $k ?>" role="tab" data-toggle="tab">
                                        <span class="badge"><?php echo ($i + 1); ?></span><?php echo $val;?>
                                    </a>
                                </li>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <?php foreach ($page_languages as $k => $val): ?>
                            <div role="tabpanel" class="tab-pane <?php echo ($i == count($page_languages))? 'active' : '' ?>" id="<?php echo $k ?>">
                                <?php echo $multiple_language[$k];?>
                            </div>
                            <?php $i--; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php echo form_close(); ?>
                    <span onclick="submit_shared(this)" id="submid" class="btn btn-default" id="submit_shared" data-dismiss="modal" >Xác nhận</span>
                </div>
            </div>
        </div>
    </div>
</section>





<script src="<?php echo site_url('assets/lib/') ?>DatePickerX/DatePickerX.min.js"></script>
<script src="<?php echo site_url('assets/js/admin/') ?>post.js"></script>
<!-- <script type="text/javascript">
    switch(window.location.origin){
        case 'http://diamondtour.vn':
            var HOSTNAME = 'http://diamondtour.vn/';
            break;
        default:
            var HOSTNAME = 'http://localhost/weddingdress/';
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

    function submit_shared(ev){
        let [html, count, id_parent] = ['', 0, ''];
        for (var i = 0; i < document.querySelectorAll('div.form-group.required').length; i++) {
            let type = document.querySelectorAll('div.form-group.required')[i].firstChild.getAttribute('for');
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
                    document.querySelectorAll('div.form-group.required')[i].querySelector('select').setAttribute('onchange',`check_validate(this,'${type}')`);
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
            let [type, tag] = [document.querySelectorAll('div.form-group.has-error')[0].firstChild.getAttribute('for'), ''];
            if(type == 'radio' || type == 'checkbox' || type == 'date' || type == 'text'){
                tag = 'input';
            }else{
                tag = type;
            }
            if(document.querySelectorAll('.form-horizontal .has-error')[0].parentElement.tagName != 'FORM'){
                id_parent = document.querySelectorAll('.form-horizontal .has-error')[0].closest('[class^="tab-pane"]').id;
                document.querySelector(`.form-horizontal .nav.nav-justified li.active a`).setAttribute("aria-expanded","false");
                document.querySelector(`.form-horizontal .nav.nav-justified li.active`).classList.remove("active");
                document.querySelector(`.form-horizontal .tab-content .tab-pane.active`).setAttribute("class","tab-pane fade");
                document.querySelector(`.form-horizontal .has-error`).closest('[class^="tab-pane"]').setAttribute("class","tab-pane fade active in");
                document.querySelector(`.form-horizontal a[href="#${id_parent}"]`).setAttribute("aria-expanded","true");
                document.querySelector(`.form-horizontal a[href="#${id_parent}"]`).parentElement.classList.add("active");
                document.querySelectorAll(`.form-horizontal .has-error ${tag}`)[0].focus();
            }else{
                document.querySelectorAll(`.form-horizontal .has-error ${tag}`)[0].focus();
            }
            return false;
        }else{
            let data = new FormData(document.querySelector('form.form-horizontal'));
            data.append('csrf_sitecom_token', document.getElementById('csrf_sitecom_token').value);
            for (var i = 0; i < document.querySelectorAll('textarea.tinymce-area').length; i++) {
                data.append(document.querySelectorAll('textarea.tinymce-area')[i].id, tinymce.get(document.querySelectorAll('textarea.tinymce-area')[i].id).getContent({format:'html'}));
            }
            var url = window.location.href;
            fetch(url,{method: "POST",body: data}
            ).then(
                response => response.json()
            ).then(
                html => {
                    if(html.status == "200"){
                        alert(html.message);
                        if(window.location.pathname.indexOf("/post/edit/") != '-1'){
                            document.getElementById('csrf_sitecom_token').value = html.reponse.csrf_hash;
                        }else{
                            window.location.href=HOSTNAME+"admin/post";
                        }
                    }else{
                        alert(html.message);
                        location.reload();
                    }
                }

            );
        }

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
            value = (ev.querySelector(type).value) ? true : false;
        }
        if(value){
            ev.closest('.required').classList.add("has-error");
            ev.closest('.required').querySelector('span.help-block').classList.remove("hidden");
        }else{
            ev.closest('.required').querySelector('span.help-block').classList.add("hidden");
            ev.closest('.required').classList.remove("has-error");
        }
    }
</script> -->

<?php 
    function build_new_category($categorie, $parent_id = 0, $char = '', &$result=''){
        $cate_child = array();
        foreach ($categorie as $key => $item){
            if ($item['parent_id'] == $parent_id){
                $cate_child[] = $item;
                unset($categorie[$key]);
            }
        }
        if ($cate_child){
            foreach ($cate_child as $key => $value){
            
            $result .= '<option value="' .$value['id']. '" >' .$char.$value['title']. '</option>';
            build_new_category($categorie, $value['id'], $char.'---|',$result) ?>
            <?php
            }
        }
    }
?>