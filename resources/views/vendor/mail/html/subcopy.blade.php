<table @if(App::isLocale('ar')) dir="rtl" @endif class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td>
            {{ Illuminate\Mail\Markdown::parse($slot) }}
        </td>
    </tr>
</table>
