<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $levels = Level::all();

        return view('question', compact( 'questions', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questionCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Question::create([
            'id_level',
            'pertanyaan_kalimat',
            'pertanyaan_path_gambar',
            'kunci_jawaban'
        ]);

        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::findOrFail($id);
        return view('questionView', compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questions = Question::findOrFail($id);
        $levels = Level::all();

        return view('questionEdit', compact('questions', 'levels'));
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
        $questions = Question::findOrFail($id);
        
        $questions->update([
            'id_level' => $request->id_level,
            'pertanyaan_kalimat' => $request->pertanyaan_kalimat,
            'pertanyaan_path_gambar' => $request->pertanyaan_path_gambar,
            'kunci_jawaban' => $request->kunci_jawaban
        ]);

        return redirect(route('questions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questions = Question::findOrFail($id);

        $questions->delete();

        return redirect(route('questions.index'));
    }
}