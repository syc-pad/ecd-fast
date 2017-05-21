# Quick Demo ECDigital with Laravel

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Présentation

L'application de démonstration propose une partie front (globalement anecdotique, valant surtout pour le formulaire de contact), et un **surtout** espace client à accès restreint. L'idée n'était pas de faire une copie express du service, mais juste de créer très vite un semblant de web app qui serait un bon *prétexte à features*

Celui-ci permet de créer des devis, les associer à des prospects/clients et leur attribuer des catégories (éditables), et gérer les messages reçus de la part des clients.

* Administration avec accès protégé et redirection vers l'écran de connexion le cas échéant *(guest users)*
* Utilisation d'Eloquent avec relations
* Devis filtrables par client *(en cliquant sur son nom, uniquement côté Admin)*
* Mutators *(formatage de date)*
* Envoi de message via Mailgun. Pour l'exemple, le message de confirmation **et** de notification sont envoyés à l'adresse saisie dans le formulaire de contact.
* Events et Listeners pour l'envoi de message
* Pagination avec rafraîchissement immédiat en cas de suppression d'items
* Opérations CRUD diverses
* Un peu de Javascript *(bas-niveau)* pour l'édition/suppression d'éléments et le feedback utilisateur
* Un peu de CSS *(dynamisé via Blade au niveau du header)*

## Faire tourner la démo

Pour voir tourner l'application de démo : [cliquer ici](https://ecd-fast-seeyoucloud.c9users.io).

Compte administrateur : test@test.com | toto

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
