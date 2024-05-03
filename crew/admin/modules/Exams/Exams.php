<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

class Exams extends CodonModule 
{
    public function HTMLHead()
    {
        $this->set('sidebar', 'exams/exams_sidebar.php');
    }
    public function NavBar()
    {
        echo '<li><a href="'.SITE_URL.'/admin/index.php/Exams">Exam Center Admin</a></li>';
    }

    public function index() {
        if(!ExamsData::check_admin(Auth::$userinfo->pilotid)) {
            $this->set('message', '<div id="error"><b>You must an EXAMCenter administrator to access this feature!</b></div><br />');
            $this->show('exams/frontpage_main');
            return;
        //header('Location: '.url('/'));
        }
        if($this->post->action == 'save_changes') {
            $this->save_changes();
        }
        if($this->post->action == 'save_changes_question') {
            $this->save_changes_question();
        }
        if($this->post->action == 'save_new_test') {
            $this->save_new_test();
        }
        if($this->post->action == 'save_new_question') {
            $this->save_new_question();
        }
        if($this->post->action == 'save_new_revision') {
            $this->save_new_revision();
        }
        if($this->post->action == 'save_revision_edit') {
            $this->save_revision_edit();
        }
        if($this->post->action == 'edit_setting') {
            $this->edit_setting();
        }
        if($this->post->action == 'save_edit_record') {
            $this->save_edit_record();
        }
        if($this->post->action == 'edit_admin_setting') {
            $this->edit_admin_setting();
        }
        else {
            $this->set('requests', ExamsData::get_exam_requests());
            $this->set('unapproved',ExamsData::get_exams_unapproved());
            $this->set('questions', ExamsData::get_questions_admin());
            $this->set('exams', ExamsData::get_exams_admin());
            $this->show('exams/exam_admin');
        }
    }

    public function check_admin_level() 
	{
        $id = Auth::$userinfo->pilotid;
        $admin = ExamsData::check_admin($id);
    }

    public function view_current_exams() 
	{
        $this->set('exams', ExamsData::get_exams_admin());
        $this->show('exams/exam_list_admin');
    }

    public function view_current_questions() 
	{
        $this->set('questions', ExamsData::get_questions_admin());
        $this->show('exams/exam_question_list');
    }

    public function edit_exam() 
	{
        $id = $_GET['id'];

        $this->set('num_questions', ExamsData::get_howmany_questions($id));
        $this->set('exam', ExamsData::get_exam_edit($id));
        $this->show('exams/exam_edit');
    }

    public function view_individual_pilot() 
	{
        $this->set('pilots', PilotData::GetAllPilots(''));
        $this->show('exams/exam_view_pilot_list');
    }

    public function view_pilot() 
	{
        $id = $_GET['id'];

        $this->set('pilotdata', ExamsData::get_pilot_data($id));
        $this->show('exams/exam_view_pilot');
    }

    public function edit_pilot_record() 
	{
        $id = $_GET['id'];

        $this->set('record', ExamsData::get_pilot_record($id));
        $this->show('exams/exam_edit_pilot_record');
    }

    protected function save_edit_record() 
	{
        $id = DB::escape($this->post->id);
        $approved = DB::escape($this->post->approved);
        $pilot_id = DB::escape($this->post->pilot_id);

        ExamsData::edit_pilot_record($id, $approved);

        $this->set('message', '<div id="success">Pilot Exam Record Changes Saved!</div><br />');


        //Template::Set('pilotdata', ExamsData::get_pilot_data($pilot_id));
        //Template::Show('exam_view_pilot.tpl');
    }

    protected function save_changes() 
	{
        $description = DB::escape($this->post->description);
        $cost = DB::escape($this->post->cost);
        $exam_id = DB::escape($this->post->exam_id);
        $active = DB::escape($this->post->active);
        $current = DB::escape($this->post->current);
        $passing = DB::escape($this->post->passing);
        $reason = DB::escape($this->post->reason);
        if ($current == 0 && $active == 1) {
            $this->set('message', '<div id="error">You must add at least one question before activating an exam!</div><br />');
            return;
        }
        else {
            ExamsData::add_exam_revision($exam_id, Auth::$userinfo->pilotid, $reason);
            ExamsData::increase_exam_changed_date($exam_id);
            ExamsData::increase_exam_version($exam_id);
            ExamsData::edit_exam($active, $exam_id, $description, $passing, $cost/*, $version*/);
            $this->set('message', '<div id="success">Exam Changes Saved!</div><br />');
        }
    }

     public function delete_pilot_record() 
	 {
        $id = $_GET['id'];
        $pilot_id = $_GET['pilot_id'];
        ExamsData::delete_pilot_record($id);

        $this->set('pilotdata', ExamsData::get_pilot_data($pilot_id));
        $this->show('exams/exam_view_pilot');
    }

    public function see_exam_revisions() 
	{
        $id = $_GET['id'];

        $this->set('exam_id', ($id));
        $this->set('revisions', ExamsData::get_exam_revisions($id));
        $this->show('exams/exam_revisions');
    }

    public function edit_questions() 
	{
        $id = $_GET['id'];
        $questions = ExamsData::get_exam($id);
        $this->set('title', ExamsData::get_exam_title($id));
        $this->set('questions', $questions);
        $this->show('exams/exam_question_edit_list');
    }

    public function edit_question() 
	{
        $id = $_GET['id'];
        $this->set('question', ExamsData::get_question($id));
        $this->show('exams/exam_question_edit_form');
    }

    protected function save_changes_question() 
	{
        $id = DB::escape($this->post->id);
        $question = DB::escape($this->post->question);
        $answer_1 = DB::escape($this->post->answer_1);
        $answer_2 = DB::escape($this->post->answer_2);
        $answer_3 = DB::escape($this->post->answer_3);
        $answer_4 = DB::escape($this->post->answer_4);
        $correct_answer = DB::escape($this->post->correct_answer);
        $active = DB::escape($this->post->active);
        $new_exam = DB::escape($this->post->new_exam);

        ExamsData::edit_question($id, $question, $answer_1, $answer_2, $answer_3, $answer_4, $correct_answer, $active, $new_exam);
        ExamsData::increase_exam_version($new_exam);
        ExamsData::increase_exam_changed_date($new_exam);
        $this->set('message', '<div id="success">Question Updated!</div>');
    }

    public function new_test_form() 
	{
        $this->show('exams/exam_new_test_form');
    }

    protected function save_new_test() 
	{
        $exam_description = DB::escape($this->post->exam_description);
        $cost = DB::escape($this->post->cost);
        $passing = DB::escape($this->post->passing);

        ExamsData::create_new_test($exam_description, $cost, $passing);
        //ExamsData::add_exam_revision($exam_id, $revised_by, $revision);
        $this->set('message', '<div id="success">New Test Added!</div>');
    }

    public function new_question_form() 
	{
        $this->set('exams', ExamsData::get_exams_admin());
        $this->show('exams/exam_new_question_form');
    }

    protected function save_new_question() 
	{
        $exam_id = DB::escape($this->post->exam_id);
        $question = DB::escape($this->post->question);
        $answer_1 = DB::escape($this->post->answer_1);
        $answer_2 = DB::escape($this->post->answer_2);
        $answer_3 = DB::escape($this->post->answer_3);
        $answer_4 = DB::escape($this->post->answer_4);
        $correct_answer = DB::escape($this->post->correct_answer);
        $active = DB::escape($this->post->active);

        ExamsData::create_new_question($exam_id, $question, $answer_1, $answer_2, $answer_3, $answer_4, $correct_answer, $active);

        $this->set('message', '<div id="success">New Question Added!</div>');
        $this->set('questions', ExamsData::get_questions_admin());
        $this->set('exams', ExamsData::get_exams_admin());
        $this->show('exams/exam_admin');
    }

    public function new_revision_form() 
	{
        $this->show('exams/exam_new_revision_form');
    }

    protected function save_new_revision() 
	{
        $revision = DB::escape($this->post->revision);

        ExamsData::save_new_revision($revision);

        $this->set('message', '<div id="success">New Revision Reason Added!</div>');
        $this->set('questions', ExamsData::get_questions_admin());
        $this->set('exams', ExamsData::get_exams_admin());
        $this->show('exams/exam_admin');
    }

    public function view_revision_reasons() 
	{
        $this->set('reasons', ExamsData::get_revision_reasons());
        $this->show('exams/exam_revision_list');
    }

    public function edit_reason() 
	{
        $id = $_GET['id'];

        $this->set('reason', ExamsData::get_revision($id));
        $this->show('exams/exam_revision_edit');
    }

    public function get_setting_info() 
	{
        $id = $_GET['id'];

        $this->set('setting', ExamsData::get_setting_info($id));
        $this->show('exams/exam_edit_setting');
    }

    protected function edit_setting() 
	{
        $id = DB::escape($this->post->id);
        $value = DB::escape($this->post->value);

        ExamsData::edit_setting_value($id, $value);

        $this->set('message', '<div id="success">Setting Updated</div>');
    }

    protected function save_revision_edit() 
	{
        $id = DB::escape($this->post->id);
        $revision = DB::escape($this->post->revision);
        $active = DB::escape($this->post->active);

        ExamsData::edit_revision($id, $revision, $active);

        $this->set('message', '<div id="success">Revision Reason Updated!</div>');
        $this->set('reasons', ExamsData::get_revision_reasons());
        $this->show('exams/exam_revision_list');
    }

    public function save_approve_result() 
	{
        $id = $_GET['id'];
        $approve = $_GET['approve'];

        ExamsData::approve_result($id, $approve);

        if ($approve == 1) {$message = '<div id="success">Exam Approved!</div>';}
        else {$message = '<div id="error">Exam Disapproved!</div>';}

        $this->set('message', $message);
        $this->set('unapproved',ExamsData::get_exams_unapproved());
        $this->show('exams/exam_admin');
    }

    public function assign_exams_pilotlist() 
	{
        $id = $_GET['id'];

        $this->set('pilot', PilotData::GetPilotData($id));
        $this->set('exams', ExamsData::get_exams());
        $this->set('assigned', ExamsData::get_assigned_exams($id));
        $this->show('exams/exam_assign_list');
    }

    public function assign_exam() 
	{
        $pilot_id = $_GET['pilot_id'];
        $exam_id = $_GET['exam_id'];

        ExamsData::assign_exam($pilot_id, $exam_id);

        $this->set('pilot', PilotData::GetPilotData($pilot_id));
        $this->set('exams', ExamsData::get_exams());
        $this->set('assigned', ExamsData::get_assigned_exams($pilot_id));
        $this->show('exams/exam_assign_list');
    }

    public function assign_exam_admin() 
	{
        $pilot_id = $_GET['pilot_id'];
        $exam_id = $_GET['id'];

        ExamsData::assign_exam($pilot_id, $exam_id);
        ExamsData::unrequest_exam($pilot_id, $exam_id);
        $this->set('requests', ExamsData::get_exam_requests());
        $this->set('unapproved',ExamsData::get_exams_unapproved());
        $this->set('questions', ExamsData::get_questions_admin());
        $this->set('exams', ExamsData::get_exams_admin());
        $this->show('exams/exam_admin');
    }

    public function unassign_exam() 
	{
        $pilot_id = $_GET['pilot_id'];
        $exam_id = $_GET['exam_id'];

        ExamsData::unassign_exam($pilot_id, $exam_id);

        $this->set('pilot', PilotData::GetPilotData($pilot_id));
        $this->set('exams', ExamsData::get_exams());
        $this->set('assigned', ExamsData::get_assigned_exams($pilot_id));
        $this->show('exams/exam_assign_list');
    }

    public function edit_admin_list()
	{
       $this->set('pilots', PilotData::GetAllPilots());
       $this->show('exams/exam_assign_admin');
    }

    public function edit_admin()
	{
        $id = $_GET['id'];
        $this->set('pilot_id', $id);
        $this->set('pilot', ExamsData::get_admin_data($id));
        $this->show('exams/exam_edit_admin');
    }

    protected function edit_admin_setting() 
	{
        $pilot_id = DB::escape($this->post->pilot_id);
        $admin_level = DB::escape($this->post->admin_level);
        $cur_level = DB::escape($this->post->cur_level);
        if ($cur_level == $admin_level)
            {
                $this->set('pilots', PilotData::GetAllPilots());
                $this->show('exams/exam_assign_admin');
            }
        elseif ($cur_level == '0')
            {
                ExamsData::add_admin($pilot_id, $admin_level);
                $this->set('message', '<div id="success">Pilot Administrator Status Changed.</div>');
                $this->set('pilots', PilotData::GetAllPilots());
                $this->show('exams/exam_assign_admin');
            }
        elseif ($admin_level == '0')
            {
                ExamsData::delete_admin($pilot_id);
                $this->set('message', '<div id="success">Pilot Administrator Status Changed.</div>');
                $this->set('pilots', PilotData::GetAllPilots());
                $this->show('exams/exam_assign_admin');
            }
        else
            {
                ExamsData::edit_admin($pilot_id, $admin_level);
                $this->set('message', '<div id="success">Pilot Administrator Status Changed.</div>');
                $this->set('pilots', PilotData::GetAllPilots());
                $this->show('exams/exam_assign_admin');

            }
    }
}