<?php
class ControllerNewsNews extends Controller {
	// private $error = array();

    public function index()
    {
        $this->session->data['user_token'];
        $this->language->load('news/news');
        $this->load->model('catalog/news');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard&user_token='.$this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('common/dashboard&user_token='.$this->session->data['user_token'])
        );

        $all_news = $this->model_catalog_news->getNews();


        $data['all_news'] = array();        
        $data['create'] = $this->url->link('news/news_create&user_token='.$this->session->data['user_token']);
        foreach ($all_news as $news) {
            //array dans un array
            $data['all_news'][] = array(
                'title' => $news['title'],
                'author' => $news['author'],
                'description' => $news['description'],
                'update' => $this->url->link('news/news_update', 'id_new=' . $news['id_new'].'&user_token='.$this->session->data['user_token']),
                'delete' => $this->url->link('news/news_delete', 'id_new=' . $news['id_new'].'&user_token='.$this->session->data['user_token']),
            );
        }

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');
        $data['title'] = $this->language->get('text_title');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_create'] = $this->language->get('text_create');
        $data['text_update'] = $this->language->get('text_update');
        $data['text_delete'] = $this->language->get('text_delete');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('news/news_create', $data));
    }

    public function create()
    {
        $this->session->data['user_token'];
        $this->language->load('news/news');
        $this->load->model('catalog/news');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard&user_token='.$this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('common/dashboard&user_token='.$this->session->data['user_token'])
        );

            $data['news'] = array();
            $data['news'][] = array(
                'title' => $this->request->get('title'),
                'author' => $this->request->get('author'),
                'description' => $this->request->get('description')
            );

        $data['addNews'] = $this->model_catalog_news->addNews($data['news']);


        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');
        $data['title'] = $this->language->get('text_title');
        $data['text_description'] = $this->language->get('text_description');
        $data['text_author'] = $this->language->get('text_author');
        $data['text_news_list'] = $this->language->get('text_news_list');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('news/news_add', $data));
    }

    public function store($data)
    {
        # code...
    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }
}