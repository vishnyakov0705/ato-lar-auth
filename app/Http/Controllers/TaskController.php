<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;
use App\Repositories\TaskRepository;
class TaskController extends Controller
{
    /**
   * Экземпляр TaskRepository.
   *
   * @var TaskRepository
   */
  protected $tasks;
  
    public function __construct(TaskRepository $tasks) 
    {
        $this->middleware('auth');// Проверять авторизацию при доступе к данному контроллеру
        $this->tasks=$tasks;
    }
    
    /**
    * Показать список всех задач пользователя.
    *
    * @param  Request  $request
    * @return Response
    */
    public function index(Request $request)
    {
      //$tasks = $request->user()->tasks()->get();
      return view('tasks.index', [
        'tasks' => $this->tasks->forUser($request->user()),
      ]);
    }
    
     /**
     * Создание новой задачи.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|max:255',
      ]);

        $request->user()->tasks()->create([
        'name' => $request->name,
        ]);

  return redirect('/tasks');
    }
    
     /**
     * Уничтожить заданную задачу.
     *
     * @param  Request  $request
    * @param  Task  $task
    * @return Response
    */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        
        // Удаление задачи...
        $task->delete();
        return redirect('/tasks');
    }
}
