<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $data['page_title'] = "Admin Dashboard";
        $this->load->view('admin/layouts/header',$data);
        $this->load->view('admin/index');
        $this->load->view('admin/layouts/footer');
    }
    public function login()
    {
        if($this->auth_model->loggedIn())
        {
            return redirect('/admin');
        }
        if($this->form_validation->run() == false)
        {
            $data['page_title'] = "Admin Login";
            $this->load->view('admin/login/index',$data);
        }
        else
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            if(!$this->auth_model->adminLogin($email,$password))
            {
                $this->flash->danger('Your email or password is incorrect');
                return redirect('/admin/login');
            }
            $this->flash->success('You are logged In');
            return redirect('/admin');
        }
    }
    public function logout()
    {
        $this->auth_model->logout();
        redirect('/admin/login');
    }
    public function users()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $data['page_title'] = "Manage Users";
        $this->load->view('admin/layouts/header',$data);
        $this->load->view('admin/users/index');
        $this->load->view('admin/layouts/footer');
    }
    public function activate_user($id)
    {
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        if(!$this->user_model->activate($id))
        {
            $this->flash->danger("An error occurred. Unable to activate user account at this time");
            return redirect('/admin/users');
        }
        $this->flash->success('User account was activated successfully');
        redirect('/admin/users');
    }
    public function deactivate_user($id)
    {
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        if(!$this->user_model->deactivate($id))
        {
            $this->flash->danger("An error occurred. Unable to activate user account at this time");
            return redirect('/admin/users');
        }
        $this->flash->success('User account was deactivated successfully');
        redirect('/admin/users');
    }
    public function delete_user($id)
    {
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        if(!$this->user_model->delete($id))
        {
            $this->flash->danger("An error occurred. Unable to delete user account at this time");
            return redirect('/admin/users');
        }
        $this->flash->success('User account was deleted successfully');
        return redirect('/admin/users');
    }
    public function categories()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $this->load->model(['category_model']);
        if($this->form_validation->run('category') == FALSE)
        {
            $data['page_title'] = "Add Category";
            $this->load->view('admin/layouts/header',$data);
            $this->load->view('admin/article/category');
            $this->load->view('admin/layouts/footer');
        }
        else
        {
            if($this->category_model->create())
            {
                $this->flash->overlay("Your Category was added successfully");
            }
            else
            {
                $this->flash->overlay("Unable to add category at this time? please try again");
            }
            return redirect('/admin/categories');
        }
    }
    public function edit_category($id)
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        if(!is_numeric($id))
        {
            $this->flash->overlay("Oops invalid url");
            return redirect('/admin/categories');
        }
        $this->load->model(['category_model']);
        if($this->form_validation->run('category') == FALSE)
        {
            $data['page_title'] = "Update Category";
            $data['category'] = $this->category_model->getCategory($id);
            $this->load->view('admin/layouts/header',$data);
            $this->load->view('admin/article/update_category');
            $this->load->view('admin/layouts/footer');
        }
        else
        {
            if($this->category_model->update($id))
            {
                $this->flash->overlay("Your Category was Update successfully");
            }
            else
            {
                $this->flash->overlay("Unable to Update category at this time? please try again");
            }
            return redirect('/admin/categories');
        }
    }
    public function delete_category($id)
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        if(!is_numeric($id))
        {
            $this->flash->overlay("Oops invalid url");
            return redirect('/admin/categories');
        }
        $this->load->model(['category_model']);
        if($this->category_model->delete($id))
        {
            $this->flash->overlay("Category deleted successfully");
        }
        else
        {
            $this->flash->overlay("Unable to delete category at this time, try again");
        }
        return redirect('/admin/categories');
    }
    public function write()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $this->load->model(['article_model','category_model']);
        if($this->form_validation->run('article') == FALSE)
        {
            $data['page_title'] = "Write Article";
            $data['categories'] = $this->category_model->getCategories();
            $this->load->view('admin/layouts/header',$data);
            $this->load->view('admin/article/write');
            $this->load->view('admin/layouts/footer');
        }
        else
        {
            if($this->article_model->create())
            {
                $this->flash->overlay("Your Article was created successfully");
            }
            else
            {
                $this->flash->overlay("Unable to create article at this time? please try again");
            }
            return redirect('/admin/articles');
        }
    }
    public function articles()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $this->load->model(['article_model','category_model']);
        $data['page_title'] = "Articles";
        $data['articles'] = $this->article_model->getAllArticles();
        $this->load->view('admin/layouts/header',$data);
        $this->load->view('admin/article/articles');
        $this->load->view('admin/layouts/footer');
    }
    public function edit_article($id)
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        if(!is_numeric($id))
        {
            $this->flash->overlay("Oops invalid url");
            return redirect('/admin/articles');
        }
        $this->load->model(['article_model','category_model']);
        if($this->form_validation->run('article') == FALSE)
        {
            $data['page_title'] = "Write Article";
            $data['categories'] = $this->category_model->getCategories();
            $data['article'] = $this->article_model->getArticle($id);
            $data['cat'] =  $this->category_model->getCategory($data['article']->category_id);
            $this->load->view('admin/layouts/header',$data);
            $this->load->view('admin/article/edit_article');
            $this->load->view('admin/layouts/footer');
        }
        else
        {
            if($this->article_model->update($id))
            {
                $this->flash->overlay("Your Article was updated successfully");
            }
            else
            {
                $this->flash->overlay("Unable to update article at this time? please try again");
            }
            return redirect('/admin/articles');
        }
    }
    public function delete_article($id)
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        if(!is_numeric($id))
        {
            $this->flash->overlay("Oops invalid url");
            return redirect('/admin/articles');
        }
        $this->load->model(['article_model']);
        if($this->article_model->delete($id))
        {
            $this->flash->overlay("Article deleted successfully");
        }
        else
        {
            $this->flash->overlay("Ooops an error occured, try again");
        }
        return redirect('/admin/articles');
    }
    public function settings()
    {
        if($this->form_validation->run() == false)
        {
            $data['page_title'] = "Site Settings";
            $this->load->view('admin/layouts/header',$data);
            $this->load->view('admin/site/settings');
            $this->load->view('admin/layouts/footer');
        }
        else
        {
            $this->load->model(['site_model']);
            $this->site_model->updateSettings();
            return redirect('/admin/settings');
        }
    }
    public function pages()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $this->load->model(['page_model']);
        $data['page_title'] = "Pages";
        $data['pages'] = $this->page_model->getPages();
        $this->load->view('admin/layouts/header',$data);
        $this->load->view('admin/pages/list');
        $this->load->view('admin/layouts/footer');
    }
    public function create_page()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $this->load->model(['page_model']);
        if($this->form_validation->run('page') == FALSE)
        {
            $data['page_title'] = "Create page";
            $this->load->view('admin/layouts/header',$data);
            $this->load->view('admin/pages/create');
            $this->load->view('admin/layouts/footer');
        }
        else
        {
            if($this->page_model->create())
            {
                $this->flash->overlay("Your Page was created successfully");
            }
            else
            {
                $this->flash->overlay("Unable to create page at this time? please try again");
            }
            return redirect('/admin/pages');
        }
    }
    public function edit_page($id)
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        if(!is_numeric($id))
        {
            $this->flash->overlay("Oops invalid url");
            return redirect('/admin/pages');
        }
        $this->load->model(['page_model']);
        if($this->form_validation->run('page') == FALSE)
        {
            $data['page_title'] = "Update page";
            $data['page'] = $this->page_model->getPage($id);
            $this->load->view('admin/layouts/header',$data);
            $this->load->view('admin/pages/edit');
            $this->load->view('admin/layouts/footer');
        }
        else
        {
            if($this->page_model->update($id))
            {
                $this->flash->overlay("Your Page was updated successfully");
            }
            else
            {
                $this->flash->overlay("Unable to update page at this time? please try again");
            }
            return redirect('/admin/pages');
        }
    }
    public function delete_page($id)
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        if(!is_numeric($id))
        {
            $this->flash->overlay("Oops invalid url");
            return redirect('/admin/pages');
        }
        $this->load->model(['page_model']);
        if($this->page_model->delete($id))
        {
            $this->flash->overlay("page deleted successfully");
        }
        else
        {
            $this->flash->overlay("Ooops an error occured, try again");
        }
        return redirect('/admin/articles');
    }
}