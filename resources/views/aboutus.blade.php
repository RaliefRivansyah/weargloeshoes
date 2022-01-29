@extends('layout.template')

@section('content')

<style>
    body {
		font-family: 'Roboto-Light', sans-serif;
		background-color: #BFBEBE;
    }

    .aboutus h1.judul{
        text-align: center;
        margin: 50px 0px;
        font-size: 23px;
    }

	@media (min-width: 768.98px) {
		.aboutus p {
			/* text-align: justify; */
			margin: 0px 254px 80px!important;
			font-size: 20px;
		}
	}

	@media (min-width: 576px) and (max-width: 768px){
		.aboutus p {
			font-size: 18px;
		}
	}
</style>

<section id="aboutus">
    <div class="container aboutus">
        <h1 class="judul">ABOUT US</h1>
        <p class="mx-5 mb-5 text-justify">{!! $accounts->description_company !!}</p>
    </div>
</section>
@endsection
