<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables, \Carbon\Carbon;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::all();
        return view('pages.blog.index');
    }

    public function data()
    {
        $data = Blog::all();
        $data = $data->map(function($item) {
            return (object)[
                'id' => $item->id,
                'title' => $item->title,
                'created_at' => Carbon::parse($item->created_at)->format('d/m/Y h:i:s'),
                'updated_at' => Carbon::parse($item->update_at)->format('d/m/Y h:i:s'),
            ];
        });
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($item) {
            return '
                <a href="'. route('blog.show',$item->id).'" class="btn btn-primary">
                    <i class="fa fa-edit" style="color:white"></i>
                </a>
                <a href="'. route('blog.delete',$item->id).'" class="btn btn-danger">
                    <i class="fa fa-trash" style="color:white"></i>
                </a>
              ';
        })
        ->make(true); 
    }

    public function create()
    {
        $action = "create";
        return view('pages.blog.form', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $description=$request->input('content');
        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name= "/blogs/img/" . time().$k.'.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $data);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $description = $dom->saveHTML();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'category'=> 'required',
            'content' => 'required'
        ]);
        $this->upload($request);
        try {
            Blog::create([
                'title'    => $request->title,
                'slug'     => Str::slug($request->title),
                'category' => $request->category,
                'body'     => $request->content
            ]);
            return redirect()->route('blog')->with(['type'=>'store']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $action = "edit";
            $data = Blog::find($id);
            return view('pages.blog.form', compact('action','data'));
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    public function edit(Blog $blog)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required',
            'category'=> 'required',
            'content' => 'required'
        ]);
        try {
            Blog::find($id)
                ->update([
                    'title'    => $request->title,
                    'slug'     => Str::slug($request->title),
                    'category' => $request->category,
                    'body'     => $request->content
                ]);
            return redirect()->route('blog')->with(['type'=>'update']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            Blog::destroy($id);
            return redirect()->route('blog')->with(['type'=>'delete']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }
}
