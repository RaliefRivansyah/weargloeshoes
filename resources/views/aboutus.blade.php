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

	@media (min-width: 768px) {
		.aboutus p {
			/* text-align: justify; */
			margin: 0px 254px 80px!important;
			font-size: 20px;
		}
	}

	@media (min-width: 567px) and (max-width: 767.98px){
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
