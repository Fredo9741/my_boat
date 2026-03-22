{{-- Honeypot + timing fields — bot protection, invisible to real users --}}
<div aria-hidden="true" style="position:absolute;left:-9999px;height:0;overflow:hidden;" tabindex="-1">
    <label for="_hp_url">Ne pas remplir ce champ</label>
    <input type="text"
           id="_hp_url"
           name="_hp_url"
           value=""
           autocomplete="off"
           tabindex="-1"
           style="display:none">
</div>
<input type="hidden" name="_form_time" value="{{ time() }}">
