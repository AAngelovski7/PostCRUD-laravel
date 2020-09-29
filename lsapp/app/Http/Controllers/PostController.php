<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
class PostController extends Controller
{

  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);  //block everything if we are nmot login except index and show page
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // $post = Post::orderBy('title','asc')->get(); //ke gi zemi site posts in ascending order by title
         // return Post::where('title','Post Two')->get(); // return post with title Post Two
         //$posts = DB::select('SELECT * FROM posts'); // return all posts with using sql statement not eloquent
        // $post = Post::orderBy('title','asc')->take(1)->get(); //take(1) ke zemit samo eden element
         
         //$posts = Post::orderBy('title','asc')->paginate(2); - // create paggination with 2 posts on the page 
         //$posts = Post::all();
         
         $posts = Post::orderBy('created_at','desc')->paginate(5); //take(1) ke zemit samo eden element
        
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Passing request that is pass to store function and then array of rules
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

         // Handle file upload
         if($request->hasFile('cover_image')){ //ako upload image
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); //extract onli filename 
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            
        }else{
            $fileNameToStore = 'noimage.jpg'; // if dont uplload image take this default image
        }

        //Create Post - take data of form that is submited
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $fileNameToStore;
        $post->user_id = auth() ->user() ->id; //take currently loged user id because we use authentication
        $post->save();
        return redirect('/posts')->with('success','Post created'); // when post submit is full we redirect to /post page        
    }                                                             //and show succes message with text Posst created          

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id); // Post is a model
       
        return view('posts.show')->with('post',$post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id); // find post with $id 
        //CHECK FOR CORRECT USER , because when we login and go mechanical to edit/5 na pr a to ne e post created by that user we can edit and on this way we can avoid this 
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');

        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //Passing request that is pass to store function and then array of rules
         $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
           

        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){ //ako upload image
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); //extract onli filename 
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            
        }

        //Create Post - take data of form that is submited
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        if($post->cover_image != 'noimage'){
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');

    }
}
