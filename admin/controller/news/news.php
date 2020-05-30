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
        $data['create'] = $this->url->link('news/news/create&user_token='.$this->session->data['user_token']);
        foreach ($all_news as $news) {
            //array dans un array
            $data['all_news'][] = array(
                'title' => $news['title'],
                'author' => $news['author'],
                'description' => $news['description'],
                'update' => $this->url->link('news/news/update', 'id_new=' . $news['id_new'].'&user_token='.$this->session->data['user_token']),
                'delete' => $this->url->link('news/news/delete', 'id_new=' . $news['id_new'].'&user_token='.$this->session->data['user_token']),
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

        $this->response->setOutput($this->load->view('news/news_list', $data));
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
            'href' => $this->url->link('news/news&user_token='.$this->session->data['user_token'])
        );


        $data['breadcrumbs'][] = array(
            'text' =>$this->language->get('text_create'),
            'href' => $this->url->link('news/news/create&user_token='.$this->session->data['user_token'])
        );

        $data['news_list'] = $this->url->link('news/news&user_token='.$this->session->data['user_token']);

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_title'] = $this->language->get('text_title');
        $data['text_news'] = $this->language->get('text_news');
        $data['text_author'] = $this->language->get('text_author');
        $data['text_news_list'] = $this->language->get('text_news_list');
        $data['text_submit'] = $this->language->get('text_submit');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('news/news_create', $data));

        if (isset($_POST['submit'])) {
            // var_dump($_POST);
            $this->model_catalog_news->addNew($_POST);
            $this->response->redirect($this->url->link('news/news', 'user_token=' . $this->session->data['user_token'])); 
        }
    }

    public function update()
    {
        $this->session->data['user_token'];
        $this->language->load('news/news');
        $this->load->model('catalog/news');

        if (isset($this->request->get['id_new']) && !empty($this->request->get['id_new'])) {
            $id_new = $this->request->get['id_new'];
        } else {
            // $id_new = 0;
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard&user_token='.$this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('news/news&user_token='.$this->session->data['user_token'])
        );

        $news = $this->model_catalog_news->getNew($id_new);
        if ($news) {
            $data['breadcrumbs'][] = array(
                'text' => $news['title'],
                'href' => $this->url->link('news/news/delete&user_token='.$this->session->data['user_token'])
            );
        }

        $data['news'] = array(
            'title' => $news['title'],
            'news' => $news['news'],
            'author' => $news['author'],
            );
    
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
            
        $this->response->setOutput($this->load->view('news/news_update', $data));

        if (isset($_POST['submit'])) {
            // var_dump($_POST);
            $this->model_catalog_news->editNew($news['id_new'] , $_POST);
            $this->response->redirect($this->url->link('news/news', 'user_token=' . $this->session->data['user_token'])); 
        }
    }
    
    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        $this->session->data['user_token'];
        $this->language->load('news/news');
        $this->load->model('catalog/news');

        
        if (isset($this->request->get['id_new']) && !empty($this->request->get['id_new'])) {
            $id_new = $this->request->get['id_new'];
        } else {
            $id_new = 0;
        }


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard&user_token='.$this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('news/news&user_token='.$this->session->data['user_token'])
        );

        $news = $this->model_catalog_news->getNew($id_new);
        if ($news) {
            $data['breadcrumbs'][] = array(
                'text' => $news['title'],
                'href' => $this->url->link('news/news/delete&user_token='.$this->session->data['user_token'])
            );
        }
      
        $data['news'] = array(
        'title' => $news['title'],
        'news' => $news['news'],
        'author' => $news['author'],
        );

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');


        $this->response->setOutput($this->load->view('news/news_delete', $data));

        if (isset($_POST['confirmation'])) {
            if ($_POST['confirmation'] === "oui"){
                $news = $this->model_catalog_news->deleteNew($id_new);
               }
            $this->response->redirect($this->url->link('news/news', 'user_token=' . $this->session->data['user_token'])); 
        }
    }
}