<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function listAdminData()
    {
        $model = (new Article())->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function listAdmin()
    {
        return view('admin.article.list');
    }

    public function list()
    {
        $articles = Article::get();

        return view('article.list', compact('articles'));
    }

    public function view(Article $article)
    {
        return view('article.view', compact('article'));
    }

    public function create()
    {
        $article = new Article();
        $article->save();

        return redirect()->route('admin.article.form', [
            'article' => $article->id,
        ]);
    }

    public function viewForm(Article $article)
    {
        return view('admin.article.form', compact('article'));
    }

    public function save(Article $article, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'shortDescription' => 'required',
            'content' => 'required',
        ]);

        $article
            ->fill([
                'title' => $request->title,
                'short_description' => $request->shortDescription,
                'content' => $request->content,
            ])
            ->save();

        return redirect()
            ->route('admin.article.list')
            ->with(['success' => 'Artikel tersimpan!']);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            $fileName =
                $fileName .
                '_' .
                time() .
                '.' .
                $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $fileName); //SIMPAN KE DALAM FOLDER PUBLIC/UPLOADS

            //KEMUDIAN KITA BUAT RESPONSE KE CKEDITOR
            $ckeditor = $request->input('CKEditorFuncNum');
            $url = asset('uploads/' . $fileName);
            $msg = 'Image uploaded successfully';
            //DENGNA MENGIRIMKAN INFORMASI URL FILE DAN MESSAGE
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";

            //SET HEADERNYA
            @header('Content-type: text/html; charset=utf-8');
            return $response;
        }
    }

    public function delete(Article $article)
    {
        $article->delete();

        return redirect()
            ->route('admin.article.list')
            ->with(['success' => 'Article dihapus!']);
    }
}
