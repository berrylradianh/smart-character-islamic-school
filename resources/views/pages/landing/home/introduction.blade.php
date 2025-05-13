@php
    use Illuminate\Support\Facades\Storage;
@endphp

<section style="background-color: #1a2e44; padding: 50px 10%; color: white; position: relative; margin-bottom: 1cm;">
    <img src="{{ asset('assets/img/lantern.png') }}" alt="Ornamen Kiri"
        style="position: absolute; top: 0; left: 0; width: 150px;">
    <img src="{{ asset('assets/img/moon.png') }}" alt="Ornamen Kanan"
        style="position: absolute; top: 0; right: 0; width: 120px;">

    <div style="display: flex; align-items: center; justify-content: center; text-align: center;">
        <h1 style="font-size: 50px; margin: 0; color: white;">Welcome to SCIS</h1>
    </div>
    <div style="text-align: center; margin-top: 5px;">
        <h2 style="font-size: 45px; color: white;">Smart Character Islamic School</h2>
    </div>

    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 40px;">
        <div style="max-width: 50%;">
        {!! $introduction !!}
        </div>

        <div style="max-width: 45%;">
            @if ($introduction_image)
                <img src="{{ Storage::url($introduction_image) }}" alt="Introduction Image" style="width: 100%; border-radius: 15px;">
            @else
                <img src="{{ asset('assets/img/student.png') }}" alt="Default Introduction Image" style="width: 100%; border-radius: 15px;">
            @endif
        </div>
    </div>

</section>
