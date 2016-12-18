<?php
namespace App\Http\Controllers;

use App\Student;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    //初始化
    public function __construct(){
        $student= new Student;
    }
    //学生列表页
    public function index()
    {
        $result = Student::paginate(4);
        return view('student.index', ['student' => $result]);
    }

    //添加学生
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            //控制器验证
           /* $this->validate($request, [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute为必选项',
                'min2' => ':attribute最少输入两个字符',
                'max:20' => ':attribute最多为20个字符',
                'integer' => ':attribute为整数'
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);*/
        //validator验证
            $validator = \Validator::make($request->input(),[
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute为不能为空',
                'min2' => ':attribute最少输入两个字符',
                'max:20' => ':attribute最多为20个字符',
                'integer' => ':attribute为整数'
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput(); //通过session 抛回上级页面$errors包括原来的数据通过old()
            }

            $res = $request->input('Student');
            if (Student::create($res)) {
                return redirect('student/index')->with('success', '添加成功');
            } else {
                return redirect()->back()->with('error', '操作失败');
            }
        }
       $student = new Student;
        $student = $student->sex();
        return view('student.create',
                ['student'=>$student]
            );
    }

    //保存学生
    //保存方法已被添加方法取代,秩序判断isMethod是否为post请求即可
    public function save(Request $request)
    {
        $res = $request->input('Student');
        $student = new Student();//new 模型Student
        $student->name = $res['name'];
        $student->age = $res['age'];
        $student->sex = $res['sex'];
        if ($student->save()) {
            return redirect('student/index');
        } else {
            return redirect()->back();
        }


    }

   /* 表单修改方法*/
    public function update(Request $request,$id){
        $student =  new Student;
        $result =$student->find($id);
        $sex = $student->sex();
        if($request->isMethod('POST')){
            $data = $request->input('Student');
            $student->name=$data['name'];
            $student->age=$data['age'];
            $student->sex=$data['sex'];
            if($student->save()){
                return redirect('student/index')->with('success','ID'.$id.'修改成功');
            }
        }
        return view('student.update',[
            'student'=> $result,
            'sex'=> $sex,
        ]);
    }
    //删除表单方法
    public function delete($id){
        $student =  new Student;

        if($student->find($id)->delete()){
           return redirect('student/index')->with('success','ID-'.$id.'删除成功');
        }else{
           return redirect()->back()->with('error','删除失败');
        }
    }

}