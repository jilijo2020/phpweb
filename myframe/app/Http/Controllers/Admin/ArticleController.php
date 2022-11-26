<?php
namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use myframe\Page;
use HTMLPurifier;
use Exception;

class ArticleController extends CommonController
{
    public function index(Article $article)
    {
        $total = $article->count();
        $page = $this->request->get('page', 1);
        $size = 2;
        $offset = ($page - 1) * $size;
        $data = $article->orderBy('id', 'DESC')->limit($offset, $size)
        ->get(['id', 'title', 'author', 'show', 'views', 'created_at']);
        $this->assign('article', $data);
        $page_html = Page::html('?page=', $total, $page, $size);
        $this->assign('page_html', $page_html);
        return $this->fetch('admin/article_list');
    }
    public function edit(Article $article, Category $category)
    {
        $id = $this->request->get('id');
        if ($id) {
            $data = $article->where('id', $id)->first();
        } else {
            $data = ['cid' => 0, 'title' => '', 'author' => '', 'show' => 1,
            'content' => '', 'image' => ''];
        }
        $this->assign('data', $data);
        $data = $category->orderBy('sort', 'ASC')->get();
        $this->assign('category', $data);
        $this->assign('id', $id);
        return $this->fetch('admin/article_edit');
    }
    public function save(Article $article, HTMLPurifier $purifier)
    {
        $id = $this->request->post('id', 0);
        $data = [
            'cid' => $this->request->post('cid', 0),
            'title' => $this->request->post('title', ''),
            'author' => $this->request->post('author', ''),
            'show' => $this->request->post('show', '0'),
            'content' => $this->request->post('content', ''),
            'image' => '',
        ];
        $data['content'] = $purifier->purify($data['content']);
        if ($this->request->hasFile('image')) {
            $data['image'] = $this->uploadImage();
        }
        if ($id) {
            $article->where('id', $id)->update($data);
            $this->success('修改完成。');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $article->insert($data);
            $this->success('添加完成。');
        }
    }
    protected function uploadImage()
    {
        try {
            $file = $this->request->file('image');
            $allow_ext = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            $ext = $file->extension();
            if (!in_array(strtolower($ext), $allow_ext)) {
                $this->error('文件上传失败：只允许扩展名：' . implode(', ', $allow_ext));
            }
            $sub = date('Y-m/d');
            $name = $file->move('./uploads/images/' . $sub);
            return $sub . '/' . $name;
        } catch (Exception $e) {
            $this->error('文件上传失败：' . $e->getMessage());
        }
    }
    public function delete(Article $article)
    {
        $id = $this->request->get('id');
        $article->where('id', $id)->delete($id);
        $this->success('删除完成。');
    }
}
