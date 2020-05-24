<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Components\fileHandlerComponent;
use App\Http\Controllers\Controller;
use App\Model\Subject;
use App\Model\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $perPage = request()->perPage ?: 10;
        $keyword = request()->keyword;

        $videos = Video::with('subject');

        if ($keyword){
            $videos = $videos->where('name', 'like', '%'.$keyword.'%')
                ->orWhere('embed_code', 'like', '%'.$keyword.'%')
                ->orWhereHas('subject', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%');
                });
        }

        $videos = $videos->latest()->paginate($perPage);

        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
       $subjects = Subject::latest()->get();
       return view('admin.video.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'name' => 'required|max:255|unique:videos',
            'embed_code' => 'required',
            'img' => 'required'
        ],[
            'embed_code.required' => 'The URL field is required.'
        ]);

        if($request->img){
            $image = fileHandlerComponent::imageUpload($request->file('img'), 'img');
            $request['thumbnail'] = $image;
        }

        Video::create($request->all());

        return redirect()->route('admin.videos.index')->with('successTMsg','Video save successfully');
    }

    public function edit(Video $video)
    {
        $subjects = Subject::latest()->get();
        return view('admin.video.edit',compact('subjects','video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'subject_id' => 'required',
            'name' => 'required|max:255|unique:videos,name,'.$video->id,
            'embed_code' => 'required'
        ],[
            'embed_code.required' => 'The URL field is required.'
        ]);

        if($request->img){
            $image = fileHandlerComponent::imageUpload($request->file('img'), 'img');
            $request['thumbnail'] = $image;

            fileHandlerComponent::imageDelete($video->thumbnail);
        }

        $video->update($request->all());

        return redirect()->route('admin.videos.index')->with('successTMsg','Video has been updated successfully');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        if ($video->thumbnail) {
            fileHandlerComponent::imageDelete($video->thumbnail);
        }

        return back()->with('successTMsg', 'Video has been deleted successfully');
    }
}
