<!-- resources/views/emails/contact_message.blade.php -->

<p style="font-size: 16px; line-height: 1.5; color: #333;">
    <strong style="font-size: 18px; color: #007BFF;">Nombre:</strong> {{ $contactMessage['name'] }}
</p>

<p style="font-size: 16px; line-height: 1.5; color: #333;">
    <strong style="font-size: 18px; color: #007BFF;">Email:</strong> {{ $contactMessage['email'] }}
</p>

<p style="font-size: 16px; line-height: 1.5; color: #333;">
    <strong style="font-size: 18px; color: #007BFF;">Mensaje:</strong>
    <br>
    <span style="font-size: 14px; color: #555;">{{ $contactMessage['message'] }}</span>
</p>
