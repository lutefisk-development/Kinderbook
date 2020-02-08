@extends('layouts.login')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="text-center first">Välkommen till</h1>
            <h1 class="text-center second">STORKBOET</h1>
        </div>
    </div>
    <div class="container layouts-wrapper">
        <div class="row">
            <div class="col-md-6 text-inside-layouts-wrapper">
                <div>
                    <p>
                        Det ska vara roligt och spännande att vara barn på I Ur och Skur Storkboet. Här utgår vi ifrån barnens erfarenheter, intressen, behov och åsikter. Vi upptäcker och upplever med alla våra sinnen i alla aktiviteter, både ute och inne. Här ser vi inte bara gruppen utan även individen i gruppen, det är viktigt att alla känner sig trygga och att barnen får vara barn.
                    </p>
                    <p>
                        "Det är ute i verkligheten, i utemiljön, i landskapet som människor lär bäst. Det är där man upplever med alla sinnen och både ser, hör, känner, smakar och förnimmer. Det främjar både nyfikenhet, kreativitet och samarbete, väcker känslor och får oss att bry oss om vår miljö, natur - och kulturlandskapet och vår egen historia." Anders Szczepanski LiU.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ Storage::url('/pictures/stork.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ Storage::url('/pictures/kids.jpeg') }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 text-inside-layouts-wrapper">
                <p>
                    I Ur och Skur Storkboet är ett personalkooperativ som drivs som ekonomisk förening, av Malin Fredriksson och Lotta Forsberg.
                    Förskolans vision är ”Barns lärande genom upplevelser”
                    Förskolan får bidrag från Sjöbo kommun till förskoleverksamheten, och förskolan följer reglerna utifrån maxtaxan och allmän förskola. Vi driver också verksamheten utifrån Friluftsfrämjandets krav att få kalla sig I Ur och Skur förskola. Idén i denna pedagogik är att barns behov av kunskap, rörelse och gemenskap tillfredsställs genom vistelse i naturen.
                    Våra öppettider är 6.00-17.15, övriga krav eller regler står i vårt kontrakt som föräldrarna skriver på vid inskolningen.
                </p>
            </div>
        </div>
    </div>
@endsection