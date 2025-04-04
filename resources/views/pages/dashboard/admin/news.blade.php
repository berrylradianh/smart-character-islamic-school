@extends('layouts.dashboard.app')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Berita</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SCIS</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Content</a></li>
                            <li class="breadcrumb-item active">Berita</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div id="news-sections">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Edit or Add Berita Content</h4>
                                <p class="sub-title">This Content will be shown on the Berita Section of the Landing Page.</p>

                                <form action="#" method="POST" enctype="multipart/form-data" class="news-form" data-index="0">
                                    @csrf
                                    <div class="news-card">
                                        <div class="form-group row">
                                            <label for="title_0" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Type your title here...." id="title_0" name="title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description_0" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Type your description here...." id="description_0" name="description">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="date" id="date">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                <div class="m-b-30">
                                                    <input type="file" name="file" id="image_0" accept="image/*" class="form-control-file image-input">
                                                    <div id="imagePreview_0" class="mt-3" style="max-width: 300px; display: none;">
                                                        <img id="previewImg_0" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center m-t-15">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-success waves-effect waves-light mb-3" id="add-news">+ Add Berita</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>

<script>
    let newsCount = 1;

    // Handle image preview
    function setupImagePreview(input, index) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById(`imagePreview_${index}`);
            const previewImg = document.getElementById(`previewImg_${index}`);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    }

    // Initial image preview setup
    setupImagePreview(document.getElementById('image_0'), 0);

    // Add new news section
    document.getElementById('add-news').addEventListener('click', function() {
        const newsSections = document.getElementById('news-sections');
        const newRow = document.createElement('div');
        newRow.className = 'row';
        newRow.innerHTML = `
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Edit or Add news Content</h4>
                        <p class="sub-title">This Content will be shown on the news Section of the Landing Page.</p>
                        <form action="#" method="POST" enctype="multipart/form-data" class="news-form" data-index="${newsCount}">
                            @csrf
                            <div class="news-card">
                                <div class="form-group row">
                                    <label for="title_${newsCount}" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Type your title here...." id="title_${newsCount}" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description_${newsCount}" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Type your description here...." id="description_${newsCount}" name="description">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="date_${newsCount}" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" id="date_${newsCount}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="m-b-30">
                                            <input type="file" name="file" id="image_${newsCount}" accept="image/*" class="form-control-file image-input">
                                            <div id="imagePreview_${newsCount}" class="mt-3" style="max-width: 300px; display: none;">
                                                <img id="previewImg_${newsCount}" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center m-t-15">
                                    <button type="submit" class="btn btn-primary waves-effect waves-diameter-light">Submit</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light ml-2 remove-news">Remove</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;
        newsSections.appendChild(newRow);

        // Setup image preview for new input
        const newImageInput = document.getElementById(`image_${newsCount}`);
        setupImagePreview(newImageInput, newsCount);

        // Handle remove button
        newRow.querySelector('.remove-news').addEventListener('click', function() {
            newRow.remove();
        });

        newsCount++;
    });
</script>
@endsection
