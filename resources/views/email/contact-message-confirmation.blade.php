<h1>Merci {{ $contact_message->sender }} !</h1>
<p>Nous avons bien reçu votre message, et y répondrons aussi vite que possible.</p>
<h3>Rappel de votre message</h3>
<p>Sujet : {{ $contact_message->subject }}</p>
<p>Message : {{ $contact_message->body }} </p>
<br/>
<br/>
<p>Toute l'équipe d'EC Digital</p>