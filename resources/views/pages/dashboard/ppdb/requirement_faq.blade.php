@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Kelola FAQs</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Kelola FAQs</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Tabel FAQs -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar FAQs</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Urutan</th>
                                        <th>Warna Kategori</th>
                                        <th>Landing Page</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($faqs as $faq)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::limit($faq->question, 42) }}</td>
                                        <td>{{ Str::limit($faq->answer, 42) }}</td>
                                        <td>{{ $faq->order_number }}</td>
                                        <td>
                                            <span class="badge badge-{{ $faq->category_color }}" style="font-size: small;">{{ $faq->category_color }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $faq->show_on_landing_page ? 'success' : 'secondary' }}">
                                                {{ $faq->show_on_landing_page ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewFaqModal{{ $faq->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editFaqModal{{ $faq->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('dashboard.faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus FAQ ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada FAQ tersedia.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail FAQ -->
            @foreach ($faqs as $faq)
            <div class="modal fade" id="viewFaqModal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="viewFaqModalLabel{{ $faq->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewFaqModalLabel{{ $faq->id }}">Detail FAQ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pertanyaan</label>
                                <p class="form-control-static">{{ $faq->question }}</p>
                            </div>
                            <div class="form-group">
                                <label>Jawaban</label>
                                <p class="form-control-static">{{ $faq->answer }}</p>
                            </div>
                            <div class="form-group">
                                <label>Nomor Urutan</label>
                                <p class="form-control-static">{{ $faq->order_number }}</p>
                            </div>
                            <div class="form-group">
                                <label>Warna Kategori</label>
                                <p class="form-control-static">
                                    <span class="badge badge-{{ $faq->category_color }}">{{ $faq->category_color }}</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Tampil di Landing Page</label>
                                <p class="form-control-static">
                                    <span class="badge badge-{{ $faq->show_on_landing_page ? 'success' : 'secondary' }}">
                                        {{ $faq->show_on_landing_page ? 'Ya' : 'Tidak' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Modal Edit FAQ -->
            @foreach ($faqs as $faq)
            <div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="editFaqModalLabel{{ $faq->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.faq.update', $faq->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFaqModalLabel{{ $faq->id }}">Edit FAQ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="question_{{ $faq->id }}">Pertanyaan</label>
                                    <input type="text" name="question" id="question_{{ $faq->id }}" class="form-control @error('question') is-invalid @enderror" value="{{ old('question', $faq->question) }}" required>
                                    @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="answer_{{ $faq->id }}">Jawaban</label>
                                    <textarea name="answer" id="answer_{{ $faq->id }}" class="form-control @error('answer') is-invalid @enderror" rows="4" required>{{ old('answer', $faq->answer) }}</textarea>
                                    @error('answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="order_number_{{ $faq->id }}">Nomor Urutan</label>
                                    <input type="number" name="order_number" id="order_number_{{ $faq->id }}" class="form-control @error('order_number') is-invalid @enderror" value="{{ old('order_number', $faq->order_number) }}" required>
                                    @error('order_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_color_{{ $faq->id }}">Warna Kategori</label>
                                    <select name="category_color" id="category_color_{{ $faq->id }}" class="form-control @error('category_color') is-invalid @enderror" required>
                                        <option value="success" {{ old('category_color', $faq->category_color) == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="primary" {{ old('category_color', $faq->category_color) == 'primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="warning" {{ old('category_color', $faq->category_color) == 'warning' ? 'selected' : '' }}>Warning</option>
                                        <option value="danger" {{ old('category_color', $faq->category_color) == 'danger' ? 'selected' : '' }}>Danger</option>
                                        <option value="info" {{ old('category_color', $faq->category_color) == 'info' ? 'selected' : '' }}>Info</option>
                                    </select>
                                    @error('category_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="show_on_landing_page_{{ $faq->id }}">Tampil di Landing Page</label>
                                    <select name="show_on_landing_page" id="show_on_landing_page_{{ $faq->id }}" class="form-control @error('show_on_landing_page') is-invalid @enderror">
                                        <option value="1" {{ old('show_on_landing_page', $faq->show_on_landing_page) ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ old('show_on_landing_page', $faq->show_on_landing_page) ? '' : 'selected' }}>Tidak</option>
                                    </select>
                                    @error('show_on_landing_page')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>
@endsection
