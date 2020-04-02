<?php

class Product extends CI_Controller {

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "product_v";

        $this->load->model("product_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        /**Tablodan Verilerin Getirilmesi.. */
        $items = $this->product_model->get_all();

        /**View'e gönderilecek değişkenlerin set edilmesi..*/
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form()
    {
        $viewData = new stdClass();
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save()
    {
        $this->load->library("form_validation");

        //kurallar yazılır..
        $this->form_validation->set_rules("title","Başlık","required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<b> {field} </b> alanı doldurulmalıdır"
            )
        );

        //Form validation çalıştırılır
        //TRUE - FALSE
        $validate = $this->form_validation->run();

        if($validate){

            $insert = $this->product_model->add(
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => convertToCEO($this->input->post("title")),
                    "rank"          => 0,
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s")
                )
            );

            //TODO Alert sistemi eklenecek...
            if($insert){

                redirect(base_url("product"));

            } else {

                echo "İşlem başarısızdır...";

            }

        } else {

            $viewData = new stdClass();
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->form_error = true;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }
        //başarılı ise kayıt işlemi başlatılır
        //
        //başarısız ise hata ekranda gösterilir
        //
        //
        
    }

    public function update_form($id)
    {
        $viewData = new stdClass();

        /**Tablodan Verilerin Getirilmesi.. */
        $item = $this->product_model->get(
            array(
                "id"        => $id
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

}