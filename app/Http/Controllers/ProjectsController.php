<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'title' => 'required|string',
            'content'=> 'required|string|min:15',
            'file'=> 'required'
        ]);
        // if($request->hasFile('file')){
            $file = $request->file('file')->store('/');
            $file = Storage::disk('local')->put('/',$request->file('file'));
        // }
        Project::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'dev_id' => Auth::user()->id,
            'file'=>$file ??= null

        ]);
        return redirect('/myprojects');
    }
    public function deleteproject(Request $request,string $id){
 
        $project = Project::find($id);
        $project->forceDelete();

        return redirect('/myprojects');
        // Project::delete();
        // return redirect('/myprojects');
        
    }
    public function getproject(string $id){
        $project = Project::find($id);
        // $project = $project[$id];

        $file = $project->file;
        $path = Storage::disk('local')->path($file);

        // unzip file 
        $zip = new ZipArchive;
        if($zip->open($path,ZipArchive::CREATE) === true){
            $filespath = storage_path('app/public/unzip');
            $zip->extractTo($filespath);
            $zip->close();

            $files = scandir($filespath);
            $files = array_diff($files,['.','..']);
            // $files = scandir($filespath);
            // dd($files);

            $filespath = storage_path('app/public/unzip/'.$files[2]);

            $files = File::files($filespath);
            $content = [];
            foreach($files as $f){
                $content[]=[
                    'filename'=>$f->getFilename(),
                    'content'=>File::get($f)
                ];
            }
            return view('pages.project',['project'=>$project,'files'=>$files]);   

        }
       
    }
}