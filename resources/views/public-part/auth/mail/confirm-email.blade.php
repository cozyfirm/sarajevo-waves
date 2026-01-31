@component('mail::message')

Poštovani/a **{{ $_name }}**,

Ovim putem Vas obavještavamo da je Vaš korisnički račun uspješno kreiran na
**{{ config('app.name') }}**.

Radi verifikacije Vaše email adrese, molimo Vas da kliknete na dugme ispod.

@component('mail::button', ['url' => route('auth.verify-account', ['token' => $_token])])
    Verifikuj email adresu
@endcomponent

---

Zahvaljujemo Vam na ukazanom povjerenju i korištenju našeg sistema.

Srdačan pozdrav,
<a href="{{ config('app.url') }}">**{{ config('app.name') }}**</a>
@endcomponent
