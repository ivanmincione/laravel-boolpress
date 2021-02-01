<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use Illuminate\Support\Str;

use App\Category;

use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupero tutti i Post
        $data = [
            "posts" => Post::all()
        ];
        return view("admin.posts.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //recuperare le category
    {
        $data = [
            "categories" => Category::all(),
            'tags' => Tag::all(),
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione dei dati inseriti nel form
        $request->validate([
           'title' => 'required|max:255',
           'content' => 'required',
           'category_id' => 'nullable|exists:categories,id',
           'tags' => 'exists:tags,id'
       ]);
        // //recupero i dati attraverso all() e li assegno a $data
        $form_data = $request->all();
        $newPost = new Post();
        $newPost->fill($form_data);
        // genero lo slug
        $slug = Str::slug($newPost->title);
        $slugBase = $slug;
        // verifico che lo slug non esista nel database
        $post_presente = Post::where('slug', $slug)->first();
        $contatore = 1;
        // entro nel ciclo while se ho trovato un post con lo stesso $slug
        while($post_presente) {
            // genero un nuovo slug aggiungendo il contatore alla fine
            $slug = $slugBase . '-' . $contatore;
            $contatore++;
            $post_presente = Post::where('slug', $slug)->first();
        }
        // quando esco dal while sono sicuro che lo slug non esiste nel db
        // assegno lo slug al post
        $newPost->slug = $slug;
        $newPost->save();
        // dopo save() aggiungerer la sincronizzazione sync() dei dati con i tags
        $newPost->tags()->sync($form_data['tags']);
        // verifico se sono stati selezionati dei tag
        if(array_key_exists('tags', $form_data)) {
            // aggiungo i tag al post
            $newPost->tags()->sync($form_data['tags']);
        }
        return redirect()->route('admin.posts.index'); //->with('success', 'Salvataggio avvenuto correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post) {
           $data = [
               'post' => $post
           ];
           return view('admin.posts.show', $data);
       } else {
           abort(404);
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post) {

            $data = [
                'post' => $post,
                'categories' => Category::all(),
                'tags' => Tag::all(),
            ];
        } else {
            abort(404);
        }
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validazione dei dati di modifica dei post
        $request->validate([
           'title' => 'required|max:255',
           'content' => 'required',
           'category_id' => 'nullable|exists:categories,id',
           'tags' => 'exists:tags,id'
       ]);
        $form_data = $request->all();
        // verifico se il titolo ricevuto dal form è diverso dal vecchio titolo
        if($form_data['title'] != $post->title) {
            // è stato modificato il titolo => devo modificare anche lo slug
            // genero lo slug
            $slug = Str::slug($form_data['title']);
            $slugBase = $slug;
            // verifico che lo slug non esista nel database
            $postPresente = Post::where('slug', $slug)->first();
            $contatore = 1;
            // entro nel ciclo while se ho trovato un post con lo stesso $slug
            while($postPresente) {
                // genero un nuovo slug aggiungendo il contatore alla fine
                $slug = $slugBase . '-' . $contatore;
                $contatore++;
                $postPresente = Post::where('slug', $slug)->first();
            }
            // quando esco dal while sono sicuro che lo slug non esiste nel db
            // assegno lo slug al post
            $form_data['slug'] = $slug;
        }
        $post->update($form_data);
        // utilizzare sync() per sincronizzare l'aggiornamento dei dati
        if(array_key_exists('tags', $form_data)) {
            // aggiungo i tag al post
            $post->tags()->sync($form_data['tags']);
        }
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // prima della funzione di delete()
        // basta sincronizzare un array vuoto in modo da permetterer la cancellazione del post non andando più in contrasto con le relazioni tra le chiavi delle tab
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
