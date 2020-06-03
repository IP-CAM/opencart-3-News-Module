<?php
//www\opencart\catalog\controller\information\news.php
class ControllerInformationNews extends Controller
{

    public function index()
    {
        $this->language->load('information/news');
        $this->load->model('catalog/news');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('common/home')
        );

        $all_news = $this->model_catalog_news->getAllNews();

        $data['all_news'] = array();
        foreach ($all_news as $news) {
            //array dans un array
            $data['all_news'][] = array(
                'title' => $news['title'],
                'author' => $news['author'],
                'news' => $news['news'],
                'view' => $this->url->link('information/news/news', 'id_new=' . $news['id_new'])
            );
        }

        $this->document->setTitle($this->language->get('heading_title'));

        $data['text_link'] = $this->language->get('text_link');
        $data['heading_title'] = $this->language->get('heading_title');
        $data['title'] = $this->language->get('text_title');
        $data['text_description'] = $this->language->get('text_title');
        $data['text_view'] = $this->language->get('text_view');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('information/news_list', $data));
    }

    public function news()
    {
        $this->load->language('information/news');
        $this->load->model('catalog/news');

        if (isset($this->request->get['id_new']) && !empty($this->request->get['id_new'])) {
            $id_new = $this->request->get['id_new'];
        } else {
            $id_new = 0;
        }

        $news = $this->model_catalog_news->getNews($id_new);

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
                'href' => $this->url->link('information/news/news', 'id_new=' . $news['id_new'])
            );
        }

        $this->document->setTitle($news['title']);

        $data['text_author'] = $this->language->get('text_author');


        $data['heading_title'] = $news['title'];
        $data['title'] = $news['title'];
        $data['author'] = $news['author'];
        $data['description'] = $news['news'];
        $data['date'] = $news['date_added'];


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('information/news', $data));


        // print_r($data['$all_news']);
        // echo "<br>";
        // print_r($data);

    }
}
