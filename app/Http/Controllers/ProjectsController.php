<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File ;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

use function Pest\Laravel\get;

class ProjectsController extends Controller{

    public function show(){
        $projects = Project::all();
        return view('pages.projects',['projects'=>$projects]);
    }
    public function showmyproject(){
        $projects = Project::all()->where('dev_id',Auth::user()->id);
        return view('pages.myprojects',['projects'=>$projects]);
    }
    public function addproject(Request $request): RedirectResponse{
        $att = $request->validate([
            'content'=> 'required|string|min:2',
            'file'=> 'required',
            'lang'=>'required',
            'video'=>'required|file|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:31200',
            'link'=>''
        ],[
            'video.required'=> 'يرجى رفع فيديو للمشروع.',
            'video.mimetypes'=> 'صيغة الفيديو غير مدعومة. الصيغ المقبولة: mp4 و avi.',
            'video.max'=> 'حجم الفيديو كبير جداً. الحد الأقصى هو 50 ميغابايت.',
        ]);
        // if($request->hasFile('file')){
            $file = $request->file('file');
            $name = str_replace('.zip','',$file->getClientOriginalName());
            $file = $file->store('/');
            $file = Storage::disk('local')->put('/',$request->file('file'));
        // }
        $videoPath = $request->file('video')->store('videos', 'public');
        Project::create([
            'title' => $name,
            'content' => $request->input('content'),
            'dev_id' => Auth::user()->id,
            'file'=>$file ??= null,
            'video'=>$videoPath,
            'lang'=>$request->input('lang'),
            'link'=>$request->input('link')

        ]);
        return redirect('/myprojects');
    }
    public function deleteproject(string $id){
 
        $project = Project::find($id);
        $project->forceDelete();

        return redirect('/myprojects');
        // Project::delete();
        // return redirect('/myprojects');
        
    }
    public function getproject(string $id){
        $project = Project::find($id);
        $file = $project->file;
        $link=$project->link;
        $path = Storage::disk('local')->path($file);
        $video = $project->video ? asset('storage/' . $project->video):null;

        // unzip file 
        $zip = new ZipArchive;
        if($zip->open($path,ZipArchive::CREATE) === true){
            $filespath = storage_path('app/public/unzip');
            $zip->extractTo($filespath);
            $zip->close();

            $files = scandir($filespath);
            $files = array_diff($files,['.','..']);
            $file = str_replace(".zip","",$file);
            $name = $project->title;
            $filespath = storage_path('app/public/unzip/'.$name);
            $files = File::files($filespath);

            $content = [];
            foreach($files as $f){
                $content[]=[
                    'filename'=>$f->getFilename(),
                    'content'=>File::get($f)
                ];
            }
            return view('pages.project',[
                'project'=>$project,
                'files'=>$files,
                'name'=>$name,
                'video'=>$video,
            'link'=>$link]); 
            
            
        }
       
    }
    public function downloadproject(string $name){
        $zip = new ZipArchive;
        $path =storage_path('app/public/unzip/'.$name);
        $zippath =storage_path('app/public/unzip/'.$name.".zip");

        if ($zip->open($zippath, ZipArchive::CREATE)== TRUE)
        {
            $files = File::files($path);
            foreach ($files as $key => $value){
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }
        return response()->download($zippath)->deleteFileAfterSend();        
    }
    function search(Request $request){
      
            $search = $request->input('search');
            $lang = $request->input('lang');
            // $results = null;
            if(!isset($search)){
                $results = Project::where('lang','like',"%$lang%")->get();

            }else{
                $results = Project::where('title','like',"%$search%")->get();
            }

            return view('pages.projects',['projects'=>$results]); 
    }
}