@extends('layout.sejarahKita')

@section('title', 'Bank Soal - Question Details')

@section('content')
    <nav class="bg-black rounded-3 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" data-aos="fade-up">
        <ol class="breadcrumb p-2">
            <li class="breadcrumb-item"><a href="{{ url('admin/profile') }}">Profile</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/profile/question') }}">Bank Soal</a></li>
            <li class="breadcrumb-item active" aria-current="page"><strong>Detail Soal</strong></li>
        </ol>
    </nav>

    <div class="card illustration-card" data-aos="fade-up">
        <div class="card-header text-center fw-bold fs-5 pb-3">
            <i class="bi bi-tag"></i>&emsp;{{ $question->levels->jenis_level }}
        </div>
        <div class="card-body mb-3 pb-1">
            <p>
                <i class="bi bi-patch-question"></i>&emsp;{{ $question->pertanyaan_kalimat }}
            </p>
            <strong>
                <i class="bi bi-bookmark-check"></i>&emsp;{{ $question->kunci_jawaban }}
            </strong>
        </div>
    </div>

    <img src="{{ asset('storage/' . $question->pertanyaan_path_gambar) }}" id="output"
        class="question-img mx-auto shadow-sm mt-4 mx-auto d-block" onclick="showImage()" data-aos="fade-up" />

    {{-- Tampilkan Preview Image & File Name nya setelah klik 'Pilih File' --}}
    <script src="{{ url('/assets/js/imagePreview.js') }}"></script>
@endsection
