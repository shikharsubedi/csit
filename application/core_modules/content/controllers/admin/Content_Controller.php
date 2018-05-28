<?php

use content\events\ContentFormPostEvent;
use content\events\ContentFormReadyEvent;
use content\models\ContentMeta;
use content\models\Content,
    content\models\Tabs,
    content\models\Term,
    content\models\Taxonomy,
    Doctrine\Common\Util\Debug;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content_Controller extends Admin_Controller {

    public function __construct() {
        $this->mainmenu = MAINMENU_CONTENT;

        parent::__construct();
        //check for permissions
        if (!user_access('administer content'))
            admin_redirect();
        $this->load->library('ThumbLib');

        $this->breadcrumb->append_crumb('Content', admin_url('content'));
    }

    public function index($offset = 0, $type = NULL) {
        $repo = $this->doctrine->em->getRepository('content\models\Content');

        $filters = array();
        if (!is_null($type))
            $filters['type'] = $type;

        if ($this->input->post()) {
            /* Apply flters */
            if ($this->input->post('filter')) {
                if ($this->input->post('published') != '')
                    $filters['status'] = $this->input->post('published');

                if ($this->input->post('type') != '')
                    $filters['type'] = $this->input->post('type');
            }

            /* search content */
            if ($this->input->post('search')) {
                $search = $this->input->post('search-key');

                $filters['search'] = $search;
            }

            /* Apply Action */
            if ($this->input->post('act-content')) {
                $checked = $this->input->post('check');

                $action = $this->input->post('action');

                switch ($action) {
                    case "publish":
                        //publish selected contents
                        foreach ($checked as $k => $v) {
                            //$data = array(	'published'	=>	'Y');
                            //$this->content->update($data,$v);

                            $content = & $this->doctrine->em->find('content\models\Content', $v);
                            $content->publish();
                            $this->doctrine->em->persist($content);
                        }
                        break;

                    case "unpublish":
                        //unpublish selected contents
                        foreach ($checked as $k => $v) {
                            //$data = array(	'published'	=>	'N');
                            //$this->content->update($data,$v);
                            $content = & $this->doctrine->em->find('content\models\Content', $v);
                            $content->unPublish();
                            $this->doctrine->em->persist($content);
                        }
                        break;

                    case "sticky":
                        foreach ($checked as $k => $v) {
                            $content = & $this->doctrine->em->find('content\models\Content', $v);
                            $content->mkSticky();
                            $this->doctrine->em->persist($content);
                        }
                        break;

                    case "unsticky":
                        foreach ($checked as $k => $v) {
                            $content = & $this->doctrine->em->find('content\models\Content', $v);
                            $content->remSticky();
                            $this->doctrine->em->persist($content);
                        }
                        break;

                    default:
                        //delete
                        foreach ($checked as $k => $v) {
                            //$this->db->where('id',$v);
                            //$this->db->delete('content');
                            $content = & $this->doctrine->em->find('content\models\Content', $v);
                            $this->doctrine->em->remove($content);
                        }
                }

                $this->doctrine->em->flush();
                $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected content.');
                admin_redirect('content');
            }
        }

        /* if ($this->input->post('saveorder')) {
          //show_pre($this->input->post('order')); exit;
          $ord = explode('&',$this->input->post('order'));
          $index=1; // 0 reserved for default
          foreach ($ord as $o) {
          $content = &$this->doctrine->em->find('content\models\Content',$o);

          $content->setOrder($index);
          echo $content->getTitle().' = '.$index.'<br/>';
          $this->doctrine->em->persist($content);
          $index = $index+1;

          }

          $this->doctrine->em->flush();
          $this->session->set_success_flashdata('feedback', 'Content order sorted successfully.');
          admin_redirect('content');
          } */

        $per_page = 20;
        $contents = & $repo->getContents($offset, $per_page, $filters);
        $numContent = $contents['total'];

        if ($numContent > $per_page) {
            $this->load->library('pagination');

            $config['base_url'] = admin_base_url() . "content/index";
            $config['total_rows'] = $numContent;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 4;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';

            $this->pagination->initialize($config);
            $pg = $this->pagination->create_links();
            $this->templatedata['pagination'] = $pg;
        }


        $content_types = array("page", "article");

        $custom_content_types = _t('custom_content_types');

        if ($custom_content_types) {
            $content_types = array_merge($content_types, $custom_content_types);
        }

        $this->templatedata['content_types'] = $content_types;
        $this->templatedata['content'] = $contents['contents'];
        $this->templatedata['maincontent'] = 'content/admin/list';

        $this->load->view('admin/master', $this->templatedata);
    }

    public function cat($cat_id, $offset = 0) {

        $repo = &$this->doctrine->em->getRepository('content\models\Content');
        $slug = $repo->catDetails($cat_id);
        $slug = $slug['slug'];


        if ($this->input->post('update')) {

            $checked = $this->input->post('check');
            $action = $this->input->post('action');

            switch ($action) {

                case "publish":
                    foreach ($checked as $k => $v) {
                        $content = & $this->doctrine->em->find('content\models\Content', $v);
                        $content->publish();
                        $this->doctrine->em->persist($content);
                    }
                    break;

                case "unpublish":
                    foreach ($checked as $k => $v) {
                        $content = & $this->doctrine->em->find('content\models\Content', $v);
                        $content->unPublish();
                        $this->doctrine->em->persist($content);
                    }
                    break;

                case "sticky":
                    foreach ($checked as $k => $v) {
                        $content = & $this->doctrine->em->find('content\models\Content', $v);
                        $content->mkSticky();
                        $this->doctrine->em->persist($content);
                    }
                    break;

                case "unsticky":
                    foreach ($checked as $k => $v) {
                        $content = & $this->doctrine->em->find('content\models\Content', $v);
                        $content->remSticky();
                        $this->doctrine->em->persist($content);
                    }
                    break;

                case "delete":
                    foreach ($checked as $k => $v) {
                        $content = & $this->doctrine->em->find('content\models\Content', $v);

                        $this->doctrine->em->remove($content);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected content.');
            admin_redirect($_SERVER['HTTP_REFERER']);
        }


        if ($this->input->post('saveorder')) {
            //show_pre($this->input->post('order')); exit;
            $ord = explode('&', $this->input->post('order'));
            $index = 1; // 0 reserved for default
            foreach ($ord as $o) {
                $content = &$this->doctrine->em->find('content\models\Content', $o);

                $content->setOrder($index);
                //echo $content->getTitle().' = '.$index.'<br/>';
                $this->doctrine->em->persist($content);
                $index = $index + 1;
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Content order sorted successfully.');
            admin_redirect('content/category');
        }

        $perpage = 100000;
        $contentRepo = &$this->doctrine->em->getRepository('content\models\Content');
        $contents = $contentRepo->findContentByCategorySlug($slug, $perpage, $offset, $activeOnly = false);


        if ($contents) {
            $numContent = $contents['total'];
            if ($numContent > $perpage) {
                $this->load->library('pagination');

                $config['base_url'] = admin_base_url() . "content/cat/$cat_id";
                $config['total_rows'] = $numContent;
                $config['per_page'] = $perpage;
                $config['uri_segment'] = 4;
                $config['prev_link'] = 'Newer';
                $config['next_link'] = 'Older';

                $this->pagination->initialize($config);
                $pg = $this->pagination->create_links();
                $this->templatedata['pagination'] = $pg;
            }

            $termRepo = &$this->doctrine->em->getRepository('content\models\Term');
            $category = $termRepo->findOneBySlug($slug);

            $this->templatedata['categoryId'] = $cat_id;

            $this->templatedata['category'] = $category->getName();
            $this->templatedata['contents'] = & $contents['contents'];

            unset($category);

            $this->templatedata['maincontent'] = 'content/admin/catnews';
            $this->load->view('admin/master', $this->templatedata);
        }
    }

    public function add($type = NULL) {
        $repo = $this->doctrine->em->getRepository('content\models\Content');

        $content = '';

        $alltagsObj = $repo->getAllTags();
        $alltags = array();
        foreach ($alltagsObj as $at) {
            //if (!in_array($at->getTerm()->getName(),$tarr)) $alltags[$at->getTerm()->id()] = $at->getTerm()->getName();
            $alltags[$at->getTerm()->id()] = $at->getTerm()->getName();
        }

        if ($this->input->post()) {
            $post_type = (is_null($type)) ? $this->input->post('content_type') : $type;

            $this->form_validation->set_rules('content_title', 'Content Title', 'required');
            $this->form_validation->set_rules('content_body', 'Content Body', 'required');

            if ($post_type == Content::CONTENT_TYPE_ARTICLE)
                $this->form_validation->set_rules('cat_id[]', 'Categories', 'required');

            if ($this->form_validation->run($this)) {
                $status = ($this->input->post('published') == 1 ) ? STATUS_ACTIVE : STATUS_INACTIVE;
                $content = new Content;

                $tagIn = $this->input->post('content_tags');
                if ($tagIn != '') {
                    $tagIn = trim(preg_replace('/\s+/', ',', $tagIn));
                    $tags = explode(',', $tagIn);
                    $tagRepo = &$this->doctrine->em->getRepository('content\models\Term');
                    foreach ($tags as $t) {
                        if ($t != '') {
                            $t = trim($t);
                            $t_ = $tagRepo->findOneByName($t);
                            if ($t_ === NULL) {
                                $tag = new Term($t);
                            } else {
                                $tag = $t_;
                            }
                            $this->doctrine->em->persist($tag);
                            $taxo = new Taxonomy($tag, 'tags');
                            $this->doctrine->em->persist($taxo);
                            $content->addTaxonomy($taxo);
                        }
                    }
                }

                $content->setTitle($this->input->post('content_title'));

                //add class to the content anchors
                $content->setBody($this->input->post('content_body'));
                $content->setType($post_type);
                $content->setMetaTitle($this->input->post('meta_title'));
                $content->setMetaDescription($this->input->post('meta_description'));
                $content->setMetaKeyword($this->input->post('meta_keyword'));
                $content->setStatus($status);
                $content->setAuther(Current_User::user());
                $content->setEventdate($this->input->post('article_date'));

                if ($post_type == Content::CONTENT_TYPE_PAGE && $this->input->post('parent_id') != 0) {
                    $parent = & $this->doctrine->em->find('content\models\Content', $this->input->post('parent_id'));
                    $content->setParent($parent);
                }/**/

                if ($post_type == Content::CONTENT_TYPE_ARTICLE) {
                    foreach ($this->input->post('cat_id') as $c) {
                        $taxonomy = & $this->doctrine->em->find('content\models\Taxonomy', $c);
                        $content->addTaxonomy($taxonomy);
                    }
                }

                $contentFormPostEvent = new ContentFormPostEvent($this->input->post(), $content);
                if (!is_null($type))
                    $contentFormPostEvent->setContentType($type);

                $this->eventDispatcher->dispatch('content.form.post', $contentFormPostEvent);
                $this->doctrine->em->persist($content);
                $this->doctrine->em->flush();
                //image
                if (isset($_FILES['content_image']) and $_FILES['content_image']['name'] != '') {
                    //upload the file
                    $config['upload_path'] = './assets/upload/images/content/temp/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 0;
                    $config['file_name'] = $content->getSlug();
//                        $config['max_width'] = 600;
//                        $config['max_height'] = 300;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('content_image')) {
                        $_upload_error = $this->upload->display_errors();
                    } else {
                        //resize the image
                        $up_data = $this->upload->data();

                        $thumb = ThumbLib::create($up_data['full_path']);
                        $thumb->adaptiveResize(600, 300);
                        $thumb->save('./assets/upload/images/content/' . $up_data['file_name']);

                        @unlink('./assets/upload/images/content/temp/' . $up_data['file_name']);

                        $image = $up_data['file_name'];
                        $content->setImage($image);
                        $this->doctrine->em->persist($content);
                        $this->doctrine->em->flush();
                    }
                }
                //image  

                if ($content->id()) {
                    $this->session->set_success_flashdata('feedback', 'Content added successfully.');
                    admin_redirect('content');
                }
            }

            $content = $this->input->post('content_body');
        }

        $contentFormReadyEvent = new ContentFormReadyEvent();
        if (!is_null($type))
            $contentFormReadyEvent->setContentType($type);
        $this->eventDispatcher->dispatch('content.form.ready', $contentFormReadyEvent);

        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';

        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');


        //setup ckeditor parameters
        $ck_config = array('height' => 300,
            'toolbar' => 'F1soft',
            'baseHref' => base_url(),
            'skin' => 'moono'
        );
        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';

        $this->templatedata['ckeditor'] = $this->ckeditor->editor("content_body", $content, $ck_config);

        $this->breadcrumb->append_crumb('Add Content', admin_url('content/add'));

        $this->templatedata['custom_fields'] = $contentFormReadyEvent->getCustomFields();
        $this->templatedata['custom_type'] = !is_null($type);

        $this->templatedata['categories'] = & $repo->getCategories();
        $this->templatedata['alltags'] = $alltags;
        $this->templatedata['maincontent'] = 'content/admin/add';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {
        $this->load->library('form_validation');
        $repo = &$this->doctrine->em->getRepository('content\models\Content');
        $content = $this->doctrine->em->find('content\models\Content', $id);

        $categories = &$content->getCategories();
//		$tabs = NULL;
//		$tabs = &$content->getTabs();

        $cat = array();
        if ($categories) {
            foreach ($categories as $c) {
                $cat[$c->id()] = $c->getTerm()->getName();
            }
        }

        $tags = &$content->getTags();
        $tarr = array();
        if ($tags) {
            foreach ($tags as $t) {
                $tarr[$t->id()] = $t->getTerm()->getName();
            }
        }


        $alltagsObj = $repo->getAllTags();
        $alltags = array();

        foreach ($alltagsObj as $at) {
            if (!in_array($at->getTerm()->getName(), $tarr))
                $alltags[$at->getTerm()->id()] = $at->getTerm()->getName(); // prevents REPITITION

                
//$alltags[$at->getTerm()->id()] = $at->getTerm()->getName(); // repeated
        }

        if ($this->input->post()) {

            $post_type = $content->getType();

            $this->form_validation->set_rules('content_title', 'Content Title', 'required');
            $this->form_validation->set_rules('content_body', 'Content Body', 'required');

            if ($post_type == Content::CONTENT_TYPE_ARTICLE)
                $this->form_validation->set_rules('cat_id[]', 'Categories', 'required');

            if ($this->form_validation->run($this)) {
                $tagIn = $this->input->post('content_tags');
                if ($tagIn != '') {
                    $tagIn = trim(preg_replace('/\s+/', ',', $tagIn));
                    $tags = explode(',', $tagIn);
                    $tagRepo = &$this->doctrine->em->getRepository('content\models\Term');
                    foreach ($tags as $t) {
                        if ($t != '') {
                            $t = trim($t);
                            $t_ = $tagRepo->findOneByName($t);
                            if ($t_ === NULL) {
                                $tag = new Term($t);
                            } else {
                                $tag = $t_;
                            }
                            $this->doctrine->em->persist($tag);
                            $taxo = new Taxonomy($tag, 'tags');
                            $this->doctrine->em->persist($taxo);
                            $content->addTaxonomy($taxo);
                        }
                    }
                }


                $status = ($this->input->post('published') == 1 ) ? STATUS_ACTIVE : STATUS_INACTIVE;

                $content->setTitle($this->input->post('content_title'));
                $content->setBody($this->input->post('content_body'));
                $content->setMetaTitle($this->input->post('meta_title'));
                $content->setMetaDescription($this->input->post('meta_description'));
                $content->setMetaKeyword($this->input->post('meta_keyword'));
                $content->setStatus($status);
                $content->setEventdate($this->input->post('article_date'));



                $contentFormPostEvent = new ContentFormPostEvent($this->input->post(), $content);
                $contentFormPostEvent->setContentType($content->getType());
                $this->eventDispatcher->dispatch('content.form.post', $contentFormPostEvent);


                if ($post_type != Content::CONTENT_TYPE_ARTICLE && $this->input->post('parent_id') != 0) {
                    $parent = & $this->doctrine->em->find('content\models\Content', $this->input->post('parent_id'));
                    $content->setParent($parent);
                }/**/

                if ($post_type == Content::CONTENT_TYPE_ARTICLE) {
                    //show_pre($cat);
                    foreach ($this->input->post('cat_id') as $c) {
                        if (!isset($cat[$c])) {
                            $taxonomy = & $this->doctrine->em->find('content\models\Taxonomy', $c);
                            $content->addTaxonomy($taxonomy);
                        } else
                            unset($cat[$c]);
                    }

                    //show_pre($cat);exit;
                    //now remove the removed categories
                    foreach ($cat as $k => $v) {
                        $taxonomy = & $this->doctrine->em->find('content\models\Taxonomy', $k);
                        $content->removeTaxonomy($taxonomy);
                    }
                }

                $remTag = $this->input->post('remTagID');

                if ($remTag != '') {
                    $arrID = explode(' ', trim($remTag));
                    foreach ($arrID as $a) {
                        $taxon = &$this->doctrine->em->find('content\models\Taxonomy', $a);
                        if ($taxon)
                            $content->removeTaxonomy($taxon);
                    }
                }


                $remTab = $this->input->post('remTabID');
                $arrID = array();

                if ($remTab != '') {
                    $arrID = explode(' ', trim($remTab));
                    foreach ($arrID as $a) {
                        $tabR = &$this->doctrine->em->find('content\models\Tabs', $a);
                        if ($tabR) {
                            //$content->removeTab($tabR);
                            $this->doctrine->em->remove($tabR);
                            $this->doctrine->em->flush();
                        }
                    }
                }

                $tab_n = (!isset($_POST['content_tab_title'])) ? 0 : count($this->input->post('content_tab_title'));
                if ($tab_n > 0) {
                    for ($i = 0; $i < $tab_n; $i++) {
                        if ((count($remTab) > 0) and in_array($_POST['tab_id'][$i], $arrID))
                            continue;
                        $ttl = trim($_POST['content_tab_title'][$i]);
                        $bdy = trim($_POST['content_tab_body'][$i]);
                        $edit = (is_numeric($_POST['tab_id'][$i])) ? true : false;

                        if (!empty($ttl) and ! empty($bdy)) {
                            if (!$edit) {
                                $tab = new Tabs();
                                $tab->setContent($content);
                            }
                            if ($edit)
                                $tab = &$this->doctrine->em->find('content\models\Tabs', trim($_POST['tab_id'][$i]));
                            $tab->setTitle($ttl);
                            $tab->setBody($bdy);
                            $this->doctrine->em->persist($tab);
                        }
                    }
                }

                $this->doctrine->em->persist($content);
                $this->doctrine->em->flush();
                //image
                if (isset($_FILES['content_image']) and $_FILES['content_image']['name'] != '') {
                    //upload the file
                    $config['upload_path'] = './assets/upload/images/content/temp/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 0;
                    $config['file_name'] = $content->getSlug();
//                        $config['max_width'] = 600;
//                        $config['max_height'] = 300;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('content_image')) {
                        $_upload_error = $this->upload->display_errors();
                    } else {
                        //Delete Previous Image
                        if ($content->getImage() != '')
                            @unlink('./assets/upload/images/content/' . $content->getImage());
                        //resize the image
                        $up_data = $this->upload->data();

                        $thumb = ThumbLib::create($up_data['full_path']);
                        $thumb->adaptiveResize(600, 300);
                        $thumb->save('./assets/upload/images/content/' . $up_data['file_name']);

                        @unlink('./assets/upload/images/content/temp/' . $up_data['file_name']);

                        $image = $up_data['file_name'];
                        $content->setImage($image);
                        $this->doctrine->em->persist($content);
                        $this->doctrine->em->flush();
                    }
                }
                //image 
                $this->session->set_success_flashdata('feedback', 'Content updated successfully.');
                admin_redirect('content');
            }
        }

        $contentFormReadyEvent = new ContentFormReadyEvent();
        $contentFormReadyEvent->setContentType($content->getType());
        $contentFormReadyEvent->setContent($content);

        $this->eventDispatcher->dispatch('content.form.ready', $contentFormReadyEvent);
        $this->templatedata['custom_fields'] = $contentFormReadyEvent->getCustomFields();

        $this->templatedata['metadata'] = $content->getMetaData();

        $this->templatedata['content'] = &$content;

        $this->templatedata['maincontent'] = 'content/admin/edit';

        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';

        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');

        //setup ckeditor parameters
        $ck_config = array('height' => 300,
            'toolbar' => 'F1soft',
            'baseHref' => base_url()
        );
        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';



        $this->breadcrumb->append_crumb('Edit Article', admin_url('content/edit'));
        $this->templatedata['categories'] = $cat;
        $this->templatedata['tags'] = $tarr;
        $this->templatedata['alltags'] = $alltags;
        $this->templatedata['availablecat'] = $categories;
        //	$this->templatedata['tabs'] = $tabs;
        $this->templatedata['ckeditor'] = $this->ckeditor->editor("content_body", $content->getBody(), $ck_config);
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {
        $content = $this->doctrine->em->find('content\models\Content', $id);
        if ($content->getImage() != '')
            @unlink('./assets/upload/images/content/' . $content->getImage());
        $this->doctrine->em->remove($content);
        $this->doctrine->em->flush();
        $this->session->set_success_flashdata('feedback', 'The content was deleted successfully.');
        admin_redirect('content');
    }

    public function search($term = NULL) {

        $success = false;
        $try = 0;
        if ($this->input->post('btnSub')) {

            $tags = $this->input->post('term');
            $tags = explode(' ', (strip_tags($tags)));
            if ($tags) {
                $tagRepo = &$this->doctrine->em->getRepository('content\models\Term');
                $res = array();
                $stack = array();
                foreach ($tags as $t) {
                    $t = trim($t);
                    $tag = $tagRepo->findOneByName($t);
                    if ($tag) {
                        $conRepo = &$this->doctrine->em->getRepository('content\models\Content');
                        $res_ = $conRepo->searchByTag($tag->getName());
                        foreach ($res_ as $r) {
                            $id = $r['id'];
                            if ($r and ! in_array($id, $stack)) {
                                $res[] = $r;
                                $success = true;
                            }
                            $stack[] = $id;
                        }
                    }
                }
            } $try++;
        }

        $this->breadcrumb->append_crumb('Search by Tag', admin_url('content/search'));
        $this->templatedata['result'] = &$res;
        $this->templatedata['success'] = $success;
        $this->templatedata['try'] = $try;
        $this->templatedata['maincontent'] = 'content/admin/search';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addd($type = NULL) {
        $this->load->library('content/FormBuilder', NULL, 'fb');

        $repo = $this->doctrine->em->getRepository('content\models\Content');

        $content = '';

        $alltagsObj = $repo->getAllTags();
        $alltags = array();
        foreach ($alltagsObj as $at) {
            //if (!in_array($at->getTerm()->getName(),$tarr)) $alltags[$at->getTerm()->id()] = $at->getTerm()->getName();
            $alltags[$at->getTerm()->id()] = $at->getTerm()->getName();
        }

        if ($this->input->post()) {
            $post_type = (is_null($type)) ? $this->input->post('content_type') : $type;

            $this->form_validation->set_rules('content_title', 'Content Title', 'required');
            $this->form_validation->set_rules('content_body', 'Content Body', 'required');

            if ($post_type == Content::CONTENT_TYPE_ARTICLE)
                $this->form_validation->set_rules('cat_id[]', 'Categories', 'required');

            if ($this->form_validation->run($this)) {
                $status = ($this->input->post('published') == 1 ) ? STATUS_ACTIVE : STATUS_INACTIVE;
                $content = new Content;

                $tagIn = $this->input->post('content_tags');
                if ($tagIn != '') {
                    $tagIn = trim(preg_replace('/\s+/', ',', $tagIn));
                    $tags = explode(',', $tagIn);
                    $tagRepo = &$this->doctrine->em->getRepository('content\models\Term');
                    foreach ($tags as $t) {
                        if ($t != '') {
                            $t = trim($t);
                            $t_ = $tagRepo->findOneByName($t);
                            if ($t_ === NULL) {
                                $tag = new Term($t);
                            } else {
                                $tag = $t_;
                            }
                            $this->doctrine->em->persist($tag);
                            $taxo = new Taxonomy($tag, 'tags');
                            $this->doctrine->em->persist($taxo);
                            $content->addTaxonomy($taxo);
                        }
                    }
                }

                $content->setTitle($this->input->post('content_title'));

                //add class to the content anchors
                $content->setBody($this->input->post('content_body'));
                $content->setType($post_type);
                $content->setStatus($status);
                $content->setAuther(Current_User::user());
                //$content->setEventdate($this->input->post('article_date'));


                if ($post_type == Content::CONTENT_TYPE_PAGE && $this->input->post('parent_id') != 0) {
                    $parent = & $this->doctrine->em->find('content\models\Content', $this->input->post('parent_id'));
                    $content->setParent($parent);
                }/**/

                if ($post_type == Content::CONTENT_TYPE_ARTICLE) {
                    foreach ($this->input->post('cat_id') as $c) {
                        $taxonomy = & $this->doctrine->em->find('content\models\Taxonomy', $c);
                        $content->addTaxonomy($taxonomy);
                    }
                }

                $this->doctrine->em->persist($content);

                $this->doctrine->em->flush();

                if ($content->id()) {
                    $this->session->set_success_flashdata('feedback', 'Content added successfully.');
                    admin_redirect('content');
                }
            }

            $content = $this->input->post('content_body');
        }

        $this->fb->initialize();


        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';

        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');


        //setup ckeditor parameters
        $ck_config = array('height' => 300,
            'toolbar' => 'F1soft',
            'baseHref' => base_url(),
            'skin' => 'moono'
        );
        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';

        $this->templatedata['ckeditor'] = $this->ckeditor->editor("content_body", $content, $ck_config);

        $this->breadcrumb->append_crumb('Add Content', admin_url('content/add'));


        $this->templatedata['form'] = $this->fb->render($type);

// 		echo $this->templatedata['form']; exit;

        $this->templatedata['categories'] = & $repo->getCategories();
        $this->templatedata['alltags'] = $alltags;
        $this->templatedata['maincontent'] = 'content/admin/add-new';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function showfrontt() {
        $showfrontid = $this->input->post('id');
        $showfrontvalue = $this->input->post('showvalue');

        $frontcontent = &$this->doctrine->em->find('content\models\Content', $showfrontid);
        if ($showfrontvalue == "true") {
            //echo "asdf";exit;
            $frontcontent->setShowfront("1");
        } else if ($showfrontvalue == "false") {
            //echo "false";exit;
            $frontcontent->setShowfront("0");
        }
        $this->doctrine->em->persist($frontcontent);
        $this->doctrine->em->flush();
    }

    public function addFromCategory() {
        $type = 'article';
        $repo = $this->doctrine->em->getRepository('content\models\Content');
        $catId = $this->input->get('categoryId');
        $cid = explode('.', $catId);
        $categoryId = $cid[0];

        $selectedCategory = CI::$APP->doctrine->em->find('content\models\Term', $categoryId);
        $content = '';


        $alltagsObj = $repo->getAllTags();
        $alltags = array();
        foreach ($alltagsObj as $at) {
            // if (!in_array($at->getTerm()->getName(),$tarr)) $alltags[$at->getTerm()->id()] = $at->getTerm()->getName();
            $alltags[$at->getTerm()->id()] = $at->getTerm()->getName();
        }

        if ($this->input->post()) {
            $post_type = (is_null($type)) ? $this->input->post('content_type') : $type;

            $this->form_validation->set_rules('content_title', 'Content Title', 'required');
            $this->form_validation->set_rules('content_body', 'Content Body', 'required');

            if ($post_type == Content::CONTENT_TYPE_ARTICLE)
                $this->form_validation->set_rules('cat_id[]', 'Categories', 'required');

            if ($this->form_validation->run($this)) {
                $tabName = $this->input->post('tabName');
                $tabContent = $this->input->post('tabContent');

                $status = ($this->input->post('published') == 1 ) ? STATUS_ACTIVE : STATUS_INACTIVE;
                $content = new Content;

                $tagIn = $this->input->post('content_tags');
                if ($tagIn != '') {
                    $tagIn = trim(preg_replace('/\s+/', ',', $tagIn));
                    $tags = explode(',', $tagIn);
                    $tagRepo = &$this->doctrine->em->getRepository('content\models\Term');
                    foreach ($tags as $t) {
                        if ($t != '') {
                            $t = trim($t);
                            $t_ = $tagRepo->findOneByName($t);
                            if ($t_ === NULL) {
                                $tag = new Term($t);
                            } else {
                                $tag = $t_;
                            }
                            $this->doctrine->em->persist($tag);
                            $taxo = new Taxonomy($tag, 'tags');
                            $this->doctrine->em->persist($taxo);
                            $content->addTaxonomy($taxo);
                        }
                    }
                }

                $content->setTitle($this->input->post('content_title'));

                //add class to the content anchors
                $content->setBody($this->input->post('content_body'));
                $content->setType($post_type);
                $content->setStatus($status);
                $content->setAuther(Current_User::user());
                $content->setEventdate($this->input->post('article_date'));


                if ($post_type == Content::CONTENT_TYPE_PAGE && $this->input->post('parent_id') != 0) {
                    $parent = & $this->doctrine->em->find('content\models\Content', $this->input->post('parent_id'));
                    $content->setParent($parent);
                }/**/

                if ($post_type == Content::CONTENT_TYPE_ARTICLE) {
                    foreach ($this->input->post('cat_id') as $c) {
                        $taxonomy = & $this->doctrine->em->find('content\models\Taxonomy', $c);
                        $content->addTaxonomy($taxonomy);
                    }
                }

                $contentFormPostEvent = new ContentFormPostEvent($this->input->post(), $content);
                if (!is_null($type))
                    $contentFormPostEvent->setContentType($type);

                $this->eventDispatcher->dispatch('content.form.post', $contentFormPostEvent);

                $this->doctrine->em->persist($content);

                $this->doctrine->em->flush();

                foreach ($tabName as $key => $value) {

                    // Inserting the tab contents.
                    $tab = new Tabs;

                    if ($tabName[$key]) {
                        $tabBody = $this->doctrine->em->find('content\models\Content', $tabContent[$key]);
                        $tab->setTitle($tabName[$key]);
                        $tab->setBody($tabBody);
                        $tab->setContent($content);

                        $this->doctrine->em->persist($tab);
                    }
                }
                $this->doctrine->em->flush();


                if ($content->id()) {
                    $this->session->set_success_flashdata('feedback', 'Content added successfully.');
                    admin_redirect('content');
                }
            }

            $content = $this->input->post('content_body');
        }

        $contentFormReadyEvent = new ContentFormReadyEvent();
        if (!is_null($type))
            $contentFormReadyEvent->setContentType($type);
        $this->eventDispatcher->dispatch('content.form.ready', $contentFormReadyEvent);

        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';

        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');


        //setup ckeditor parameters
        $ck_config = array('height' => 300,
            'toolbar' => 'F1soft',
            'baseHref' => base_url(),
            'skin' => 'moono
            '
        );

        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';

        $this->templatedata['ckeditor'] = $this->ckeditor->editor("content_body", $content, $ck_config);

        $this->breadcrumb->append_crumb('Add Content', admin_url('content/add'));

        $this->templatedata['custom_fields'] = $contentFormReadyEvent->getCustomFields();
        $this->templatedata['custom_type'] = !is_null($type);

        $this->templatedata['categories'] = & $repo->getCategories();
        $this->templatedata['contentCategories'] = Taxonomy::getCategories();
        $this->templatedata['categoryId'] = $categoryId;
        $this->templatedata['selectedCategory'] = $selectedCategory;
        $this->templatedata['alltags'] = $alltags;
        $this->templatedata['maincontent'] = 'content/admin/addFromCategory';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function updatenews()
    {
        // print_r($_POST);
        $value = $this->input->post('id');
        $content = & $this->doctrine->em->find('content\models\Content',$value);
        $content->setUpdatenews($this->input->post('vals'));
        $this->doctrine->em->persist($content);
        $this->doctrine->em->flush();
        if($content){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
       // $this->load->view('displayvdc.php', array('vdc' => $vdc));
    }

}
