<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PpdbInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from($this->data['email'], $this->data['namaOrangTua'])
            ->subject('Pertanyaan PPDB - Smart Character Islamic School')
            ->view('emails.ppdb_inquiry')
            ->with([
                'namaSiswa' => $this->data['namaSiswa'],
                'asalSekolah' => $this->data['asalSekolah'],
                'namaOrangTua' => $this->data['namaOrangTua'],
                'nomorHP' => $this->data['nomorHP'],
                'email' => $this->data['email'],
                'jenjang' => $this->data['jenjang'],
                'pesan' => $this->data['pesan'],
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pertanyaan PPDB - Smart Character Islamic School',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
