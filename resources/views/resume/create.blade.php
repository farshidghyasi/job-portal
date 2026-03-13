@extends('layouts.app')
@section('title', 'Create Resume - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-4xl mx-auto px-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('resume.index') }}" class="text-up-muted hover:text-white transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold">Create New Resume</h1>
                <p class="text-up-muted mt-0.5">Build a professional resume to impress employers</p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-8">
    <form action="{{ route('resume.store') }}" method="POST">
        @csrf

        {{-- Basic Information --}}
        <div class="bg-white border border-up-border rounded-2xl p-6 mb-6">
            <h2 class="text-lg font-bold text-up-dark mb-5 flex items-center gap-2">
                <i class="fas fa-id-card text-up-green"></i> Basic Information
            </h2>

            <div class="mb-5">
                <label class="block text-up-dark font-semibold mb-2 text-sm">Resume Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('title') border-red-400 @enderror"
                       placeholder="e.g. Senior Software Engineer Resume">
                @error('title')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-up-dark font-semibold mb-2 text-sm">Professional Summary</label>
                <textarea name="summary" rows="4"
                          class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none @error('summary') border-red-400 @enderror"
                          placeholder="Write a brief, compelling summary of your professional background and goals...">{{ old('summary') }}</textarea>
                @error('summary')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-up-dark font-semibold mb-2 text-sm">Skills</label>
                <input type="text" name="skills" value="{{ old('skills') }}"
                       class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('skills') border-red-400 @enderror"
                       placeholder="e.g. PHP, Laravel, JavaScript, MySQL (comma-separated)">
                <p class="text-up-muted text-xs mt-1">Separate skills with commas</p>
                @error('skills')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_public" id="is_public" value="1"
                       class="w-4 h-4 accent-up-green border-up-border rounded"
                       {{ old('is_public') ? 'checked' : '' }}>
                <label for="is_public" class="text-up-dark font-medium cursor-pointer text-sm">
                    Make this resume publicly visible
                    <span class="text-up-muted font-normal"> - employers can find and view it</span>
                </label>
            </div>
        </div>

        {{-- Experience Section --}}
        <div class="bg-white border border-up-border rounded-2xl p-6 mb-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-up-dark flex items-center gap-2">
                    <i class="fas fa-briefcase text-up-green"></i> Work Experience
                </h2>
                <button type="button" onclick="addExperience()"
                        class="bg-up-bg hover:bg-up-light text-up-dark border border-up-border px-4 py-2 rounded-xl text-sm font-medium transition-all flex items-center gap-1.5">
                    <i class="fas fa-plus text-up-green"></i> Add Experience
                </button>
            </div>
            <div id="experience-container"></div>
            <p id="exp-empty-msg" class="text-up-muted text-sm text-center py-4">
                No experience added yet. Click "Add Experience" to get started.
            </p>
        </div>

        {{-- Education Section --}}
        <div class="bg-white border border-up-border rounded-2xl p-6 mb-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-up-dark flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-up-green"></i> Education
                </h2>
                <button type="button" onclick="addEducation()"
                        class="bg-up-bg hover:bg-up-light text-up-dark border border-up-border px-4 py-2 rounded-xl text-sm font-medium transition-all flex items-center gap-1.5">
                    <i class="fas fa-plus text-up-green"></i> Add Education
                </button>
            </div>
            <div id="education-container"></div>
            <p id="edu-empty-msg" class="text-up-muted text-sm text-center py-4">
                No education added yet. Click "Add Education" to get started.
            </p>
        </div>

        {{-- Languages Section --}}
        <div class="bg-white border border-up-border rounded-2xl p-6 mb-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-up-dark flex items-center gap-2">
                    <i class="fas fa-language text-up-green"></i> Languages
                </h2>
                <button type="button" onclick="addLanguage()"
                        class="bg-up-bg hover:bg-up-light text-up-dark border border-up-border px-4 py-2 rounded-xl text-sm font-medium transition-all flex items-center gap-1.5">
                    <i class="fas fa-plus text-up-green"></i> Add Language
                </button>
            </div>
            <div id="language-container"></div>
            <p id="lang-empty-msg" class="text-up-muted text-sm text-center py-4">
                No languages added yet. Click "Add Language" to get started.
            </p>
        </div>

        {{-- Submit --}}
        <div class="flex gap-4">
            <a href="{{ route('resume.index') }}"
               class="btn-outline px-8 py-3 font-medium">
                Cancel
            </a>
            <button type="submit" class="btn-primary px-8 py-3 font-semibold flex items-center gap-2">
                <i class="fas fa-save"></i> Save Resume
            </button>
        </div>
    </form>
</div>

{{-- Hidden DOM templates --}}
<template id="tpl-experience">
    <div class="border border-up-border rounded-xl p-5 mb-4 relative bg-up-bg-light">
        <button type="button" data-remove="true"
                class="absolute top-3 right-3 text-red-400 hover:text-red-600 transition-colors" title="Remove">
            <i class="fas fa-times-circle"></i>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Job Title <span class="text-red-500">*</span></label>
                <input type="text" name="exp_title[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Software Engineer">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Company <span class="text-red-500">*</span></label>
                <input type="text" name="exp_company[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Tech Corp">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Location</label>
                <input type="text" name="exp_location[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Kabul, Afghanistan">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Start Date</label>
                <input type="text" name="exp_start[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Jan 2020">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">End Date</label>
                <input type="text" name="exp_end[]" data-exp-end="true"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Dec 2023">
            </div>
            <div class="flex items-center gap-2 mt-4">
                <input type="checkbox" name="exp_current[]" value="1" data-exp-current="true"
                       class="w-4 h-4 accent-up-green border-up-border rounded">
                <label class="text-up-text text-sm cursor-pointer">I currently work here</label>
            </div>
        </div>
        <div>
            <label class="block text-up-text text-sm font-medium mb-1">Description</label>
            <textarea name="exp_desc[]" rows="3"
                      class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm resize-none"
                      placeholder="Describe your responsibilities and achievements..."></textarea>
        </div>
    </div>
</template>

<template id="tpl-education">
    <div class="border border-up-border rounded-xl p-5 mb-4 relative bg-up-bg-light">
        <button type="button" data-remove="true"
                class="absolute top-3 right-3 text-red-400 hover:text-red-600 transition-colors" title="Remove">
            <i class="fas fa-times-circle"></i>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Degree</label>
                <input type="text" name="edu_degree[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Bachelor of Science">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Field of Study</label>
                <input type="text" name="edu_field[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Computer Science">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Institution</label>
                <input type="text" name="edu_institution[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Kabul University">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Location</label>
                <input type="text" name="edu_location[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. Kabul, Afghanistan">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">Start Year</label>
                <input type="text" name="edu_start[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. 2016">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">End Year</label>
                <input type="text" name="edu_end[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. 2020 or Expected 2025">
            </div>
            <div>
                <label class="block text-up-text text-sm font-medium mb-1">GPA <span class="text-up-muted font-normal">(optional)</span></label>
                <input type="text" name="edu_gpa[]"
                       class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                       placeholder="e.g. 3.8 / 4.0">
            </div>
        </div>
    </div>
</template>

<template id="tpl-language">
    <div class="border border-up-border rounded-xl p-4 mb-3 relative bg-up-bg-light flex flex-col sm:flex-row gap-4 items-end">
        <div class="flex-1">
            <label class="block text-up-text text-sm font-medium mb-1">Language</label>
            <input type="text" name="lang_name[]"
                   class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                   placeholder="e.g. English">
        </div>
        <div class="flex-1">
            <label class="block text-up-text text-sm font-medium mb-1">Proficiency Level</label>
            <select name="lang_level[]"
                    class="w-full border border-up-border rounded-xl px-3 py-2 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm bg-white">
                <option value="Native">Native</option>
                <option value="Fluent">Fluent</option>
                <option value="Advanced">Advanced</option>
                <option value="Conversational">Conversational</option>
                <option value="Basic">Basic</option>
            </select>
        </div>
        <button type="button" data-remove="true"
                class="mb-1 text-red-400 hover:text-red-600 transition-colors px-2" title="Remove">
            <i class="fas fa-times-circle text-lg"></i>
        </button>
    </div>
</template>

<script>
(function () {
    function checkEmpty(containerId, msgId) {
        var c = document.getElementById(containerId);
        var m = document.getElementById(msgId);
        if (c && m) m.style.display = c.children.length === 0 ? 'block' : 'none';
    }

    function cloneTemplate(tplId) {
        var tpl = document.getElementById(tplId);
        return tpl.content.cloneNode(true).firstElementChild;
    }

    function wireRemove(node, containerId, msgId) {
        node.querySelectorAll('[data-remove="true"]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                node.remove();
                checkEmpty(containerId, msgId);
            });
        });
    }

    function wireCurrentJobToggle(node) {
        var cb = node.querySelector('[data-exp-current="true"]');
        var endField = node.querySelector('[data-exp-end="true"]');
        if (!cb || !endField) return;
        cb.addEventListener('change', function () {
            endField.disabled = cb.checked;
            endField.placeholder = cb.checked ? 'Present' : 'e.g. Dec 2023';
            if (cb.checked) endField.value = '';
        });
    }

    window.addExperience = function (data) {
        var node = cloneTemplate('tpl-experience');
        if (data) {
            node.querySelector('[name="exp_title[]"]').value        = data.title        || '';
            node.querySelector('[name="exp_company[]"]').value      = data.company      || '';
            node.querySelector('[name="exp_location[]"]').value     = data.location     || '';
            node.querySelector('[name="exp_start[]"]').value        = data.start_date   || '';
            node.querySelector('[name="exp_end[]"]').value          = data.end_date     || '';
            node.querySelector('[name="exp_desc[]"]').value         = data.description  || '';
            if (data.current) {
                var cb = node.querySelector('[data-exp-current="true"]');
                var ef = node.querySelector('[data-exp-end="true"]');
                if (cb) cb.checked = true;
                if (ef) { ef.disabled = true; ef.placeholder = 'Present'; ef.value = ''; }
            }
        }
        wireRemove(node, 'experience-container', 'exp-empty-msg');
        wireCurrentJobToggle(node);
        document.getElementById('experience-container').appendChild(node);
        checkEmpty('experience-container', 'exp-empty-msg');
    };

    window.addEducation = function (data) {
        var node = cloneTemplate('tpl-education');
        if (data) {
            node.querySelector('[name="edu_degree[]"]').value      = data.degree      || '';
            node.querySelector('[name="edu_field[]"]').value       = data.field       || '';
            node.querySelector('[name="edu_institution[]"]').value = data.institution || '';
            node.querySelector('[name="edu_location[]"]').value    = data.location    || '';
            node.querySelector('[name="edu_start[]"]').value       = data.start_year  || '';
            node.querySelector('[name="edu_end[]"]').value         = data.end_year    || '';
            node.querySelector('[name="edu_gpa[]"]').value         = data.gpa         || '';
        }
        wireRemove(node, 'education-container', 'edu-empty-msg');
        document.getElementById('education-container').appendChild(node);
        checkEmpty('education-container', 'edu-empty-msg');
    };

    window.addLanguage = function (data) {
        var node = cloneTemplate('tpl-language');
        if (data) {
            node.querySelector('[name="lang_name[]"]').value = data.language || '';
            var sel = node.querySelector('[name="lang_level[]"]');
            if (sel && data.level) {
                Array.from(sel.options).forEach(function (o) {
                    o.selected = (o.value === data.level);
                });
            }
        }
        wireRemove(node, 'language-container', 'lang-empty-msg');
        document.getElementById('language-container').appendChild(node);
        checkEmpty('language-container', 'lang-empty-msg');
    };
}());
</script>

@endsection
