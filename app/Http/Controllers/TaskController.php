<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;

class TaskController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');// Проверять авторизацию при доступе к данному контроллеру
    }
    
    public function index() {
        $task=Task::all();
        return view('task', ['task'=>$tasks]);
    }
    
    public function store(Requests $request){
        
    }
    
    public function destroy (Task $task){
        
    }
}
