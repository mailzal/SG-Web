<?php
class News extends CI_Controller {

public function show($id) {
    $this->load->model('news_model');
    $news = $this->news_model->get_news($id);
    $this->load->view('news_article', $news);
}

}