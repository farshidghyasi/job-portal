<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) return redirect()->route('login');
        $resumes = Resume::where('user_id', session('user_id'))->get();
        return view('resume.index', compact('resumes'));
    }

    public function create()
    {
        if (!session('logged_in')) return redirect()->route('login');
        return view('resume.create');
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) return redirect()->route('login');

        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
        ]);

        $skills = array_filter(array_map('trim', explode(',', $request->skills ?? '')));

        $experience = [];
        if ($request->has('exp_title')) {
            foreach ($request->exp_title as $i => $title) {
                if (!empty($title)) {
                    $experience[] = [
                        'title' => $title,
                        'company' => $request->exp_company[$i] ?? '',
                        'location' => $request->exp_location[$i] ?? '',
                        'start_date' => $request->exp_start[$i] ?? '',
                        'end_date' => $request->exp_end[$i] ?? '',
                        'current' => isset($request->exp_current[$i]),
                        'description' => $request->exp_desc[$i] ?? '',
                    ];
                }
            }
        }

        $education = [];
        if ($request->has('edu_degree')) {
            foreach ($request->edu_degree as $i => $degree) {
                if (!empty($degree)) {
                    $education[] = [
                        'degree' => $degree,
                        'field' => $request->edu_field[$i] ?? '',
                        'institution' => $request->edu_institution[$i] ?? '',
                        'location' => $request->edu_location[$i] ?? '',
                        'start_year' => $request->edu_start[$i] ?? '',
                        'end_year' => $request->edu_end[$i] ?? '',
                        'gpa' => $request->edu_gpa[$i] ?? '',
                    ];
                }
            }
        }

        $languages = [];
        if ($request->has('lang_name')) {
            foreach ($request->lang_name as $i => $lang) {
                if (!empty($lang)) {
                    $languages[] = ['language' => $lang, 'level' => $request->lang_level[$i] ?? 'Conversational'];
                }
            }
        }

        Resume::create([
            'user_id' => session('user_id'),
            'title' => $request->title,
            'summary' => $request->summary,
            'skills' => array_values($skills),
            'languages' => $languages,
            'experience' => $experience,
            'education' => $education,
            'certifications' => [],
            'is_public' => $request->has('is_public'),
        ]);

        return redirect()->route('resume.index')->with('success', 'Resume created successfully!');
    }

    public function edit($id)
    {
        if (!session('logged_in')) return redirect()->route('login');
        $resume = Resume::where('user_id', session('user_id'))->findOrFail($id);
        return view('resume.edit', compact('resume'));
    }

    public function update(Request $request, $id)
    {
        if (!session('logged_in')) return redirect()->route('login');
        $resume = Resume::where('user_id', session('user_id'))->findOrFail($id);

        $skills = array_filter(array_map('trim', explode(',', $request->skills ?? '')));

        $experience = [];
        if ($request->has('exp_title')) {
            foreach ($request->exp_title as $i => $title) {
                if (!empty($title)) {
                    $experience[] = [
                        'title' => $title,
                        'company' => $request->exp_company[$i] ?? '',
                        'location' => $request->exp_location[$i] ?? '',
                        'start_date' => $request->exp_start[$i] ?? '',
                        'end_date' => $request->exp_end[$i] ?? '',
                        'current' => isset($request->exp_current[$i]),
                        'description' => $request->exp_desc[$i] ?? '',
                    ];
                }
            }
        }

        $education = [];
        if ($request->has('edu_degree')) {
            foreach ($request->edu_degree as $i => $degree) {
                if (!empty($degree)) {
                    $education[] = [
                        'degree' => $degree,
                        'field' => $request->edu_field[$i] ?? '',
                        'institution' => $request->edu_institution[$i] ?? '',
                        'start_year' => $request->edu_start[$i] ?? '',
                        'end_year' => $request->edu_end[$i] ?? '',
                        'gpa' => $request->edu_gpa[$i] ?? '',
                    ];
                }
            }
        }

        $languages = [];
        if ($request->has('lang_name')) {
            foreach ($request->lang_name as $i => $lang) {
                if (!empty($lang)) {
                    $languages[] = ['language' => $lang, 'level' => $request->lang_level[$i] ?? 'Conversational'];
                }
            }
        }

        $resume->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'skills' => array_values($skills),
            'languages' => $languages,
            'experience' => $experience,
            'education' => $education,
            'is_public' => $request->has('is_public'),
        ]);

        return redirect()->route('resume.index')->with('success', 'Resume updated successfully!');
    }

    public function destroy($id)
    {
        if (!session('logged_in')) return redirect()->route('login');
        Resume::where('user_id', session('user_id'))->findOrFail($id)->delete();
        return redirect()->route('resume.index')->with('success', 'Resume deleted.');
    }

    public function publicView($id)
    {
        $resume = Resume::with('user')->where('is_public', true)->findOrFail($id);
        return view('resume.view', compact('resume'));
    }
}