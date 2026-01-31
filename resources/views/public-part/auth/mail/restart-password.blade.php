@component('mail::message')

Poštovani/a **{{ $_name }}**,

Zaprimili smo zahtjev za oporavak lozinke za Vaš korisnički račun na **{{ config('app.name') }}**.

Ukoliko ste Vi inicirali ovaj zahtjev, lozinku možete postaviti klikom na dugme ispod.

@component('mail::button', ['url' => route('auth.new-password', ['token' => $_token])])
    Postavi novu lozinku
@endcomponent

---

Ako niste Vi inicirali zahtjev za oporavak lozinke, slobodno zanemarite ovu poruku ili nas kontaktirajte ukoliko smatrate da je Vaš račun ugrožen.

Srdačan pozdrav,
<a href="{{ config('app.url') }}">**{{ config('app.name') }}**</a>
@endcomponent
