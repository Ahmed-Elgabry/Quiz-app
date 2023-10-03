<div @if(App::isLocale('ar')) dir="rtl" @endif class="table">
{{ Illuminate\Mail\Markdown::parse($slot) }}
</div>
