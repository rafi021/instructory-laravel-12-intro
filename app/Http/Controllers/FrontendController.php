<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Facades\Math;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Like;
use App\Models\Post;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UserProfile;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home()
    {
        $categories = Category::with(['posts:id,category_id,title'])
            ->withCount('posts')
            ->get();

        // $teacher = Teacher::first();
        // dd($teacher->parents()->get());


        // $student = Student::first();
        // dd($student->courses()->get());


        // $course = Course::first();
        // dd($course->students()->get());



        $profile = UserProfile::first();
        // dd($profile->like);

        $post = Post::first();
        // dd($post->like);


        $like = Like::first();
        dd($like->likeable); //--- return parent


        $video  = Video::first();
        dd($video->comments);

        $post = Post::first();
        dd($post->comments);

        $comment = Comment::first();
        dd($comment->commentable); //--- return parent

        $post = Post::first();
        dd($post->tags);

        $video = Video::first();
        dd($video->tags);

        $tag = Tag::first();
        dd($tag->taggable);



        // return $categories;
        return view('home', compact('categories'));
    }
    public function about(Request $request)
    {
        dd($request);
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function service()
    {
        $isServices = true;
        $services = [
            'Web Development',
            'Mobile App Development',
            'SEO Services',
            'Digital Marketing',
        ];
        return view('service', compact('isServices', 'services'));
    }


    public function transaction()
    {
        return Math::add(5, 10);
    }
}
