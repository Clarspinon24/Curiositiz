@extends('layouts.app')

@section('content')
<div class="site-content">
    <div class="container">
        <h3 class="content-title mt-5 mt-md-0">« Rendre chaque moment en famille inoubliable »
        </h3>
        <div class="text-center"><small>(Mission de Curiositiz)</small></div>
        <hr class="content-divider">

        <div class="pt-2 pt-5">
            <div class="row">
                <div class="col-12">
                    <div class="pb-3">
                        <h4>Curiositiz Aujourd’hui</h4>
                        <p><strong class="content-strong">Curiositiz</strong> est une start up qui a pour ambition de créer une communauté de professionnels et particuliers afin de promouvoir des activités ludiques et récréatives en famille.<br />
                        <strong class="content-strong">Curiositiz</strong> est une plateforme de mise en relation qui souhaite devenir la place de marché de référence des offres de sorties en famille.</br />
                        Nous veillons à proposer et promouvoir les meilleurs activités pour rendre chaque moment en famille inoubliable.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="pb-3">
                        <h4>Comment tout a commencé</h4>
                        <p><strong>Jérôme</strong> (papa d’une fille de 5 ans) souhaitait offrir des instants inoubliables à sa famille. Pour autant, il remarqua qu’il y avait peu d’activités proposées et disponibles alors qu’il y a des centaines d’associations dans sa ville offrant des expériences inoubliables. L’idée était née ! Promouvoir les associations (mais aussi les particuliers) pour créer des expérience en famille inoubliables.</p>
                    </div>

                    <div class="pb-3">
                        <h4> Une équipe engagée</h4>
                        <p><strong class="content-strong">Curiositiz</strong> s'engage à agir pour renforcer la scolarisation des enfants en France et dans le Monde.</p>
                    </div>

                    <div class="pb-3">
                        <h4>Une équipe qui a besoin de vous !</h4>
                        <p>Vous croyez à notre projet ? Rejoignez la communauté <strong class="content-strong">Curiositiz</strong> ! <br />
                        Nous avons besoin de vous pour contribuer au développement de <strong class="content-strong">Curiositiz</strong>. <br />
                        Comment ? En partageant vos bons plans, en réalisant un don, en mettant à profit vos compétences. Pour cela, utilisez la rubrique "Nous contacter".</p>
                    </div>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <div>
                        <img src="{{ asset('images/about_jerome.jpg') }}" style="max-height: 300px;" class="img-fluid" alt="Photo du fondateur Jérôme">
                    </div>
                    <div class="pt-2">
                        <strong>Jérôme</strong> (fondateur)
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="pb-3">
                        <p>Un grand merci pour votre soutien, qui compte énormément pour nous !</p>
                        <p>Jérôme & toute l'équipe <strong class="content-strong">Curiositiz</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
