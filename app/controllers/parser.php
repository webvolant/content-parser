<?php
include 'simple_html_dom.php';
ini_set('error_reporting', 0);
ini_set('allow_url_fopen','1');

function request($url,$post = 0){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url ); // отправляем на
    curl_setopt($ch, CURLOPT_HEADER, 0); // пустые заголовки
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // возвратить то что вернул сервер
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // следовать за редиректами
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);// таймаут4
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt'); // сохранять куки в файл
    curl_setopt($ch, CURLOPT_COOKIEFILE,  dirname(__FILE__).'/cookie.txt');
    curl_setopt($ch, CURLOPT_POST, $post!==0 ); // использовать данные в post
    if($post)
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


class parser{
    public $cacheurl = array();
    public $result = array();
    public $_allcount = 50;
    public $urls = array();
    public $extensions = array('png', 'jpg', 'jpeg', 'xlsx', 'xls', 'doc', 'docx', 'pdf', 'csv');

    public function __construct($url,$exps){
        $this->parse($url,$exps);
    }

    public function parse($url,$exps){
        $url = $this->readUrl($url);
        $ext = preg_replace("/.*?\./", '' ,$url); //взял расширение , и ниже посмотрел в массиве.

        if (in_array($ext, array('png', 'jpg', 'jpeg', 'xlsx', 'xls', 'doc', 'docx', 'pdf', 'csv')))
            return false;

        //echo '<h2>'.preg_match('/\/$/',$url).'</h2>';
        //foreach($this->cacheurl as $item)
        //    echo $item.'<br/>';
        //var_dump($this->cacheurl);
        //die();
        if (count($exps) != 0)
        foreach ($exps as $exp)
            if($exp['address'] && preg_match('/\/'.$exp['address'].'/',$url)==1) // links with /forum
                return false;


        if(
            preg_match('/\/#$/',$url)==1 or // links with /#
            preg_match('/\/$/',$url)==1 or // links with /
            !$url or
            $this->cacheurl[$url]
            )
            return false;


        $this->_allcount--;

        if( $this->_allcount<=0 )
            return false;

        $this->cacheurl[$url] = true;
        $item = array();

        $data = str_get_html(request($url));
        if(is_object($data)){
            $item['url'] = $url;
            $item['title'] = $data->find('title',0)?$data->find('title',0)->plaintext:''; //count ????? зачем то делал не помню.
            $item['text'] = $data->find('body',0)?strip_tags(preg_replace('/\s{2,}/iu','',strip_tags($data->find('body',0)->plaintext))) : '';
            $item['count_words'] = $data->find('body',0)?$this->countWords($data->find('body',0)->plaintext) : '';
            //plaintext
            //innertext
            //outertext
            $this->result[] = $item;

            if(count($data->find('a'))){
                foreach($data->find('a') as $a){
                    $this->parse($a->href,$exps);
                }
            }
            //$data->clear();
            //unset($data);
        }
    }


    public $protocol = '';
    public $host = '';
    public $path = '';

    public function readUrl($url){
        $urldata = parse_url($url);

        if( isset($urldata['host']) ){
            if($this->host and $this->host!=$urldata['host'])
                return false;

            $this->protocol = $urldata['scheme'];
            //var_dump($this->protocol);
            $this->host = $urldata['host'];
            //var_dump($this->host);
            //die();
            $this->path = $urldata['path'];
            //if (!$this->path)
            //   $this->path = "/";
            return $url;
        }

        if( preg_match('#^/#',$url) ){
            $this->path = $urldata['path'];
            return $this->protocol.'://'.$this->host.$url;
        }else{
            if(preg_match('#/$#',$this->path))
                return $this->protocol.'://'.$this->host.$this->path.$url;
            else{
                if( strrpos($this->path,'/')!==false ){
                    return $this->protocol.'://'.$this->host.substr($this->path,0,strrpos($this->path,'/')+1).$url;
                }else
                    return $this->protocol.'://'.$this->host.'/'.$url;
            }
        }
    }

    public function countWords($text){
        if (!isset($text))
            return false;

        return str_word_count($text,0,"АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя");
    }
}