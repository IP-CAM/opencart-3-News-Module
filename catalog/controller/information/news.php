<?php
class ControllerNewsNews extends Controller
{

    public function index()
    {

        $this->load->language('information/news');

        $this->load->model('catalog/news');



        //creer un array ds un array
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('information/news')
        );

        //appelle la fonction getAllNews du model
        //model catalog new il appelle ModelCatalogNews du model
        $all_news = $this->model_catalog_news->getAllNews();

        $data['all_news'] = array();
        foreach ($all_news as $news) {
            $data['all_news'][] = array(
                'title' => $news['title'],
                'news' => $news['news'],
                'author' => $news['author'],
                'view' => $this->url->link('information/news/news', 'id_new=' . $news['id_new'])

            );
        }

        $this->document->SetTitle($this->language->get('text_title'));

        $data['heading_title'] = $this->language->get('text_title');
        $data['title'] = $this->language->get('text_title');
        $data['text_news'] = $this->language->get('text_news');
        $data['text_author'] = $this->language->get('text_author');
        $data['text_view'] = $this->language->get('view');


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');



        // print_r($data['all_news']);
        // echo "<br><br>";
        // print_r($data);


        $this->response->setOutput($this->load->view('information/news_list', $data));
    }



    public function news()
    {
        $this->load->model('catalog/news');

        $this->language->load('information/news');

        if (isset($this->request->get['id_new']) && !empty($this->request->get['id_new'])) {
            $id_new = $this->request->get['id_new'];
        } else {
            //error
            // $id_new = 0;
        }

        $news = $this->model_catalog_news->getNews($id_new);

        // print_r($news);




        //creer un array ds un array
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('information/news')
        );

        if ($news) {
            $data['breadcrumbs'][] = array(
                'text' => $news['title'],
                'href' => $this->url->link('information/news/news', 'id_new' . $news['id_new'])
            );
        }

        $this->document->SetTitle($news['title']);

        $data['heading_title'] = $news['title'];
        $data['title'] = $news['title'];
        $data['text_news'] = $news['news'];
        $data['text_author'] = $news['author'];
        $data['text_view'] = $news['date'];


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');


        $this->response->setOutput($this->load->view('news/news', $data));
    }
}
