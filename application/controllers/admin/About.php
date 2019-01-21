<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Admin_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->render('admin/about/overview_view');
    }

    //DESCRIPTION PART
    public function description(){
        $this->render('admin/about/description/list_description_view');
    }

    public function creatDescription(){
        $this->render('admin/about/description/creat_description_view');
    }

    public function editDescription(){
        $this->render('admin/about/description/edit_description_view');
    }

    //END DESCRIPTION PART

    //SERVICES PART
    public function services(){
        $this->render('admin/about/services/list_services_view');
    }

    public function creatServices(){
        $this->render('admin/about/services/creat_services_view');
    }

    public function editServices(){
        $this->render('admin/about/services/edit_services_view');
    }

    //END SERVICES PART

    //TEAM PART
    public function team(){
        $this->render('admin/about/team/list_team_view');
    }

    public function creatTeam(){
        $this->render('admin/about/team/creat_team_view');
    }

    public function editTeam(){
        $this->render('admin/about/team/edit_team_view');
    }

    //END TEAM PART

    //TESTINOMIALS PART
    public function testinomials(){
        $this->render('admin/about/testinomials/list_testinomials_view');
    }

    public function creatTestinomials(){
        $this->render('admin/about/testinomials/creat_testinomials_view');
    }

    public function editTestinomials(){
        $this->render('admin/about/testinomials/edit_testinomials_view');
    }

    //END TESTINOMIALS PART

}